<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller

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

        $sales = Sales::latest()->get();

        return view('sales.index', compact('sales'));
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

        /**
         *   Here we can fetch necessary data for the sales creation form, such as available products, stock levels, etc.
         *      Feature:
         *      Product fetching from Prodcut Table
         */

        $stockData = Stock::where('status', 1)->get();



        return view('sales.create', compact('stockData'));
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

             Status codes:
                    1 => Pending
                    2 => In Progress
                    3 => Completed  (Currently hardcoded, in future this will be handled via the 'Approve' //button by admin)


         */

        // dd($request->all());


        $validation = Validator::make($request->all(), [
            'product_id'   => 'required',
            'quantity'     => 'required|numeric|min:0',
            'unit_price'        => 'required|numeric|min:0',

        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }

        $newSales = new Sales();
        // $newStock->product_id = $request->input('product_id'); // 
        $newSales->stock_id = $request->input('product_id'); // For simplicity, using product name instead of ID
        $newSales->unit_price = $request->input('unit_price');
        $newSales->quantity = $request->input('quantity');
        $newSales->vat = $request->input('vat_percent');
        $newSales->discount = $request->input('discount');
        $newSales->total_price = $request->input('total_price');
        $newSales->paid_amount = $request->input('paid_amount');
        $newSales->due_amount = $request->input('due_amount');
        $newSales->quantity = $request->input('quantity');
        $newSales->status = 3; // 3 means 'Completed' for simplicity


        $newSales->save();

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
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
