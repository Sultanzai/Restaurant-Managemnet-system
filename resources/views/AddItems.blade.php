<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item Form</title>
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
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select {
            width: 100%;
            padding: 10px;
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
        .hidden {
            display: none;
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
            <h2>Add Item</h2>
        </div>
        <form action="/AddItems" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Storage Items</label>
                <select name="storage_id" id="storage_id" required>
                    @foreach($storage as $store)
                        <option value="{{ $store->id }}">{{ $store->s_Name }}</option>
                    @endforeach
                </select>
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
                <select name="status" id="status">
                    <option value="In">In</option>
                    <option value="Out">Out</option>    
                </Select>
            </div>
            <div class="form-group" id="price-group">
                <label for="name">Price</label>
                <input type="text" id="price" name="price">
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Submit</button>
            </div>
        </form>
        <a href="{{url('/StoragePage')}}"> <button class="btn">Cancel</button> </a>
    </div>


    <script>
        document.getElementById('status').addEventListener('change', function() {
            const priceGroup = document.getElementById('price-group');
            if (this.value === 'In') {
                priceGroup.classList.remove('hidden');
            } else {
                priceGroup.classList.add('hidden');
            }
        });

        // Initial check on page load
        document.getElementById('status').dispatchEvent(new Event('change'));
    </script>

</body>
</html>
