@extends('layouts.app')

@section('title', 'Add Sale')

@section('content')
<div class="container mt-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h4 class="mb-0">Add Sale</h4>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('sales.index') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Sales
            </a>
        </div>
    </div>

    {{-- Session Error --}}
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
        @csrf
        <div class="row">

            <!-- Product -->
            <!-- Here Show Product from Stock Table, we can change it to Product Table in future -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Product <span class="text-danger">*</span></label>
                <select name="product_id" id="productSelect" class="form-select" required>
                    <option value="">Select Product</option>
                    @foreach($stockData as $product)
                    <option value="{{ $product->id }}"
                        data-unit="{{ $product->sell_price }}"
                        data-stock="{{ $product->current_stock }}">
                        {{ $product->product_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Quantity -->
            <div class="col-md-2 mb-3">
                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="" required>
            </div>

            <!-- Unit Price -->
            <div class="col-md-2 mb-3">
                <label class="form-label">Unit Price</label>
                <input type="number" name="unit_price" id="unitPrice" class="form-control" readonly>
            </div>

            <!-- Discount -->
            <div class="col-md-2 mb-3">
                <label class="form-label">Discount</label>
                <input type="number" name="discount" id="discount" class="form-control" min="0" value="0">
            </div>

            <!-- VAT -->
            <!-- Here Vat Static, we can change it to Vat or Tax Table in future -->
            <div class="col-md-2 mb-3">
                <label class="form-label">VAT (%)</label>
                <input type="number" name="vat_percent" id="vatPercent" class="form-control" min="0" value="5" readonly>
            </div>

        </div>

        <div class="row">

            <!-- Total Price -->
            <div class="col-md-3 mb-3">
                <label class="form-label">Total Price</label>
                <input type="number" name="total_price" id="totalPrice" class="form-control" readonly>
            </div>

            <!-- Paid Amount -->
            <div class="col-md-3 mb-3">
                <label class="form-label">Paid Amount</label>
                <input type="number" name="paid_amount" id="paidAmount" class="form-control" min="0" value="0">
            </div>

            <!-- Due Amount -->
            <div class="col-md-3 mb-3">
                <label class="form-label">Due Amount</label>
                <input type="number" name="due_amount" id="dueAmount" class="form-control" readonly>
            </div>

            <!-- Status -->
            {{-- <div class="col-md-3 mb-3">
                <label class="form-label d-block">Status</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" checked>
                    <label class="form-check-label" for="statusSwitch">Completed</label>
                </div>
            </div> --}}

        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Save Sale
        </button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productSelect = document.getElementById('productSelect');
        const quantityInput = document.getElementById('quantity');
        const unitPriceInput = document.getElementById('unitPrice');
        const discountInput = document.getElementById('discount');
        const vatPercentInput = document.getElementById('vatPercent');
        const totalPriceInput = document.getElementById('totalPrice');
        const paidAmountInput = document.getElementById('paidAmount');
        const dueAmountInput = document.getElementById('dueAmount');

        function getNumericValue(input) {
            // Convert input to number, default 0
            return Math.round(parseFloat(input?.value) || 0);
        }

        function calculateSale() {
            const unitPrice = getNumericValue(unitPriceInput);
            const quantity = parseInt(quantityInput?.value) || 0;
            const discount = getNumericValue(discountInput); // optional
            const vatPercent = getNumericValue(vatPercentInput);
            const paidAmount = getNumericValue(paidAmountInput);

            let subtotal = unitPrice * quantity - discount;
            const vatAmount = Math.round(subtotal * (vatPercent / 100));
            const total = subtotal + vatAmount;

            if (totalPriceInput) totalPriceInput.value = total;
            if (dueAmountInput) dueAmountInput.value = total - paidAmount;
        }

        // Product selection change
        if (productSelect) {
            productSelect.addEventListener('change', function() {
                const selected = productSelect.selectedOptions[0];
                unitPriceInput.value = Math.round(selected?.dataset.unit) || 0;
                calculateSale();
            });

            // Initial calculation for first product
            const firstOption = productSelect.selectedOptions[0];
            if (firstOption) {
                unitPriceInput.value = Math.round(firstOption.dataset.unit) || 0;
                calculateSale();
            }
        }

        // Listen to other inputs
        quantityInput?.addEventListener('input', calculateSale);
        discountInput?.addEventListener('input', calculateSale);
        vatPercentInput?.addEventListener('input', calculateSale);
        paidAmountInput?.addEventListener('input', calculateSale);

        // Initial calculation on page load
        calculateSale();
    });
</script>
@endsection