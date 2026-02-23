<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * 
         *  TODO: Implement Role-Based Access Control (RBAC) to restrict access to this method  based on user permissions.
         * 
         
        $user = auth()->user();

        if (!$user || !in_array('list_stock', $user->permissions ?? [])) {
            return redirect()->route('stocks.index')
                ->with('error', 'You do not have permission to list stock.');
        }

         */

        $stockData = Stock::latest()->get();

        return view('stock.index', compact('stockData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * 
         *  TODO: Implement Role-Based Access Control (RBAC) to restrict access to this method  based on user permissions.
         * 
         
        $user = auth()->user();

        if (!$user || !in_array('create_stock', $user->permissions ?? [])) {
            return redirect()->route('stocks.index')
                ->with('error', 'You do not have permission to create stock.');
        }

        $products = Product::all();
        $warehouses = Warehouse::all();

         */




        return view('stock.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**
         *
         *  TODO: Implement Role-Based Access Control (RBAC) to restrict access to this method  based on user permissions.
         * 
         
        $user = auth()->user();

        if (!$user || !in_array('create_stock', $user->permissions ?? [])) {
            return redirect()->route('stocks.index')
                ->with('error', 'You do not have permission to create stock.');
        }

         */

        // dd($request->all());


        $validation = Validator::make($request->all(), [
            'product_id'   => 'required',
            'quantity'     => 'required|numeric|min:0',
            'price'        => 'required|numeric|min:0',
            'sales_price'  => 'required|numeric|min:0',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }

        $newStock = new Stock();
        // $newStock->product_id = $request->input('product_id'); // 
        $newStock->product_name = $request->input('product_id'); // For simplicity, using product name instead of ID
        $newStock->purchase_price = $request->input('price');
        $newStock->sell_price = $request->input('sales_price');
        $newStock->quantity = $request->input('quantity');
        $newStock->opening_stock = $request->input('opening_stock');
        $newStock->status = $request->input('status');

        $newStock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
