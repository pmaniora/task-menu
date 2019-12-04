<?php

namespace App\Http\Controllers;

use App\Item;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemChildrenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed $itemId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $itemId)
    {
        $parentItem = Item::findOrFail($itemId);
        foreach ($parentItem->children as $item){
            $item->delete();
        }
        foreach ($request->all() as $RequestedItem){
            $item = new Item;
            $item->field = $RequestedItem['field'];
            $item->parent = $itemId;
            $item->save();
        }
        $parentItem->save();
        $parentItem->refresh();

        return new Response($parentItem->children);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $item
     * @return \Illuminate\Http\Response
     */
    public function show($item)
    {
        $parentItem = Item::findOrFail($item);

        return new Response($parentItem->children);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($item)
    {
        $parentItem = Item::findOrFail($item);
        foreach ($parentItem->children as $item){
            $item->delete();
        }

        return new Response("");
    }
}
