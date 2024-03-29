<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Counseling Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add your custom styles here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @yield('style')
    <style>
        .wrapper {
            display:
                flex;
        }

        .sidebar {
            position:
                fixed;
            height:
                100%;
            width:
                250px;
            background-color:
                #343a40;
            padding-top:
                20px;
            color:
                #fff;
            transition:
                0.3s;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar a {
            padding:
                10px;
            text-decoration:
                none;
            font-size:
                18px;
            color:
                #818181;
            display:
                block;
            transition:
                0.3s;
        }

        .sidebar a:hover {
            color:
                #f8f9fa;
        }

        .content {
            margin-left:
                250px;
            padding:
                20px;
        }

        body {
            background-color:
                #f8f9fa;
        }

        .dashboard-container {
            margin-top:
                30px;
        }

        .card {
            border-radius:
                15px;
        }

        .card-header {
            background-color:
                #007bff;
            color:
                white;
            border-radius:
                15px 15px 0 0;
        }

        .card-body {
            padding:
                20px;
        }

        .dashboard-title {
            font-size:
                24px;
            font-weight:
                bold;
        }

        .appointment-list {
            list-style:
                none;
            padding:
                0;
        }

        .appointment-item {
            border:
                1px solid #dee2e6;
            margin-bottom:
                15px;
            padding:
                15px;
            border-radius:
                10px;
        }

        .appointment-item:hover {
            background-color:
                #f1f1f1;
        }

        .navbar {
            background-color:
                #007bff;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color:
                white;
        }

        .navbar-brand:hover,
        .navbar-nav .nav-link:hover {
            color:
                #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">E-Counseling</a>
        <!-- Add navigation links if needed -->
    </nav>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-color="purple">
            <ul>
                <li>
                    <a href="{{url('appointment')}}">
                        <i class=" "></i>
                        <p>Appointment</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('client')}}">
                        <i class=" "></i>
                        <p>Client</p>
                    </a>
                </li>
                @hasanyrole('admin')
                <li>
                    <a href="{{url('counselor')}}">
                        <i class=" "></i>
                        <p>Counselor</p>
                    </a>
                </li>
                @endhasanyrole
                <li class="dropdown">


                    <a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>

                </li>
                <li>
                    <form class="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="display:none;"> {{ __('Log Out') }}</button>
                    </form>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.querySelector('.logout-form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </li>

            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Dashboard Container -->
            <div class="container dashboard-container">
                <div class="row">
                    <!-- Dashboard Title -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="dashboard-title">E-Counselling</h3>
                            </div>
                            <div class="card-body">
                                <ul class="appointment-list">
                                    <!-- Sample Appointment Item -->
                                    <li class="appointment-item">
                                        @yield('content')
                                    </li>
                                    <!-- Add more appointment items dynamically -->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Dashboard Widgets/Sections can be added here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0/dist/js/bootstrap-select.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        @if(session('status'))
    
    // alert('{{ session('status')}}');
    swal({
    title: "{{ session('status')}}",
    //text: "You clicked the button!",
    icon:"{{ session('statusCode')}}"
    });
    @endif
    </script>
    <!-- Your additional scripts go here -->


    @yield('scripts')
</body>

</html>