<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $order_detail_controller;
    protected $product_controller;
    public function __construct()
    {
        $this->order_detail_controller = new OrderDetailsController();
        $this->product_controller = new ProductController();
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
        //
        $order=new Order();
        $order->clientid= $request->get('clientid');
        $order->total= $request->get('total');
        $order->save();
        return $order->id;
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
        $order = Order::find($id);
        return $order;
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
        $order=Order::find($id);
        $order->clientid= $request->get('clientid');
        $order->total= $request->get('total');
        $order->save();
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
        $order_details=$this->order_detail_controller->getorderdetails($id);
        foreach($order_details as $detail)
        {
            $update_quantity_request = new Request();

            $update_quantity_request->merge([
                'quantity'=>$detail['quantity'],
            ]);
            $product = $this->product_controller->updatedeletedquantity($update_quantity_request,$detail['productid']);
        }
        $order = Order::find($id);
        $order->delete();
    }


}
