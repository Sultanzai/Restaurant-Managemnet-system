<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/Style.css') }}">
    <link rel="stylesheet" href="{{ asset('BootstrapCSS/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('BootstrapCSS/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    {{-- Data table links do not swap the lines --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
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
                <li><a href="{{ route('OrderPage') }}">Menu</a></li>
                <li><a href="{{ route('StoragePage') }}">Storage</a></li>
                <li><a href="#">Customers</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>
        <h1>Mateen has made changes in this section</h1>

        <h1>Mateen changesssssssss</h1>
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

            <div class="container">
                <h1>Data table</h1> <br><br><br>
                <div class="row">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011-04-25</td>
                                <td>$320,800</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011-07-25</td>
                                <td>$170,750</td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009-01-12</td>
                                <td>$86,000</td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012-03-29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011-01-25</td>
                                <td>$112,000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

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
                    <div class="col-md-6">
                        <h3>Graph view</h3>
                    </div>
                </div>
                <div class="row">
                    <h1>Monthly Sales Graph view</h1>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>
</html>
