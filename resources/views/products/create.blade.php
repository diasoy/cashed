<x-layout>
    <x-slot:title>Tambah Product</x-slot:title>

    <div class="mt-52">
        <div class="mx-auto card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
            <form class="card-body" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Category</span>
                    </label>
                    <select name="category_id" id="category_id"
                        class="select select-bordered @error('category_id') is-invalid @enderror">
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                            <option>Belum ada category</option>
                        @endforelse
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama</span>
                    </label>
                    <input type="text" class="input input-bordered @error('name') is-invalid @enderror"
                        id="name" placeholder="Masukkan nama product" value="{{ old('name') }}" name="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Harga</span>
                    </label>
                    <input type="number" class="input input-bordered @error('price') is-invalid @enderror"
                        id="price" placeholder="Masukkan harga product" value="{{ old('price') }}" name="price">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Gambar</span>
                    </label>
                    <input class="input input-bordered" type="file" id="image" name="image"
                        accept="image/jpeg,image/png">
                </div>

                <div class="form-control">
                    <input class="toggle toggle-bordered" type="checkbox" role="switch" id="active" name="active"
                        @checked(!old() || old('active') == 'on')>
                    <label class="label">
                        <span class="label-text">Aktif</span>
                    </label>
                </div>

                <div class="flex justify-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-error">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
