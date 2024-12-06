<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $order_controller;
    protected $order_detail_controller;

    protected $product_controller;
    public function __construct()
    {
        $this->order_controller = new OrderController();
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
        $user = new User();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->address = $request->get('address');
        $user->username = $request->get('username');
        $user->roleid = 3;
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

    public function makeOrder (Request $request)
    {

        foreach ($request->details as $detail) {
            $product = $this->product_controller->getproduct($detail['productid']);
            if($product->quantity <$detail['quantity'])
            {
                return response()->json([
                    'msg' => "Quantity of product".$product->name."is low",
                ], 302);
            }

        }

        $orderRequest = new Request();
        $orderRequest->merge([
            'clientid' => $request->get('clientid'),
            'total' => $request->get('total')]
        );

        $last_id = $this->order_controller->store($orderRequest);
        foreach ($request->details as $detail) {
            $order_detail_request = new Request();
            $update_quantity_request = new Request();
            $order_detail_request->merge([
                'orderid' => $last_id,
                'productid'=>$detail['productid'],
                'quantity'=>$detail['quantity'],
                'totalprice'=>$detail['totalprice'],
            ]);
            $update_quantity_request->merge([
                'quantity'=>$detail['quantity'],
            ]);
            $this->product_controller->updatequantity($order_detail_request,$detail['productid']);
            $this->order_detail_controller->store($order_detail_request);
        }
        return response()->json([
            'msg' => "Order has been submitted successfully",
        ], 200);
    }

    public function deleteOrder($id)
    {
        // foreach()
        return$this->order_controller->destroy($id);
    }

}
