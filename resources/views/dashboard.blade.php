<x-layout>
    <x-slot name="title">Dashboard</x-slot>
    <div class="hero min-h-screen">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold">Hello, {{ request()->user()->name }}!!</h1>
                <p class="py-6">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Get Started</a>
            </div>
        </div>
    </div>
</x-layout>
