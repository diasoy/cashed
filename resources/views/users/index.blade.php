<x-layout>
    <div class="overflow-x-auto max-w-screen-lg mx-auto pt-16">
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
        <div>
            <a href="/users/create" class="btn btn-primary">Tambah</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="font-semibold">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="flex gap-2"><a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-error">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
