<x-layout>
    <x-slot:title>Orders</x-slot:title>

    <div class="max-w-screen-lg mx-auto pt-20">
        @if (session('success'))
            <div class="alert alert-success my-4" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex mb-4 justify-between">
            <form class="flex gap-2" method="get">
                <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Cari order"
                    name="search" value="{{ request()->search }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>
            <a href="{{ route('orders.create') }}" class="btn btn-primary">Buat Order Baru</a>
        </div>

        <div class="overflow-x-auto">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Cashier</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="font-semibold">
                            <td>{{ $order->customer }}</td>
                            <td>{{ number_format($order->payment) }}</td>
                            <td>{{ number_format($order->total) }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                    class="btn btn-sm btn-primary">
                                    Lihat
                                </a>
                                <form action="{{ route('orders.destroy', ['order' => $order->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada order</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="1">Total Penjualan</th>
                        <th></th>
                        <th class="font-bold">Rp{{ number_format($totalAmount) }}</th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-layout>
