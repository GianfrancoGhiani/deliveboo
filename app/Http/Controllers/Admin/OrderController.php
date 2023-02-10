<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index(Request $request)
    {
        //
        // dd(Order::all());
        $dateOrder = $request->input('dateOrder');
        $dateSelect = $request->input('dateSelect');
        // dd($dateSelect);
        $orders = Order::where('restaurant_id', Auth::user()->restaurant->id)
            ->when($dateOrder, function ($query, $dateOrder) {
                $query->orderby('updated_at', $dateOrder);
            }, function ($query) {
                $query->orderby('updated_at', 'desc');
            })
            ->when($dateSelect, function ($query, $dateSelect) {
                $query->whereDate('updated_at', $dateSelect);
            })
            ->get();
        if ($orders) {
            return view('admin.orders.index', compact('orders'));
        }
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     *
     */
    public function store(StoreOrderRequest $request)
    {


        //inizializziamo la creazione del prodotto
        $neworder = new Order();

        //passiamo i dati convalidati dalla request creata "StoreProductRequest"
        $neworder->customer_firstname = $request->customer_firstname;
        $neworder->customer_lastname = $request->customer_lastname;
        $neworder->customer_email = $request->customer_email;
        $neworder->customer_address = $request->customer_address;
        // $neworder->available = $request->available;
        // $neworder->discount = $request->discount;
        // $neworder->restaurant_id = Auth::id();


        // $neworder->save();

        // return redirect()->action([ProductController::class, 'index'])->with('message', "$newproduct->name created");
    }

    public function show(Order $order)
    {
        $restaurantId = Auth::id();

        $tempOrder = Order::where('id', $order->id)->where('restaurant_id', $restaurantId)->with('products')->first();

        if ($tempOrder) {

            $order = $tempOrder;
            // $products = 
            return view('admin.orders.show', compact('order'));
        } else {

            //se non esiste il prodotto ritorniamo una pagina 404 not found
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     *
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * 
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Order $order)
    {
        //
    }
}
