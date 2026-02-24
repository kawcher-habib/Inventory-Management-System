<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\Sales;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
         *   Task: 1,
         *  TODO: Implement Role-Based Access Control (RBAC) to restrict access to this method  based on user permissions.
         * 
         
        $user = auth()->user();

        if (!$user || !in_array('create_stock', $user->permissions ?? [])) {
            return redirect()->route('stocks.index')
                ->with('error', 'You do not have permission to create stock.');
        }

        Task: 2,
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

        $productIsAvailable = Stock::where('id', $request->product_id)
            ->where('opening_stock', '>=', $request->quantity)
            ->exists();

        if (!$productIsAvailable) {
            return redirect()->back()
                ->with('error', 'Insufficient stock available.');
        }

        DB::transaction(function () use ($request) {
            // 1. Save Sale
            $sale = Sales::create([
                'stock_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'discount' => $request->discount ?? 0,
                'vat' => $request->vat_percent,
                'total_price' => $request->total_price,
                'paid_amount' => $request->paid_amount,
                'due_amount' => $request->total_price - $request->paid_amount,
                'status' => 3
            ]);

            // 2. Update Stock
            $stock = Stock::find($request->product_id);
            $stock->opening_stock -= $request->quantity;
            $stock->save();

            // 3. Create Journal Entries
            // Cash/Bank (Debit)
            if ($request->paid_amount > 0) {
                Journal::create([
                    'transaction_date' => now(),
                    'description' => "Cash received for sale #{$sale->id}",
                    'type' => 'sale',
                    'debit' => $request->paid_amount,
                    'credit' => 0
                ]);
            }

            // Accounts Receivable (Debit if due)
            if ($sale->due_amount > 0) {
                Journal::create([
                    'transaction_date' => now(),
                    'description' => "Due amount for sale #{$sale->id}",
                    'type' => 'sale',
                    'debit' => $sale->due_amount,
                    'credit' => 0
                ]);
            }

            // Sales Revenue (Credit)
            Journal::create([
                'transaction_date' => now(),
                'description' => "Sales revenue for sale #{$sale->id}",
                'type' => 'sale',
                'debit' => 0,
                'credit' => $sale->total_price - $sale->vat
            ]);

            // VAT Payable (Credit)
            if ($sale->vat > 0) {
                Journal::create([
                    'transaction_date' => now(),
                    'description' => "VAT collected for sale #{$sale->id}",
                    'type' => 'sale',
                    'debit' => 0,
                    'credit' => $sale->vat
                ]);
            }

            // Sales Discount (Debit)
            if ($sale->discount > 0) {
                Journal::create([
                    'transaction_date' => now(),
                    'description' => "Discount for sale #{$sale->id}",
                    'type' => 'sale',
                    'debit' => $sale->discount,
                    'credit' => 0
                ]);
            }
        });

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
