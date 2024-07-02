<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سیستم سفارش رستوران</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: "Inter", Helvetica;
            font-size: 24px;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            direction: rtl;
            text-align: right;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #555;
        }
        input, select, button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #545454;
            color: #fff;
            cursor: pointer;
            font-size: 22px;
        }
        button:hover {
            background-color: #545454;
        }
        .food-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .food-item select {
            width: 200px;
            font-size: 16px;
        }
        .total-price {
            text-align: right;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>اضافه کردن سفارش مشتری</h1>
    <form id="orderForm">
        <label for="customerName">نام مشتری</label>
        <input type="text" id="customerName" name="customerName" required>

        <label for="orderStatus">وضعیت سفارش</label>
        <select id="orderStatus" name="orderStatus">
            <option value="pending">در انتظار</option>
            <option value="confirmed">تایید شده</option>
            <option value="completed">تکمیل شده</option>
        </select>

        <h2>انتخاب غذاها</h2>
        <div id="foodList">
            <div class="food-item">
                <label>نام غذا</label>
                <select name="foodName" class="foodName" onchange="updateUnits(this); updateTotalPrice();">
                    <option value="Pizza" data-price="10" data-units='["Whole"]'>پیتزا   </option>
                    <option value="Burger" data-price="5" data-units='["Small 60","Medium 80","Large 120"]'>برگر  </option>
                    <option value="Juice" data-price="3" data-units='["Small 80","Medium 120","Large 200"]'>آبمیوه  </option>
                    <option value="Chicken Wings" data-price="7" data-units='["1 Package 200 ","2 Packages 360","3 Packages 500"]'>بال مرغ  </option>
                </select>

                <label>واحد</label>
                <select name="foodUnit" class="foodUnit" onchange="updateTotalPrice()">
                    <!-- Options will be dynamically generated -->
                </select>

                <button type="button" onclick="removeFoodItem(this)">حذف</button>
            </div>
        </div>
        <button type="button" onclick="addFoodItem()">اضافه کردن غذای بیشتر</button>

        <div class="total-price">
            قیمت کل: <span id="totalPrice">0</span>
        </div>

        <button type="submit">ثبت سفارش</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeUnits();
    });

    function initializeUnits() {
        const foodItems = document.querySelectorAll('.food-item');
        foodItems.forEach(item => {
            updateUnits(item.querySelector('.foodName'));
        });
        updateTotalPrice();
    }

    function addFoodItem() {
        const foodList = document.getElementById('foodList');
        const foodItem = document.createElement('div');
        foodItem.className = 'food-item';
        foodItem.innerHTML = `
            <label>نام غذا</label>
            <select name="foodName" class="foodName" onchange="updateUnits(this); updateTotalPrice();">
                    <option value="Pizza" data-price="10" data-units='["Whole"]'>پیتزا   </option>
                    <option value="Burger" data-price="5" data-units='["Small 60","Medium 80","Large 120"]'>برگر  </option>
                    <option value="Juice" data-price="3" data-units='["Small 80","Medium 120","Large 200"]'>آبمیوه  </option>
                    <option value="Chicken Wings" data-price="7" data-units='["1 Package 200 ","2 Packages 360","3 Packages 500"]'>بال مرغ  </option>
            </select>

            <label>واحد</label>
            <select name="foodUnit" class="foodUnit" onchange="updateTotalPrice()">
                <!-- Options will be dynamically generated -->
            </select>

            <button type="button" onclick="removeFoodItem(this)">حذف</button>
        `;
        foodList.appendChild(foodItem);
        updateUnits(foodItem.querySelector('.foodName'));
        updateTotalPrice();
    }

    function removeFoodItem(button) {
        button.parentElement.remove();
        updateTotalPrice();
    }

    function updateUnits(foodSelect) {
        const selectedOption = foodSelect.options[foodSelect.selectedIndex];
        const units = JSON.parse(selectedOption.dataset.units);
        const unitSelect = foodSelect.closest('.food-item').querySelector('.foodUnit');
        unitSelect.innerHTML = units.map(unit => `<option value="${unit}">${unit}</option>`).join('');
    }

    function updateTotalPrice() {
        let totalPrice = 0;
        const foodItems = document.querySelectorAll('.food-item');
        foodItems.forEach(item => {
            const foodName = item.querySelector('.foodName');
            const price = parseFloat(foodName.options[foodName.selectedIndex].dataset.price);
            totalPrice += price;
        });
        document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
    }

    document.getElementById('orderForm').addEventListener('submit', function(event) {
        event.preventDefault();
        alert('سفارش با موفقیت ثبت شد!');
    });
</script>

</body>
</html>
