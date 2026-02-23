@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-4">

        <!-- Title -->
        <div class="col-md-6">
            <h4 class="mb-0">Sales List</h4>
        </div>

        <!-- Add Stock Button -->
        <div class="col-md-6 text-end">
            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-success">
                <i class="bi bi-box-seam"></i> Add Sales
            </a>
        </div>

    </div>



    <table class="table table-sm table-bordered table-striped table-hover">
        <thead class="table-secondary">
            <tr>
                <th class="text-center">#</th>
                <th>Product Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-end">Unit Price</th>
                <th class="text-end">Sales Price</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stockData as $index => $product)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $product->product_name }}</td>
                <td class="text-center">{{ $product->quantity ?? 0 }}</td>
                <td class="text-center">{{ $product->opening_stock ?? 0 }}</td>
                <td class="text-end">{{ number_format($product->purchase_price) }}</td>
                <td class="text-end">{{ number_format($product->sell_price) }}</td>
                <td class="text-center">
                    @if($product->status == 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>

                <td class="text-center">

                    <!-- View stock -->
                    <a href="#" title="Coming Soon" class="btn btn-sm btn-success">
                        <i class="bi bi-eye"></i>
                    </a>

                    <!-- Edit stock -->
                    <a href="#" title="Coming Soon" class="btn btn-sm btn-primary">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <!-- Delete stock -->
                    <form action="#" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" title="Coming Soon" onclick="return confirm('Delete stock?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection