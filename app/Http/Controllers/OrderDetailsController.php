<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;


class OrderDetailsController extends Controller
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
        //\
        $detail = new OrderDetails();
        $detail->orderid =$request->get('orderid');
        $detail->productid =$request->get('productid');
        $detail->quantity =$request->get('quantity');
        $detail->totalprice =$request->get('totalprice');
        $detail->save();

        $order = Order::find($request->get('orderid'));

        $main_order_details = OrderDetails::where('orderid',$request->get('orderid'))->get();
        $total=0;
        foreach ($main_order_details as $order_detail) {
            $total=$total+$order_detail->totalprice;
        }
        $order->totalprice=$total;
        $order->save();

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
        $detail = OrderDetails::find($id);
        return $detail;
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
        $detail=OrderDetails::find($id);
        $detail->orderid =$request->get('orderid');
        $detail->productid =$request->get('productid');
        $detail->quantity =$request->get('quantity');
        $detail->totalprice =$request->get('totalprice');
        $detail->save();

        $order = Order::find($request->get('orderid'));

        $main_order_details = OrderDetails::where('orderid',$request->get('orderid'))->get();
        $total=0;
        foreach ($main_order_details as $order_detail) {
            $total=$total+$order_detail->totalprice;
        }
        $order->totalprice=$total;
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
        $detail=OrderDetails::find($id);
        $orderid=$detail->orderid;
        $detail->delete();

        $order = Order::find($orderid);

        $main_order_details = OrderDetails::where('orderid',$orderid)->get();
        $total=0;
        foreach ($main_order_details as $order_detail) {
            $total=$total+$order_detail->totalprice;
        }
        $order->totalprice=$total;
        $order->save();
    }


}
