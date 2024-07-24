<x-layout title="Orders">
    <div class="max-w-screen-lg mx-auto pt-20">
        <div class="flex justify-between mb-4">
            <a href="{{ route('orders.create') }}" class="btn btn-outline btn-dark">
                <i class="bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card w-full max-w-md mx-auto bg-base-100 shadow-lg">
            <div class="card-body">
                <h2 class="card-title border-b pb-2 mb-4">Product</h2>
                <form method="post">
                    @csrf
                    <div class="mb-4">
                        <x-text-input name="name" label="Nama" value="{{ $product->name }}" disabled />
                    </div>
                    <div class="mb-4">
                        <x-text-input name="qty" label="Qty" type="number"
                            value="{{ old('qty', $detail != null ? $detail->qty : '1') }}" />
                    </div>
                    <div class="mb-4">
                        <x-text-input name="price" label="Price" type="number"
                            value="{{ old('price', $detail != null ? $detail->price : $product->price) }}" />
                    </div>
                    <div class="flex justify-between">
                        <button type="submit" class="btn btn-dark">Simpan</button>
                        @if ($detail != null)
                            <button type="submit" name="submit" value="destroy" class="btn btn-error">Hapus</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
