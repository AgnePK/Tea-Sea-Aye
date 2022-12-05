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
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> 
                    {{ $store->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> 
                    {{ $store->updated_at->diffForHumans() }}
                </p>
                {{-- The button below takes you to the edit page.  --}}
                <a href="{{ route('admin.stores.edit', $store) }}" class="btn-link ml-auto">Edit store</a>
                {{-- It goes to the storeController and calls all the functions. --}}
                <form action="{{ route('admin.stores.destroy', $store) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this store?')">Delete store</button>
            </div>
            
            {{-- In this div i just show all the info from my DB. --}}
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg flex">
                <div class="">
                    <h2 class="font-bold text-4xl">
                        {{ $store->name }}
                    </h2>
                </div>

                <div class="ml-6">
                    <p class="mt-3">ID : {{$store->id}}</p>
                    <p class="mt-3">store Address : {{$store->location}}</p>
                    @foreach ($store->teas as $tea)
                    <p class="mt-3">Tea Name: {{$tea->name}}<p>
                    @endforeach
                </div>
                
            </div>


        </div>
    </div>
</x-app-layout>