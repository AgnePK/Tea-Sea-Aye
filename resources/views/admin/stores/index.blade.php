<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>
            {{-- This button takes you to the create page. A Form is loaded and connects to the DB after submission --}}
            <a href="{{ route('admin.stores.create') }}" class="btn-link btn-lg mb-2">+ New store</a>
            @forelse ($stores as $store)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg flex">
                    <div>
                        <div class="flex">
                            <h2 class="font-bold text-2xl">
                                <a href="{{ route('admin.stores.show', $store->id) }}">{{ $store->name }}</a>
                            </h2>
                        </div>
                        <span class="block mt-4 text-sm opacity-70">{{ $store->updated_at->diffForHumans() }}</span>
                    </div>

                </div>
            @empty
            <p>You have no stores yet.</p>
            @endforelse
            {{$stores->links()}}
        </div>
    </div>
</x-app-layout>