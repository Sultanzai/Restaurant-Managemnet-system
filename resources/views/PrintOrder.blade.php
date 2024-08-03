<!DOCTYPE html>
<html dir="rtl">
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
            padding: 5px;
            border: 1px solid #ddd;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .img {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
        }
        .img img {
            max-width: 150px;
            height: auto;
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
            width: 100%;
            text-align: right;
            float: right;
        }
        .order-info p {
            margin: 0;
            padding: 5px 0;
            word-wrap: break-word; /* Ensure long text breaks properly */
            overflow-wrap: break-word; /* Ensure long text breaks properly */
            border-bottom: 1px solid #000000;
        }
        .order-details {
            margin-bottom: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .order-details th, .order-details td {
            padding: 2px;
            border: 1px solid #000000;
            text-align: right;
        }
        .order-details th {
            background-color: #f1f1f1;
        }
        .order-details .item-number {
            width: 20px;
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
            transition: 0.3s;
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
        @media print {
            .buttons {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>Order Receipt</h1>
        </div>
        <div class="img">
            <img src="{{ asset('css/logo.png') }}" alt="Logo">
        </div>

        @if ($orderDetails->isNotEmpty())
            @php
                $order = $orderDetails->first();
            @endphp

            <div class="order-info">
                <p><strong>نام:</strong> {{ $order->O_Name }}</p>
                <p><strong>حالت پرداخت:</strong> {{ $order->O_Status }}</p>
                <p><strong>جزیات:</strong> {{ $order->O_Description }}</p>
                <p><strong>تاریخ:</strong> {{ $order->created_at }}</p>
            </div>

            <table class="order-details">
                <thead>
                    <tr>
                        <th class="item-number">شماره</th>
                        <th>نام</th>
                        <th>تعداد</th>
                        <th>قیمت</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $count = 1;
                    @endphp
                    @foreach ($orderDetails as $detail)
                        @php
                            $total += $detail->OD_Price;
                        @endphp
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $detail->m_Name }}</td>
                            <td>{{ $detail->OD_Units }}</td>
                            <td>{{ $detail->OD_Price }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>مجموع</strong></td>
                        <td><strong>{{ $total }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            <div class="footer">
                <p>از سفارش شما متشکریم</p>
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
