@extends('user.layouts.layout')

@section('title', 'Purchase History')

@section('content')

    <main class="container my-4">
        <h2>Purchase History</h2>
        @if($purchases->isNotEmpty())
            <table class="table table-bordered purchase-history-table">
                <thead>
                    <tr>
                        <th>Purchase Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_created_at)->format('F j, Y, g:i a') }}</td>
                            <td>
                                <ul>
                                    @foreach($purchase->orderItems as $item)
                                        <li>
                                            {{ $item->product->name ?? 'Product deleted' }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $purchase->total_quantity }}</td>
                            <td class="price-column">Rp {{ number_format($purchase->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-purchase-message">No purchase history available.</p>
        @endif
    </main>


    <style>
        /* Styling untuk tabel pembelian */
        .purchase-history-table {
            width: 100%;
            margin-top: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .purchase-history-table th,
        .purchase-history-table td {
            padding: 1rem;
            text-align: left;
            border-top: 1px solid #dee2e6;
        }

        .purchase-history-table th {
            background-color: #007bff;
            color: white;
        }

        .purchase-history-table td {
            border-bottom: 1px solid #dee2e6;
        }

        .purchase-history-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .purchase-history-table .price-column {
            text-align: right;
            font-weight: bold;
        }

        /* Styling untuk judul halaman */
        h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #007bff;
        }

        /* Styling untuk pesan jika tidak ada data pembelian */
        .no-purchase-message {
            font-size: 1.1rem;
            color: #6c757d;
            text-align: center;
            margin-top: 20px;
        }
    </style>

@endsection