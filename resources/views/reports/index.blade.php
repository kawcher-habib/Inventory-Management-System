@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Filter Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('reports.index') }}">
                <div class="row align-items-end">

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Start Date</label>
                        <input type="date"
                               name="start_date"
                               class="form-control"
                               value="{{ request('start_date') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">End Date</label>
                        <input type="date"
                               name="end_date"
                               class="form-control"
                               value="{{ request('end_date') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filter Report
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Summary Section -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <h6>Total Sales</h6>
                    <h4>{{ $totalSales }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <h6>Total Paid</h6>
                    <h4>{{ $totalPaid }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-warning text-dark">
                <div class="card-body">
                    <h6>Total Due</h6>
                    <h4>{{ $totalDue }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-dark text-white">
                <div class="card-body">
                    <h6>Profit</h6>
                    <h4>{{ $profit }}</h4>
                </div>
            </div>
        </div>

    </div>


    <!-- Sales Table -->
    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">Sales Report</h5>

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($sales as $index => $sale)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sale->created_at->format('d M Y') }}</td>
                            <td>{{ $sale->unit_price }}</td>
                            <td>{{ $sale->total_price }}</td>
                            <td>{{ $sale->paid_amount }}</td>
                            <td>{{ $sale->due_amount }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No sales found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection