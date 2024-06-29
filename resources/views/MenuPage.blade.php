<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Admin Dashboard</title>
    <link rel="stylesheet" href="{{asset ('css/Style.css') }}">
    <link rel="stylesheet" href="{{asset ('BootstrapCSS/bootstrap.css') }}">
    <link rel="stylesheet" href="{{asset ('BootstrapCSS/bootstrap.min.css') }}">
    <script src="{{asset ('js/bootstrap.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset ('js/main.js') }}"></script>
</head>
<body>
    <div class="containerr">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Restaurant</h2>
            </div>
            <ul class="sidebar-menu">
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('OrderPage') }}">Orders</a></li>
            <li><a href="{{ route('MenuPage') }}">Menu</a></li>
            <li><a href="{{ route('StoragePage') }}">Storage</a></li>
                <li><a href="#">Customers</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Admin Dashboard</h1>
                <div class="user-info">
                    <p>Welcome, <span id="username">Admin</span></p>
                </div>
            </header>

            <div class="continer">
                <h3>Menus</h3>
                <div class="row">
                    <div class="col-md-5 search-filed">
                        <input type="text" name="" id="" value="Search">
                    </div>
                    <div class="col-md"></div>
                    <div class="col-md-2">
                        <button class="btn">Add Menu</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Food Name</th>
                                        <th scope="col">Food Unit </th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Juice Mango</td>
                                        <td>Small</td>
                                        <td>80</td>
                                        <td>X</td>
                                        <td>X</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Juice Mange</td>
                                        <td>Midem</td>
                                        <td>100</td>
                                        <td>X</td>
                                        <td>X</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Jucie Mange</td>
                                        <td>Large</td>
                                        <td>120</td>
                                        <td>X</td>
                                        <td>X</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Chicken</td>
                                        <td>Pice</td>
                                        <td>360</td>
                                        <td>X</td>
                                        <td>X</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Chicken</td>
                                        <td>Pice</td>
                                        <td>360</td>
                                        <td>X</td>
                                        <td>X</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Chicken</td>
                                        <td>Pice</td>
                                        <td>360</td>
                                        <td>X</td>
                                        <td>X</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>
</body>
</html>
