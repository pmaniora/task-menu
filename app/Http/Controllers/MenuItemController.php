<?php

namespace App\Http\Controllers;

use App\Item;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $menuId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $menuId)
    {
        $menu = Menu::findOrFail($menuId);
        foreach ($menu->items as $item){
            $item->delete();
        }
        foreach ($request->all() as $RequestedItem){
            $item = new Item;
            $item->field = $RequestedItem['field'];
            $item->menu = $menuId;
            $item->save();
        }
        $menu->save();
        $menu->refresh();
        return new Response($menu->items);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($menu)
    {
        $menu = Menu::findOrFail($menu);

        return new Response($menu->items);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu)
    {
        $menu = Menu::findOrFail($menu);
        foreach ($menu->items as $item){
            $item->delete();
        }

        return new Response("");
    }
}
