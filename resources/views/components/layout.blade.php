<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex w-full justify-center">
        <ul class="fixed menu menu-horizontal bg-base-200 lg:gap-4 rounded-box shadow z-50 items-center font-semibold">
            <li><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}"
                    href="{{ route('orders.index') }}">Orders</a></li>
            <li><a class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}"
                    href="{{ route('categories.index') }}">Categories</a></li>
            <li><a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}"
                    href="{{ route('products.index') }}">Products</a></li>
            <li><a class="nav-link {{ request()->routeIs('users.index') }}" href="{{ route('users.index') }}">Users</a>
            </li>
            <form action="{{ route('logout') }}" method="post" class="ml-4">
                @csrf
                <button type="submit" class="btn btn-sm btn-error">Logout</button>
            </form>
        </ul>

    </div>
    <div>
        {{ $slot }}
    </div>
</body>

</html>
