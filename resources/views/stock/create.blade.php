@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Stock Entry</h4>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <!-- Stock Form -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Product -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product</label>
                        <select name="product_id" class="form-select">
                            <option value="">Select Product</option>

                            <option value="Laptop">Laptop</option>
                            <option value="Mouse">Mouse</option>
                            <option value="Keyboard">Keyboard</option>
                            <option value="Monitor">Monitor</option>
                            <option value="Printer">Printer</option>

                        </select>
                    </div>

                    <!-- Stock Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock Type</label>
                        <select name="type" class="form-select">
                            <option value="in">Stock In</option>
                            <option value="out">Stock Out</option>
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" placeholder="Enter quantity">
                    </div>

                    <!-- Unit Price -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Unit Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter price">
                    </div>
                    <!-- Sales Price -->
                     <div class="col-md-4 mb-3">
                        <label class="form-label">Sales Price</label>
                        <input type="number" step="0.01" name="sales_price" class="form-control" placeholder="Enter sales price">
                    </div>
                   
                    <!-- Date -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>

                    <!-- Reference -->
                   {{-- <div class="col-md-6 mb-3">
                        <label class="form-label">Reference No</label>
                        <input type="text" name="reference" class="form-control" placeholder="Invoice / Note">
                    </div> --}}

                    <!-- Warehouse -->
                  {{--  <div class="col-md-6 mb-3">
                        <label class="form-label">Warehouse</label>
                        <select name="warehouse_id" class="form-select">
                            <option value="">Select Warehouse</option>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <!-- Note -->
                  {{--  <div class="col-md-12 mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" rows="3" class="form-control"></textarea>
                    </div> --}}

                </div>

                <!-- Buttons -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check"></i> Save Stock
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection