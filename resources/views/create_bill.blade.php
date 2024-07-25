<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #000000;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .bill-details {
            margin-bottom: 20px;
        }
        .bill-details .bill-detail {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        .bill-details .bill-detail input {
            flex: 1;
        }
        .add-detail {
            margin-top: 10px;
            cursor: pointer;
            color: #007bff;
        }
        .add-detail:hover {
            text-decoration: underline;
        }
        .total {
            font-size: 1.5em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Bill</h1>
        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        <form action="{{ route('bills.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="B_Number">Bill Number</label>
                <input type="text" name="B_Number" id="B_Number" required>
            </div>
            <div class="form-group">
                <label for="B_Name">Bill Name</label>
                <input type="text" name="B_Name" id="B_Name" required>
            </div>
            <div class="form-group">
                <label for="B_Paid">Bill Paid</label>
                <input type="number" step="0.01" name="B_Paid" id="B_Paid" required>
            </div>
            <div class="form-group">
                <label for="B_Description">Bill Description</label>
                <input type="text" name="B_Description" id="B_Description">
            </div>
            <div class="bill-details" id="bill-details">
                <h3>Bill Details</h3>
                <div class="bill-detail">
                    <input type="text" name="bill_details[0][BD_Name]" placeholder="Name" required>
                    <input type="number" step="0.01" name="bill_details[0][BD_Price]" placeholder="Price" required oninput="calculateTotal()">
                    <input type="number" name="bill_details[0][BD_Unit]" placeholder="Unit" required oninput="calculateTotal()">
                </div>
            </div>
            <div class="add-detail" onclick="addBillDetail()">+ Add Detail</div>
            <div class="total">
                <label for="B_Total">Bill Total: </label>
                <span id="B_Total">0.00</span>
            </div>
            <div class="form-group">
                <button type="submit">Create Bill</button>
            </div>
        </form>
    </div>

    <script>
        let detailIndex = 1;

        function addBillDetail() {
            const billDetails = document.getElementById('bill-details');
            const newDetail = document.createElement('div');
            newDetail.className = 'bill-detail';
            newDetail.innerHTML = `
                <input type="text" name="bill_details[${detailIndex}][BD_Name]" placeholder="Name" required>
                <input type="number" step="0.01" name="bill_details[${detailIndex}][BD_Price]" placeholder="Price" required oninput="calculateTotal()">
                <input type="number" name="bill_details[${detailIndex}][BD_Unit]" placeholder="Unit" required oninput="calculateTotal()">
            `;
            billDetails.appendChild(newDetail);
            detailIndex++;
        }

        function calculateTotal() {
            const billDetails = document.querySelectorAll('.bill-detail');
            let total = 0;

            billDetails.forEach(detail => {
                const price = detail.querySelector('input[name*="[BD_Price]"]').value;
                const unit = detail.querySelector('input[name*="[BD_Unit]"]').value;
                total += (price * unit);
            });

            document.getElementById('B_Total').innerText = total.toFixed(2);
        }
    </script>
</body>
</html>
