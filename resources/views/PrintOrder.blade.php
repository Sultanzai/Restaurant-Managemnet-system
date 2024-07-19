<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }
        .receipt {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .order-info {
            margin-bottom: 20px;
        }
        .order-info p {
            margin: 0;
            padding: 5px 0;
            word-wrap: break-word; /* Ensure long text breaks properly */
            overflow-wrap: break-word; /* Ensure long text breaks properly */
            border-bottom: 1px solid #ddd;
        }
        .order-details {
            margin-bottom: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .order-details th, .order-details td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .order-details th {
            background-color: #f1f1f1;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #161616;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .buttons button:hover {
            background-color: #353535;
        }
        .buttons .back-button {
            background-color: #131313;
        }
        .buttons .back-button:hover {
            background-color: rgb(63, 63, 63);
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>Order Receipt</h1>
        </div>

        @if ($orderDetails->isNotEmpty())
            @php
                $order = $orderDetails->first();
            @endphp

            <div class="order-info">
                <p><strong>Order Name:</strong> {{ $order->O_Name }}</p>
                <p><strong>Status:</strong> {{ $order->O_Status }}</p>
                <p><strong>Description:</strong> {{ $order->O_Description }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
            </div>

            <table class="order-details">
                <thead>
                    <tr>
                        <th>Menu Item</th>
                        <th>Units</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->m_Name }}</td>
                            <td>{{ $detail->OD_Units }}</td>
                            <td>{{ $detail->OD_Price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="footer">
                <p>Thank you for your order!</p>
            </div>
        @else
            <p>No order details found.</p>
        @endif

        <div class="buttons">
            <button onclick="window.print()">Print Receipt</button>
            <button class="back-button" onclick="window.location.href='/OrderPage'">Back to Order Page</button>
        </div>
    </div>
</body>
</html>
