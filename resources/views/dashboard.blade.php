@extends('layouts.app')

@section('content')

<h3 class="mb-4">Dashboard</h3>

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card p-3 bg-primary text-white">
            <h5>Total Products</h5>
            <h3>120</h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card p-3 bg-success text-white">
            <h5>Total Sales</h5>
            <h3>$5,200</h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card p-3 bg-warning text-white">
            <h5>Low Stock</h5>
            <h3>8</h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card p-3 bg-danger text-white">
            <h5>Out of Stock</h5>
            <h3>3</h3>
        </div>
    </div>

</div>

@endsection