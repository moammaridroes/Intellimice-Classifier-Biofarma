@extends('layouts.app')

@section('content')
<!-- INI GA KEPAKE -->
<div class="container">
    <div class="card">
        <div class="card-header">
            Invoice
        </div>
        <div class="card-body">
            <h5 class="card-title">Order Details</h5>
            <p><strong>Fullname:</strong> {{ $order->fullname }}</p>
            <p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Item Name:</strong> {{ $order->item_name }}</p>
            <p><strong>Agency Name:</strong> {{ $order->agency_name }}</p>
            <p><strong>Operator Name:</strong> {{ $order->operator_name }}</p>
            <p><strong>Weight:</strong> {{ $order->weight }} gr</p>
            <p><strong>Male Quantity:</strong> {{ $order->male_quantity }}</p>
            <p><strong>Female Quantity:</strong> {{ $order->female_quantity }}</p>
            <h5 class="card-text">Total Price: Rp {{ number_format($order->total_price, 0, ',', '.') }}</h5>

            <!-- Tombol Bayar -->
            @if (!$order->is_paid)
                <form action="{{ route('order.payment', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </form>
            @else
                <button class="btn btn-success" disabled>Paid</button>
            @endif
        </div>
    </div>
</div>
@endsection
