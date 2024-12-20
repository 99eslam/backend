<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
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
        $subcategory = new SubCategory();
        $subcategory->subcategoryname=$request->get('subcategoryname');
        $subcategory->categoryid=$request->get('categoryid');
        $subcategory->save();
         return response()->json(['message' => 'Subcategory added successfully'], 201);
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
        $subcategory=SubCategory::find($id);
        return $subcategory;
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
        $subcategory = SubCategory::find($id);
        $subcategory->subcategoryname=$request->get('subcategoryname');
        $subcategory->categoryid=$request->get('categoryid');
        $subcategory->save();
        return response()->json(['message' => 'subcategory updated successfully'],201);
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
        $subcategory = SubCategory::find($id);

        // If no subcategory is found, return a 404 response
        if (!$subcategory) {
            return response()->json(['message' => 'Subcategory not found'], 404);
        }

        // Delete the subcategory
        $subcategory->delete();

        // Return a success message after deletion
        return response()->json(['message' => 'Subcategory deleted successfully'], 200);
    }

    public function getsubcategoryproducts($id)
    {
        $productController=new ProductController();
        return $productController->getbysubcategory($id);
    }
    public function getsubcategories($categoryid)
    {
        return SubCategory::where ('categoryid',$categoryid)->get();
    }
}
