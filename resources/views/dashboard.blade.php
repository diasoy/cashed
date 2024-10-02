<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="container mx-auto mt-52">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <div>Products Terjual</div>
                    <h1 class="font-bold text-2xl">{{ number_format($productsSold) }}</h1>
                </div>
            </div>

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <div>Pendapatan</div>
                    <h1 class="font-bold text-2xl">{{ number_format($revenue) }}</h1>
                </div>
            </div>

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <div>Orders</div>
                    <h1 class="font-bold text-2xl">{{ number_format($ordersCount) }}</h1>
                </div>
            </div>

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <div>Products</div>
                    <h1 class="font-bold text-2xl">{{ number_format($productsCount) }}</h1>
                </div>
            </div>
        </div>

        <h6 class="text-2xl font-semibold mt-32 mb-5 mx-4 md:mx-20">{{ count($recentOrders) }} Orders Terkini</h6>

        <div class="card bg-base-100 shadow mb-2 overflow-hidden mx-4 md:mx-20">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>User</th>
                            <th>Tanggal</th>
                            <th>Struk</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($recentOrders as $order)
                            <tr>
                                <td>Order #{{ $order->id }}</td>
                                <td>{{ $order->customer }}</td>
                                <td>{{ number_format($order->payment) }}</td>
                                <td>{{ number_format($order->total) }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="btn btn-sm btn-primary">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada order</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>