<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
        }

        .sidebar a {
            color: #c2c7d0;
            text-decoration: none;
            display: block;
            padding: 12px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #495057;
            color: white;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card {
            border: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 d-md-block sidebar p-3">

            <h4 class="text-center mb-4">Inventory</h4>

            <a href="#" title="Coming Soon"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="#"><i class="bi bi-currency-dollar"></i> Sales</a>
            <a href="#" title="Coming Soon"><i class="bi bi-box"></i> Products</a>
            <a href="#" title="Coming Soon"><i class="bi bi-tags"></i> Categories</a>
            <a href="#" title="Coming Soon"><i class="bi bi-truck"></i> Suppliers</a>
            <a href="#" title="Coming Soon"><i class="bi bi-cart"></i> Orders</a>
            <a href="#" title="Coming Soon"><i class="bi bi-people"></i> Customers</a>
            <a href="{{ route('stocks.index') }}"><i class="bi bi-box-seam"></i> Stock</a>
            <a href="#" title="Coming Soon"><i class="bi bi-bar-chart"></i> Reports</a>
            <a href="#" title="Coming Soon"><i class="bi bi-gear"></i> Settings</a>

        </div>

        <!-- Main Content -->
        <div class="col-md-10">

            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg px-3">

                <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                    ☰
                </button>

                <div class="ms-auto">
                    <span class="me-3">Welcome, Admin</span>
                    <button class="btn btn-outline-danger btn-sm">Logout</button>
                </div>

            </nav>

            <!-- Page Content -->
            <div class="p-4">
                @yield('content')
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>