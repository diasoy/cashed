<x-layout title="Orders">
    <div class="max-w-screen-xl mx-auto pt-20">
        <div class="flex flex-col-reverse md:flex-row gap-8 mx-4">
            <div class="w-full md:w-2/3">
                <form class="flex flex-col md:flex-row gap-4 mb-6" method="get">
                    <select name="category_id" id="category_id" class="select select-bordered w-full md:w-auto"
                        onchange="this.form.submit()">
                        <option value="">Semua kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="flex flex-grow gap-2">
                        <input type="text" placeholder="Cari product" class="input input-bordered w-full"
                            name="search" value="{{ request()->search }}" autofocus>
                        <button type="submit" class="btn btn-dark">Cari</button>
                    </div>
                </form>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse ($products as $product)
                        <div class="card card-compact bg-base-100 shadow-lg hover:shadow-xl hover:scale-105 hover:duration-300 transition-all">
                            <a href="{{ route('orders.create.detail', ['product' => $product->id]) }}"
                                class="no-underline">
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                    class="rounded-t-lg">
                                <div class="card-body">
                                    <h2 class="card-title">{{ $product->name }}</h2>
                                    <p class="text-sm">{{ $product->category->name }}</p>
                                    <p class="text-lg font-bold">Rp{{ number_format($product->price) }}</p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-3 text-center">Belum ada products</div>
                    @endforelse
                </div>
            </div>

            <div class="w-full md:w-1/3 mx-4">
                <form class="card bg-base-100 shadow-lg" method="post" action="{{ route('orders.checkout') }}">
                    @csrf
                    <div class="card-body border-b">
                        <h2 class="card-title">Summary</h2>
                    </div>
                    <div class="card-body border-b">
                        <x-text-input name="customer" label="Customer" value="{{ session('order')->customer }}" />
                    </div>
                    <div class="card-body border-b">
                        <div class="space-y-2">
                            @php
                                $total = 0;
                            @endphp
                            @forelse (session('order')->details as $detail)
                                @php
                                    $total += $detail->qty * $detail->price;
                                @endphp
                                <div class="card bg-base-200 shadow-md">
                                    <div class="card-body">
                                        <div class="flex flex-col justify-between">
                                            <div class="font-semibold">{{ $detail->product->name }}</div>
                                            <div class="text-sm">Pesan: {{ $detail->qty }} x
                                                {{ number_format($detail->price) }}</div>
                                            <div class="text-sm">Total: Rp{{ number_format($detail->qty * $detail->price) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">Belum ada product</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-body border-b">
                        <div class="flex justify-between mb-4">
                            <div>Total</div>
                            <div class="text-lg font-bold">Rp{{ number_format($total) }}</div>
                        </div>
                        <x-text-input name="payment" label="Payment" type="number"/>
                    </div>
                    <div class="card-body flex justify-end gap-2">
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
