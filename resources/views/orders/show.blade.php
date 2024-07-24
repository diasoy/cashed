<x-layout title="Order #{{ $order->id }}">
    <div class="max-w-screen-md mx-auto pt-32">
        <div class="card w-full max-w-md mx-auto bg-base-100 shadow-lg mb-4">
            <div class="card-body border-b">
                <div class="flex justify-between">
                    <div>Cashier</div>
                    <div class="font-bold">{{ $order->user->name }}</div>
                </div>
                <div class="flex justify-between">
                    <div>Customer</div>
                    <div class="font-bold">{{ $order->customer }}</div>
                </div>
                <div class="flex justify-between mt-2">
                    <div>Date</div>
                    <div class="font-bold">{{ $order->created_at->format('d/m/Y') }}</div>
                </div>
                <div class="flex justify-between mt-2">
                    <div>Time</div>
                    <div class="font-bold">{{ $order->created_at->format('H:i') }}</div>
                </div>
            </div>
            <div class="card-body border-b">
                @foreach ($order->details as $detail)
                    <div class="card bg-base-200 mb-2">
                        <div class="card-body">
                            <div class="font-bold">{{ $detail->product->name }}</div>
                            <div class="flex justify-between mt-2">
                                <div class="text-sm">{{ $detail->qty }} x {{ number_format($detail->price) }}</div>
                                <div class="text-sm font-bold">Rp{{ number_format($detail->qty * $detail->price) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-body">
                <div class="flex justify-between">
                    <div>Total</div>
                    <div class="font-bold">Rp{{ number_format($order->total) }}</div>
                </div>
                <div class="flex justify-between mt-2">
                    <div>Payment</div>
                    <div class="font-bold">Rp{{ number_format($order->payment) }}</div>
                </div>
                <div class="flex justify-between mt-2">
                    <div>Change</div>
                    <div class="font-bold">Rp{{ number_format($order->payment - $order->total) }}</div>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-20">
            <a href="{{ route('orders.index') }}" class="btn btn-primary mb-10">Kembali</a>
        </div>
    </div>
</x-layout>
