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
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Reservations</a></li>
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
            <main>
                <!-- Add your main dashboard content here -->
                <h2>Orders</h2>
                <div class="dashboard-cards">
                    <div class="card"><p>Daily Orders: 15</p></div>
                    <div class="card"><p>Weekly Orders: 90</p></div>
                    <div class="card"><p>Monthly Orders: 28</p></div>
                    <div class="card"><p>total Orders: 28</p></div>
                </div>
                <h2>Expances</h2>
                <div class="dashboard-cards">
                    <div class="card"><p>Daily Orders: 15</p></div>
                    <div class="card"><p>Weekly Orders: 90</p></div>
                    <div class="card"><p>Monthly Orders: 28</p></div>
                    <div class="card"><p>Total Expances: 28</p></div>
                </div>
            </main>

            <div class="continer">
                <div class="row">
                    <div class="col-md-6">
                        <div class="container mt-5">
                            <h3>Storage Alert</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Units</th>
                                    <th scope="col">Unit type</th>
                                    <th scope="col">X</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Chicken</td>
                                    <td>20</td>
                                    <td>Pice</td>
                                    <td>X</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Milk</td>
                                    <td>10</td>
                                    <td>litter</td>
                                    <td>X</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Milk</td>
                                    <td>10</td>
                                    <td>litter</td>
                                    <td>X</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Milk</td>
                                    <td>10</td>
                                    <td>litter</td>
                                    <td>X</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Milk</td>
                                    <td>10</td>
                                    <td>litter</td>
                                    <td>X</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="col-md-6"><h3>Graph view</h3></div>
                </div>
                <div class="row">
                    <h1>Monthly Sales Graph view</h1>
                </div>
            </div>

        </div>
    </div>

</body>
</body>
</html>
