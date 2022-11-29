<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>
            {{-- This button takes you to the create page. A Form is loaded and connects to the DB after submission --}}
            <a href="{{ route('admin.brands.create') }}" class="btn-link btn-lg mb-2">+ New brand</a>
            @forelse ($brands as $brand)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg flex">
                    <div>
                        <div class="flex">
                            <h2 class="font-bold text-2xl">
                                <a href="{{ route('admin.brands.show', $brand->id) }}">{{ $brand->name }}</a>
                            </h2> 
                            {{-- <p class="ml-2 text-2xl">
                                ·    {{$brand->brand->name }}
                            </p> --}}
                        </div>
                        {{-- <p class="mt-4 font-bold font-serif text-xl">
                            €{{$brand->price }}
                        </p> --}}
                        <span class="block mt-4 text-sm opacity-70">{{ $brand->updated_at->diffForHumans() }}</span>
                    </div>

                </div>
            @empty
            <p>You have no brands yet.</p>
            @endforelse
            {{$brands->links()}}
        </div>
    </div>
</x-app-layout>