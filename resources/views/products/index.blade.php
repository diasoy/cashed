<x-layout>
    <x-slot:title>Products</x-slot:title>

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
        <form class="flex gap-2" method="get">
            <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Cari product" name="search"
                value="{{ request()->search }}">
            <button type="submit" class="btn btn-dark">Cari</button>
        </form>
        <a href="/products/create" class="btn btn-primary mt-4">Tambah</a>

        <div class="overflow-x-auto">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Aktif</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="font-semibold">
                            <td>
                                <div class="avatar">
                                    <div class="w-24 rounded">
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" />
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                @if ($product->active)
                                    <span class="badge badge-primary">Aktif</span>
                                @else
                                    <span class="badge badge-error">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-error">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
