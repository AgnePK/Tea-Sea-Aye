<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $tea->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{ $tea->updated_at->diffForHumans() }}
                </p>
                <a href="{{ route('teas.edit', $tea) }}" class="btn-link ml-auto">Edit tea</a>
                <form action="{{ route('teas.destroy', $tea) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this tea?')">Delete tea</button>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $tea->name }}
                </h2>
                <p class="mt-6 whitespace-">{{$tea->description}}</p>
            </div>
        </div>
    </div>
</x-app-layout>