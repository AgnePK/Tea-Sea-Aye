<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <x-alert-success>
                {{session('success')}}
            </x-alert-success> --}}
            <a href="{{ route('teas.create') }}" class="btn-link btn-lg mb-2">+ New tea</a>
            @forelse ($teas as $tea)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg flex">
                    <div class="mr-6">
                        <img src="{{ asset('storage/images/lyons_tea.jpeg') }}" width="160">
                    </div>
                    <div>
                        <div class="flex">
                            <h2 class="font-bold text-2xl">
                                <a href="{{ route('teas.show', $tea->id) }}">{{ $tea->name }}</a>
                            </h2> 
                            <p class="ml-2 text-2xl">
                                ·    {{$tea->brand }}
                            </p>
                        </div>
                        <p class="mt-2">
                            {{ Str::limit($tea->description, 140) }}
                        </p>
                        <p class="mt-4 font-bold font-serif text-xl">
                            €{{$tea->price }}
                        </p>
                        <span class="block mt-4 text-sm opacity-70">{{ $tea->updated_at->diffForHumans() }}</span>
                    </div>

                </div>
            @empty
            <p>You have no teas yet.</p>
            @endforelse
            {{$teas->links()}}
        </div>
    </div>
</x-app-layout>