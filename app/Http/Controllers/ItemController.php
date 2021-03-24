<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string'
        );
        $validator = Validator::make($request->item, $rules);
        if($validator->fails()){
            return $validator->errors();
        }
        return Item::create([
            'name' => $request->item["name"],
            'price' => $request->item["price"],
            'description' => $request->item["description"]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        if($item){
            return $item;
        }
        return "Item doesn't exist";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if($item){
            $rules = array(
                'name' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|string'
            );
            $validator = Validator::make($request->item, $rules);
            if($validator->fails()){
                return $validator->errors();
            }else{
                $item->name = $request->item['name'];
                $item->price = $request->item['price'];
                $item->description = $request->item['description'];
                $item->save();
                return $item;
            }
            
        }
        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if($item){
            $item->delete();
            return "Item deleted successfully";
        }
        return "Item not found";
    }
}
