<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\Sales;
use Illuminate\Http\Request;

class JournalController extends Controller
{

    public function index(Request $request)
    {
        $query = Sales::latest();

        if($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }


        // Total Sales Amount (Final sale after VAT/discount)
        $totalSales = $query->sum('total_price');

        // Total Paid
        $totalPaid = $query->sum('paid_amount');

        // Total Due
        $totalDue = $query->sum('due_amount');

        // Total Unit Price Value
        $totalUnitPrice = $query->sum('unit_price');

        // Profit (Simplified)
        $profit = $totalSales - $totalUnitPrice ; // since no expense table used
        $sales = $query->get();

        return view('reports.index', compact(
            'sales',
            'totalSales',
            'totalPaid',
            'totalDue',
            'totalUnitPrice',
            'profit'
        ));
    }

    public function report(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->toDateString();
        $endDate = $request->end_date ?? now()->toDateString();

        $totalSales = Journal::where('type', 'sale')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('credit');

        $totalExpenses = Journal::where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('debit');

        return view('reports.financial', compact('totalSales', 'totalExpenses', 'startDate', 'endDate'));
    }
}
