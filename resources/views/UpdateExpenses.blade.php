<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Expenses</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            font-size: 16px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
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
            padding: 10px;
            font-size: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select {
            width: 100%;
            padding: 10px;
            font-size: 20px;
        }
        textarea{
            width: 100%;
            font-size: 20px;
            font-family: Arial, sans-serif;
        }
        .form-group input:focus {
            border-color: #007bff;
        }
        .btn{
            width: 90px;
            height: 44px;
            background-color: #000000;
            color: #f0f0f0;
            font-size: 18px;
            margin-left: 40%;
            border-radius: 5px;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 10px;
            }

            .form-group input {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    
    <div class="form-container">
        <div class="form-header">
            <h2>Update Expenses</h2>
        </div>
        <form action="{{ route('ExpensesPage.update', $expense->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="E_Name">Name</label>
                <input type="text" id="E_Name" name="E_Name" class="form-control" value="{{ old('E_Name', $expense->E_Name) }}" required>
            </div>
            <div class="form-group">
                <label for="E_Type">Type</label>
                <select id="E_Type" name="E_Type" class="form-control" required>
                    <option value="رستوران" {{ old('E_Type', $expense->E_Type) == 'رستوران' ? 'selected' : '' }}>رستوران</option>
                    <option value="کارمندان" {{ old('E_Type', $expense->E_Type) == 'کارمندان' ? 'selected' : '' }}>کارمندان</option>
                    <option value="بل برق" {{ old('E_Type', $expense->E_Type) == 'بل برق' ? 'selected' : '' }}>بل برق</option>
                    <option value="کرایه" {{ old('E_Type', $expense->E_Type) == 'کرایه' ? 'selected' : '' }}>کرایه</option>
                    <option value="و غیره" {{ old('E_Type', $expense->E_Type) == 'و غیره' ? 'selected' : '' }}>و غیره</option>
                </select>
            </div>
            <div class="form-group">
                <label for="E_Description">Description</label>
                <textarea id="E_Description" name="E_Description" class="form-control" required>{{ old('E_Description', $expense->E_Description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="E_Amount">Amount</label>
                <input type="number" id="E_Amount" name="E_Amount" class="form-control" value="{{ old('E_Amount', $expense->E_Amount) }}" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <a href="{{url('/ExpensesPage')}}"> <button class="btn">Cancel</button> </a>
    </div>
</body>
</html>
