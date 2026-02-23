@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-4">

        <!-- Title -->
        <div class="col-md-6">
            <h4 class="mb-0">Sales List</h4>
        </div>

        <!-- Add Sale Button -->
        <div class="col-md-6 text-end">
            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-success">
                <i class="bi bi-cart-plus"></i> Add Sale
            </a>
        </div>

    </div>

    <table class="table table-sm table-bordered table-striped table-hover">
        <thead class="table-secondary">
            <tr>
                <th class="text-center">#</th>
                <th>Product</th>
                <th class="text-center">Quantity</th>
                <th class="text-end">Unit Price</th>
                <th class="text-center">Discount</th>
                <th class="text-center">VAT</th>
                <th class="text-end">Total Price</th>
                <th class="text-end">Paid</th>
                <th class="text-end">Due</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $index => $sale)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $sale->stock->product_name ?? 'N/A' }}</td>
                <td class="text-center">{{ $sale->quantity }}</td>
                <td class="text-end">{{ number_format($sale->unit_price) }}</td>
                <td class="text-center">{{ number_format($sale->discount) }}</td>
                <td class="text-center">{{ number_format($sale->vat) }}</td>
                <td class="text-end">{{ number_format($sale->total_price) }}</td>
                <td class="text-end">{{ number_format($sale->paid_amount) }}</td>
                <td class="text-end">{{ number_format($sale->due_amount) }}</td>
                <td class="text-center">
                    @if($sale->status == 3)
                    <span class="badge bg-success">Completed</span>
                    @elseif($sale->status == 1)
                    <span class="badge bg-info">Processing</span>
                    @elseif($sale->status == 2)
                    <span class="badge bg-danger">Cancelled</span>
                    @else
                    <span class="badge bg-warning">Pending</span>
                    @endif
                </td>

                <td class="text-center">

                    <!-- View Sale -->
                    <a href="#" title="Coming Soon" class="btn btn-sm btn-success me-1">
                        <i class="bi bi-eye"></i>
                    </a>

                    <!-- Edit Sale -->
                    <a href="#" title="Coming Soon" class="btn btn-sm btn-primary me-1">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <!-- Delete Sale -->
                    <form action="#" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" title="Comming Soon" onclick="return confirm('Are you sure to delete this sale?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">No sales found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection