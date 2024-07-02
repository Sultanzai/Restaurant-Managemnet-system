<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد مدیریت رستوران</title>

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
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>رستوران</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('welcome') }}">داشبورد</a></li>
                <li><a href="{{ route('OrderPage') }}">سفارش‌ها</a></li>
                <li><a href="{{ route('MenuPage') }}">منو</a></li>
                <li><a href="{{ route('StoragePage') }}">انبار</a></li>
                <li><a href="#">هزینه‌ها</a></li>
                <li><a href="#">گزارش‌ها</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>داشبورد مدیریت</h1>
                <div class="user-info">
                    <p>خوش آمدید، <span id="username">مدیر</span></p>
                </div>
            </header>

            <div class="continer">
                <h3>سفارش‌ها</h3>
                <div class="row">
                    <div class="col-md"></div>
                    
                    <div class="col-md-1">
                        <a href="{{ route('AddOrder') }}"><button class="btn dark-bg-btn">افزودن سفارش</button></a>
                    </div>
                    
                    <div class="col-md-1">
                        <button class="btn dark-bg-btn">گزارش</button>
                    </div>
                </div>
            </div>

            {{-- Data table Datas --}}
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped rtl-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>واحد سفارش</th>
                                <th>مبلغ</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>4</td>
                                <td>450</td>
                                <td>پرداخت شده</td>
                                <td>2011-04-25</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Scripts for data table --}}
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