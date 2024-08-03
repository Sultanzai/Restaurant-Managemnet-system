<!DOCTYPE html>
<html>
<head>
    <title>Print Bill</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        
        body {
            font-family: 'Roboto', sans-serif;
            direction: rtl;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .bill-container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .bill-header {
            background-color: #1b1b1b;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .bill-header h1 {
            margin: 0;
            font-size: 28px;
        }

        .bill-header h2 {
            margin: 0;
            padding: 10px;
            font-size: 18px;
        }

        .img {
            text-align: center;
            margin-top: 20px;
        }
        img{
            height: 100px;
        }

        .img img {
            max-width: 100px;
        }

        .bill-body {
            padding: 20px;
        }

        .bill-data-item {
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 16px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: right;
        }

        th {
            background-color: #f8f9fa;
        }

        .total {
            text-align: right;
            font-size: 1.5em;
            margin-top: 20px;
        }

        .update-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #1b1b1b;
            color: #fff;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
            margin: 20px 20px;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .update-button:hover {
            background-color: #3a3a3a;
        }

        @media print {
            .update-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="bill-container">
        <div class="bill-header">
            <h2>Fast Food & Restaurant</h2>
        </div>
        <div class="img">
            <img src="{{ asset('css/logo.png') }}" alt="Logo">
        </div>
        <div class="bill-body">
            <div class="bill-data-item">
                <span>نمبر: {{ $bill->B_Number }}</span>
                <span>تاریخ: {{ $hijriDate }}</span>
            </div>
            <div class="bill-data-item">
                <span>نام مشتری: {{ $bill->B_Name }}</span>
                <span>مجموعه: {{ $bill->B_Total }}</span>
            </div>
            <div class="bill-data-item">
                <span>جزعات: {{ $bill->B_Description }}</span>
                <span>پرداخت: {{ $bill->B_Paid }}</span>
            </div>

            <h3>خریداری ها</h3>
            <table>
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>نام</th>
                        <th>قیمت</th>
                        <th>تعداد</th>
                        <th>مجموعه</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1
                    @endphp
                    @foreach ($billdetail as $detail)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $detail->BD_Name }}</td>
                            <td>{{ $detail->BD_Price }}</td>
                            <td>{{ $detail->BD_Unit }}</td>
                            <td>{{ $detail->BD_Unit * $detail->BD_Price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bill-footer">
            <a class="update-button" onclick="window.print()">Print</a>
        </div>
    </div>
</body>
</html>
