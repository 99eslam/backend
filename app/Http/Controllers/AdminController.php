<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $product_controller;
    protected $offer_controller;
    protected $sub_category_controller;
    protected $category_controller;







    public function __construct()
    {
        $this->product_controller = new productController();
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
         // tested route //
        $user = new User();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password')) ;
        $user->address = $request->get('address');
        $user->username = $request->get('username');
        $user->roleid = 1;
        $user->acceptance_flag = 0;
        $user->suspended_flag = 0;
        $user->save();

       return response()->json(['message' => 'user create succesfully' ,'user'=> $user],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         // tested route //
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
         // tested route //
        $user = User::find($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password =  Hash::make($request->get('password'));
        $user->address = $request->get('address');
        $user->username = $request->get('username');
        $user->save();
        return response()->json(['message' => 'User updated successfully', 'user' => $user], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // tested route //
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 201);

    }



    //------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------
    public function Addproduct(Request $request){

        return $this->product_controller->store($request);
        //

    }

    public function updateproduct(Request $request ,$id){

        return $this->product_controller->update($request,$id);
//
    }

    public function deleteproduct($id)
    {

        $this->product_controller->destroy($id);
        //
    }

    public function banuser($id)
    {
        $user=User::find($id);
        $user->suspended_flag = 1;
        $user->save();
        //
    }

    public function Addoffer(Request $request){

        $this->offer_controller->store($request);
        //
    }

    public function showoffer($id)
    {
        //
        $this->offer_controller->show($id);
    }

    public function updateoffer(Request $request ,$id){
//
        $this->offer_controller->update($request,$id);
    }

    public function deleteoffer($id)
    {
        //
        $this->offer_controller->destroy($id);
    }

    public function ChangeOfferState($id,$state)
    {
        $this->offer_controller->changeState($id,$state);
        //
    }

    public function Addcategory(Request $request){

        $this->category_controller->store($request);
        return response()->json(['message' => 'catogary added successfully'],201);
        // tested route //
    }

    public function updatecategory(Request $request ,$id){

        $this->category_controller->update($request,$id);
        return response()->json(['message' => 'catogary updated successfully'],201);
         // tested route //
    }


    public function showcategory($id){

      return  $this->category_controller->show($id);
       // tested route //
    }

    public function deletecategory($id)
    {
        $this->category_controller->destroy($id);
        return response()->json(['message' => 'catogary deleted successfully'],201);

             // tested route //
    }

    public function getallcategory()
{
    return $this->category_controller->getall();
    //tested Route  //
}

    public function Addsubcategory(Request $request){

        $this->sub_category_controller->store($request);

        return response()->json(['message' => 'Subcategory added successfully'], 201);
//
    }


    public function showsubcategory($id){

        $this->sub_category_controller->show($id); //

    }




    public function updatesubcategory(Request $request ,$id){

        $this->sub_category_controller->update($request,$id);
        return response()->json(['message' => 'subcategory updated successfully'],201);
        //
    }

    public function deletesubcategory($id)
    {
        $this->sub_category_controller->destroy($id);
        return response()->json(['message' => 'catogary deleted successfully'],201);
        //
    }

    public function getallproduct()
    {
      return  $this->product_controller->getall();
      //
    }


    public function Updateproductquantity(Request $request ,$id)
{
    $this->product_controller->updatequantity($request , $id);

    // leha Route !!
}



}



