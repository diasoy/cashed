<x-layout>
    <div class="mt-52">
        <div class="mx-auto card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
            <form class="card-body" action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama</span>
                    </label>
                    <input type="text" class="input input-bordered @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan nama user" value="{{ old('name') }}" name="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" class="input input-bordered @error('email') is-invalid @enderror"
                        id="email" placeholder="Masukkan email user" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" class="input input-bordered @error('password') is-invalid @enderror"
                        id="password" placeholder="Masukkan password user" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </form>
        </div>
    </div>

</x-layout>
