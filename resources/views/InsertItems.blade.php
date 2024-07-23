<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
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
            font-size: 16px;
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
            <h2>Insert Storage Item</h2>
        </div>
        <form action="/InsertItems" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="name">Units</label>
                <input type="text" id="unit" name="unit">
            </div>
            <div class="form-group">
                <label for="name">Type</label>
                <input type="text" id="type" name="type">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <Select name="status">
                    <option value="In">In</option>
                    <option value="Out">Out</option>    
                </Select>
            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="text" id="price" name="price">
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Submit</button>
            </div>
        </form>
        <a href="{{url('/StoragePage')}}"> <button class="btn">Cancel</button> </a>
    </div>
</body>
</html>
