<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\ProductController;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $product_controller ;
    protected $offer_controller;
    protected $sub_category_controller;
    protected $category_controller;
    public function __construct()
    {
        $this->product_controller = new ProductController();
        $this->offer_controller = new offerController();
        $this->sub_category_controller = new subCategoryController();
        $this->category_controller = new categoryController();
    }



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
        $user = new User();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->address = $request->get('address');
        $user->username = $request->get('username');
        $user->role = 1;
        $user->acceptance_flag = 0;
        $user->suspended_flag = 0;


        $user->save();
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
        $user=User::find($id);
        return $user;
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
        $user = User::find($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->address = $request->get('address');
        $user->username = $request->get('username');
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
        $user = User::find($id);
        $user->delete();
    }



    //------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------
    public function Addproduct(Request $request){

        $this->product_controller->store($request);

    }

    public function updateproduct(Request $request ,$id){

        $this->product_controller->update($request,$id);
    }

    public function deleteproduct($id)
    {

        $this->product_controller->destroy($id);
    }

    public function banuser($id)
    {
        $user=User::find($id);
        $user->suspended_flag = 1;
        $user->save();
    }

    public function Addoffer(Request $request){

        $this->offer_controller->store($request);

    }

    public function updateoffer(Request $request ,$id)
    {

        $this->offer_controller->update($request,$id);
    }

    public function deleteoffer($id)
    {
        $this->offer_controller->destroy($id);
    }

    public function ChangeOfferState($id,$state)
    {
        $this->offer_controller->changeState($id,$state);
    }

    public function Addcategory(Request $request){

        $this->category_controller->store($request);

    }

    public function updatecategory(Request $request ,$id){

        $this->category_controller->update($request,$id);
    }

    public function deletecategory($id)
    {
        $this->category_controller->destroy($id);
    }

    public function Addsubcategory(Request $request){

        $this->sub_category_controller->store($request);

    }

    public function updatesubcategory(Request $request ,$id){

        $this->sub_category_controller->update($request,$id);
    }

    public function deletesubcategory($id)
    {
        $this->sub_category_controller->destroy($id);
    }

//-----------------------------------------------------------------------------

public function getallproduct()
{
    return $this->product_controller->getAll();
}

public function Updateproductquantity(Request $request ,$id)
{
    $this->product_controller->updatequantity($request , $id);
}
//-----------------------------------------------------------------------------------
public function getallcategory()
{
    return $this->category_controller->getall();
}

}



