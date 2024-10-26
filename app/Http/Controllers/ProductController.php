<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $product = new Product();
        $product->subcategoryid  = $request->get('subcategoryid');
        $product->name  = $request->get('name');
        $product->description  = $request->get('description');
        $product->quantity  = $request->get('quantity');
        $product->price  = $request->get('price');
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = product::find($id);
        return $product;
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
        //
        $product = product::find($id);
        $product->subcategoryid  = $request->get('subcategoryid');
        $product->name  = $request->get('name');
        $product->description  = $request->get('description');
        $product->quantity  = $request->get('quantity');
        $product->price  = $request->get('price');
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = product::find($id);
        $product->delete();
    }
    public function getall()
    {
        return product::all();
    }

    public function updatequantity(Request $request, $id)
    {
        //
        $product = product::find($id);
        $product->quantity  = $request->get('quantity');
        $product->save();
    }

    public function getbysubcategory($subcategoryid)
    {
        return product::where('subcategoryid', $subcategoryid)->get();
    }
}
