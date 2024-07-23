<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        h1 {
            color: #333;
        }
        .category-nav {
            margin-bottom: 20px;
            background-color: #333;
            border-radius: 5px;
        }
        .category-nav .nav-link {
            color: #fff;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .category-nav .nav-link:hover,
        .category-nav .nav-link.active {
            background-color: #fff;
            color: #333;
        }
        .menu-items {
            display: none;
        }
        .menu-items.active {
            display: block;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .menu-item {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
        .cart-items {
            margin-top: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #333;
            border-color: #333;
        }
        .btn-primary:hover {
            background-color: #555;
            border-color: #555;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Order</h1>
        <a href="{{ route('OrderPage') }}" style="margin-left:1000px;"><button class="btn btn-primary">Back</button></a>

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            <br>
            <ul class="nav category-nav">
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="#{{ $category->m_category }}" onclick="showCategory('{{ $category->m_category }}')">{{ ucfirst($category->m_category) }}</a>
                    </li>
                @endforeach
            </ul>

            @foreach($categories as $category)
                <div id="{{ $category->m_category }}" class="menu-items">
                    <h3>{{ ucfirst($category->m_category) }}</h3>
                    <div class="menu-grid">
                        @foreach($menus->where('m_category', $category->m_category) as $menu)
                            <div class="menu-item" ondblclick="addToCart({{ $menu->id }}, '{{ $menu->m_Name }}', {{ $menu->m_Price }})">
                                {{ $menu->m_Name }} - ${{ number_format($menu->m_Price, 2) }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="cart-items mt-4">
                <h3>Cart</h3>
                <div id="cart" class="list-group">
                    @foreach($order->orderDetails as $detail)
                        <div class="list-group-item cart-item" id="cart-item-{{ $detail->Menu_ID }}">
                            <span>{{ $detail->menu->m_Name }} - $<span class="item-price">{{ number_format($detail->OD_Price, 2) }}</span></span>
                            <input type="hidden" name="items[{{ $detail->Menu_ID }}][Menu_ID]" value="{{ $detail->Menu_ID }}">
                            <input type="hidden" name="items[{{ $detail->Menu_ID }}][OD_Price]" class="item-total-price" value="{{ $detail->OD_Price }}">
                            <input type="number" name="items[{{ $detail->Menu_ID }}][OD_Units]" class="form-control quantity" value="{{ $detail->OD_Units }}" min="1" style="width: 60px; display: inline-block; margin-right: 10px;" onchange="updateTotalPrice(this.closest('.cart-item'), {{ $detail->menu->m_Price }})">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeFromCart({{ $detail->Menu_ID }})">Remove</button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group mt-4">
                <label for="O_Name">Order Name</label>
                <input type="text" name="O_Name" id="O_Name" class="form-control" value="{{ $order->O_Name }}" placeholder="Order Name" required>
            </div>

            <div class="form-group">
                <label for="O_Status">Order Status</label>
                <select name="O_Status" id="O_Status" class="form-control" required>
                    <option value="Paid" {{ $order->O_Status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Unpaid" {{ $order->O_Status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>

            <div class="form-group">
                <label for="O_Description">Order Description</label>
                <textarea name="O_Description" id="O_Description" class="form-control" placeholder="Order Description">{{ $order->O_Description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
            <br><br><br><br><br>
        </form>
    </div>

    <script>
        function showCategory(category) {
            document.querySelectorAll('.menu-items').forEach(function (el) {
                el.classList.remove('active');
            });
            document.getElementById(category).classList.add('active');
            document.querySelectorAll('.nav-link').forEach(function (el) {
                el.classList.remove('active');
            });
            document.querySelector(`.nav-link[href='#${category}']`).classList.add('active');
        }

        function addToCart(id, name, price) {
            const cart = document.getElementById('cart');
            let itemDiv = document.getElementById('cart-item-' + id);

            if (itemDiv) {
                let quantityInput = itemDiv.querySelector('.quantity');
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updateTotalPrice(itemDiv, price);
            } else {
                itemDiv = document.createElement('div');
                itemDiv.className = 'list-group-item cart-item';
                itemDiv.id = 'cart-item-' + id;
                itemDiv.innerHTML = `
                    <span>${name} - $<span class="item-price">${price.toFixed(2)}</span></span>
                    <input type="hidden" name="items[${id}][Menu_ID]" value="${id}">
                    <input type="hidden" name="items[${id}][OD_Price]" class="item-total-price" value="${price}">
                    <input type="number" name="items[${id}][OD_Units]" class="form-control quantity" value="1" min="1" style="width: 60px; display: inline-block; margin-right: 10px;" onchange="updateTotalPrice(this.closest('.cart-item'), ${price})">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeFromCart(${id})">Remove</button>
                `;
                cart.appendChild(itemDiv);
            }
        }

        function updateTotalPrice(itemDiv, price) {
            let quantity = itemDiv.querySelector('.quantity').value;
            let totalPrice = (quantity * price).toFixed(2);
            itemDiv.querySelector('.item-total-price').value = totalPrice;
            itemDiv.querySelector('.item-price').innerText = totalPrice;
        }

        function removeFromCart(id) {
            const itemDiv = document.getElementById('cart-item-' + id);
            if (itemDiv) {
                itemDiv.remove();
            }
        }
    </script>
</body>
</html>
