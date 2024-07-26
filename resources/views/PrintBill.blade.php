<!DOCTYPE html>
<html>
<head>
    <title>Print Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
        }
        .bill-container {
            width: 40%;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .bill-header, .bill-footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .bill-header h1 {
            margin: 0;
        }
        .bill-body {
            margin-bottom: 20px;
        }
        .bill-item, .bill-data-item {
            font-size: 22px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            border-bottom: solid 1px #000;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: right;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .update-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            text-align: center;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="bill-container">
        <div class="bill-header">
            <h1>7Eleven</h1>
            <h2>Fast Food & Restaurant </h2>
        </div>
        <div class="bill-body">
            <div class="bill-data-item">
                <label for="bill-number">نمبر: {{ $bill->B_Number }}</label>
                <label for="date">تاریخ: {{ $bill->created_at->format('Y-m-d') }}</label>
            </div>
           
            <div class="bill-data-item">

                <label for="bill-number"> نام مشتری: {{ $bill->B_Name }}</label>
                <label for="bill-number">مجموعه: {{ $bill->B_Total }}</label>
            </div>
            
            <div class="bill-data-item">
                <label for="bill-number">پرداخت: {{ $bill->B_Paid }}</label>
                <label for="details">جزعات: {{ $bill->B_Description }}</label>
            </div>
           
            <div class="bill-data-item">
            </div>

            <h3>خریداری ها</h3>
            <table>
                <thead>
                    <tr>
                        <th>نام</th>
                        <th>قیمت</th>
                        <th>تعداد</th>
                        <th>مجموعه</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($billdetail as $detail)
                        <tr>
                            <td>{{ $detail->BD_Name }}</td>
                            <td>{{ $detail->BD_Price }}</td>
                            <td>{{ $detail->BD_Unit }}</td>
                            <td>{{ $detail->BD_Unit * $detail->BD_Price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bill-footer">
            <div class="update-button" onclick="window.print()">Print</div>
        </div>
    </div>
</body>
</html>
