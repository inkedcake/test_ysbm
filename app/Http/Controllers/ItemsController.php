<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $items = Items::where('shipment_id', $id)->get();
        return view('items_list', ['items' => $items, 'shipment_id' => $id]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:255'],
        ]);
        if ($validatedData) {
            $item = new Items();
            $item->name = $request->name;
            $item->code = $request->code;
            $item->shipment_id = $request->shipment_id;
            $item->save();
            return response()->json(['data' => $item, 'success' => 'Data is successfully added']);
        }
        return response()->json(['error' => 'Data is cannot added']);

    }

    public function show($shipment_id, $item_id)
    {
        $item = Items::where('id', $item_id)->first();
        return view('item_edit', ['item' => $item, 'shipment_id' => $shipment_id]);

    }

    public function edit(Request $request)
    {
        Items::where('id', $request->id)->update(['name' => $request->name, 'code' => $request->code]);
    }

    public function delete(Request $request)
    {
        if (Items::where('id', $request->id)->delete()) {
            return response()->json(['success' => 'Data is successfully deleted']);
        }
        return response()->json(['error' => 'Cannot delete item']);

    }
}
