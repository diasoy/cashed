<x-layout>
    <x-slot:title>Edit Category</x-slot:title>

    <div class="mt-52">
        <div class="mx-auto card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
            <form class="card-body" action="{{ route('categories.update', ['category' => $category->id]) }}"
                method="post">
                @csrf
                @method('put')
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama</span>
                    </label>
                    <input type="text" class="input input-bordered @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan nama category" name="name" value="{{ old('name', $category->name) }}">
                    @error('name')
                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <input class="toggle toggle-bordered" type="checkbox" role="switch" id="active" name="active"
                        @checked((!old() && $category->active) || old('active') == 'on')>
                    <label class="label">
                        <span class="label-text">Aktif</span>
                    </label>
                </div>

                <div class="flex justify-between mt-4">
                    <a href="{{ route('categories.index') }}" class="btn btn-error">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
