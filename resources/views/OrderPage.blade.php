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
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <li><a href="{{ route('ExpensesPage') }}">هزینه‌ها</a></li>
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
                <h3>Order Page</h3>
                <div class="row">
                    <div class="col-md-6">                    
                        <a href="{{url('/AddOrder')}}"><button class="btn dark-bg-btn">Add Menu</button></a>
                    </div>
                    <div class="col-md"></div>
                </div>
            </div>

            {{-- Data table Datas --}}
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped rtl-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Menu</th>
                                <th>Unit</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderData as $item)
                                <tr>
                                    <td>{{$item["Order_ID"]}}</td>
                                    <td>{{$item["O_Name"]}}</td>
                                    <td>{{$item["Menu_Names"]}}</td>
                                    <td>{{$item["OD_Units"]}}</td>
                                    <td>{{$item["OD_Prices"]}}</td>
                                    <td>{{$item["O_Status"]}}</td>
                                    <td><a href="{{ route('EditOrder', $item["Order_ID"]) }}"><i class="fa fa-edit" style="font-size:20px; margin-right:20px;"></i></a></td>
                                    <td>
                                        <form id="delete-form-{{ $item["Order_ID"] }}" action="{{ route('OrderPage.destroy', $item["Order_ID"]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" style="background:none; border:none; color:red;">
                                                <i class="fa fa-trash-o" style="font-size:20px; margin-right:35px;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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