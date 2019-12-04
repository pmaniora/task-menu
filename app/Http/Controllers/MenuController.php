<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenu;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenu $request)
    {
        $menu = new Menu;
        $menu->field = $request->field;
        $menu->save();

        return new Response($menu);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $menuId
     * @return \Illuminate\Http\Response
     */
    public function show(int $menuId)
    {
        return Response(Menu::findOrFail($menuId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $menu)
    {
        $menu = Menu::findOrFail($menu);

        $menu->field =  $request->field;

        $menu->save();

        return new Response($menu);
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
        $menu->delete();
    }
}
