<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #000000;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            color: #000;
            background-color: #f0f0f0;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #e0e0e0;
        }
        .btn-print {
            float: right;
        }
        .form-group {
            margin-bottom: 15px;
            width: 300px;
            padding: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .set{
            display: flex;
            align-items: space;
            width: 100%;
            text-align: left;
        }
        @media print {
            .btn, .btn-back, .form-group {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Report Page</h1>
        <form id="filter-form">
            <div class="set">
                <div class="form-group">
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search">
                </div>
                <div class="form-group">
                    <label for="Paymment_type">Payment Type:</label>
                    <select id="Paymment_type" name="Paymment_type">
                        <option value="">All</option>
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                    </select>
                </div>
            </div>
            <div class="set">
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date">
                </div>
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date">
                </div>
            </div>

            <button type="button" class="btn" onclick="filterExpenses()">Filter</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Menu</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody id="expense-table-body">
                @foreach($orderDetails as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->O_Name }}</td>
                    <td>{{ $order->m_Name }}</td>
                    <td>{{ $order->OD_Units }}</td>
                    <td>{{ $order->OD_Price }}</td>
                    <td>{{ $order->O_Status }}</td>
                    <td>{{ $order->O_Description }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total Amount: <span id="total-amount">{{ $totalAmount }}</span></h3>
        <a href="javascript:window.print()" class="btn btn-print">Print</a>
        <a href="{{ url()->previous() }}" class="btn btn-back">Back</a>
    </div>

    <script>
        function filterExpenses() {
            const search = document.getElementById('search').value.toLowerCase();
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const paymentType = document.getElementById('Paymment_type').value.toLowerCase();
            const tableBody = document.getElementById('expense-table-body');
            const rows = tableBody.getElementsByTagName('tr');
            let totalAmount = 0;

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                const name = cells[1].innerText.toLowerCase();
                const type = cells[5].innerText.toLowerCase();
                const amount = parseFloat(cells[4].innerText);
                const createdAt = new Date(cells[7].innerText);

                let showRow = true;

                if (search && !name.includes(search)) {
                    showRow = false;
                }

                if (startDate && createdAt < new Date(startDate)) {
                    showRow = false;
                }

                if (endDate && createdAt > new Date(endDate)) {
                    showRow = false;
                }

                if (paymentType && type !== paymentType) {
                    showRow = false;
                }

                if (showRow) {
                    rows[i].style.display = '';
                    totalAmount += amount;
                } else {
                    rows[i].style.display = 'none';
                }
            }

            document.getElementById('total-amount').innerText = totalAmount.toFixed(2);
        }
    </script>
</body>
</html>
