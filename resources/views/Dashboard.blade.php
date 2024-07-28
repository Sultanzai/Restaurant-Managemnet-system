<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7 Eleven Restaurant System</title>

    <link rel="stylesheet" href="{{ asset('BootstrapCSS/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('BootstrapCSS/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/4.3.1-1/bootstrap-rtl.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/Style.css') }}">
</head>
<body>
    <div class="containerr">
        <!-- Sidebar -->
        <nav class="sidebar" style="height: 200vh">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('css/logo.png') }}" alt="">
                </div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}">داشبورد</a></li>
                <li><a href="{{ route('OrderPage') }}">سفارشات</a></li>
                <li><a href="{{ route('MenuPage') }}">منوها</a></li>
                <li><a href="{{ route('StoragePage') }}">ذخیره مواد غذایی</a></li>
                <li><a href="{{ route('ExpensesPage') }}">مصارف</a></li>
                <li><a href="{{ route('BillPage') }}">بیل ها</a></li>
            </ul>
        </nav>
        <!-- Main Content -->
        <div class="main-content">
            {{-- User Name Record --}}
            @include('layouts.header')
            <div class="container">
                @yield('content')
            </div>
            {{-- Logout Button --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>    
            <button class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </button>
            <main  style="text-align: left;">
                <!-- Add your main dashboard content here -->
                <h4>Sales</h4>
                <div class="dashboard-cards">

                    <div class="card"><p>Total Sales: {{$totalsales}}</p></div>
                    <div class="card"><p>Monthly Sales: {{$monthlysales}}</p></div>
                    <div class="card"><p>Weekly Sales: {{$weeklysales}}</p></div>
                    <div class="card"><p>Daily Sales: {{$dailysales}}</p></div>
                </div>
                <h4>Profit</h4>
                <div class="dashboard-cards">
                    <div class="card"><p>Total Profit: {{$totalsales - $totalExpenses - $totalstorage}}</p></div>
                    <div class="card"><p>Monthly Profit: {{$monthlysales - $monthlyExpenses - $monthlystorage}}</p></div>
                    <div class="card"><p>Weekly Profit: {{$weeklysales - $weeklyExpenses - $weeklystorage}}</p></div>
                    <div class="card"><p>Daily Profit: {{$dailysales -$dailyExpenses - $dailystorage}}</p></div>
                </div>
                <h4>Expenses</h4>
                <div class="dashboard-cards">
                    <div class="card"><p>Total: {{$totalExpenses}}</p></div>
                    <div class="card"><p>Monthly: {{$monthlyExpenses}}</p></div>
                    <div class="card"><p>Weekly: {{$weeklyExpenses}}</p></div>
                    <div class="card"><p>Daily: {{$dailyExpenses}} </p></div>
                </div>
                <h4>Storage </h4>
                <div class="dashboard-cards">
                    <div class="card"><p>Total: {{$totalstorage}}</p></div>
                    <div class="card"><p>Monthly: {{$monthlystorage}}</p></div>
                    <div class="card"><p>Weekly: {{$weeklystorage}}</p></div>
                    <div class="card"><p>Daily: {{$dailystorage}}</p></div>
                </div>
            </main>

            <a href="{{ route('log') }}"><button class="btn" style="background-color: black; color:white;">Log Data</button></a><br><br>

            <div class="continer">
                
                <div class="row">
                    <div class="col-md-12">
                        <h4>Storage Alert</h4><br>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>آیدی</th>
                                <th>نام</th>
                                <th>مجموع درج شده</th>
                                <th>مجموع خارج شده</th>
                                <th>مجموع منقضی شده</th>
                                <th>باقی مانده</th>
                                <th>تاریخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($storage as $items)
                            <tr>
                                <td>{{ $items->storage_id }}</td>
                                <td>{{ $items->s_Name }}</td>
                                <td>{{ $items->total_in }}</td>
                                <td>{{ $items->total_out }}</td>
                                <td>{{ $items->total_expired }}</td>
                                <td>{{ $items->total_in - $items->total_out - $items->total_expired}}</td>
                                <td>{{ $items->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
                
            </div>
        </div>
    </div>
    {{-- Scripts for data table --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>
</html>
