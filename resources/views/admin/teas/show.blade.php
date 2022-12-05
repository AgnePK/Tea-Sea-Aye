<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $tea->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{ $tea->updated_at->diffForHumans() }}
                </p>
                {{-- The button below takes you to the edit page.  --}}
                <a href="{{ route('admin.teas.edit', $tea) }}" class="btn-link ml-auto">Edit tea</a>
                {{-- It goes to the TeaController and calls all the functions. --}}
                <form action="{{ route('admin.teas.destroy', $tea) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this tea?')">Delete tea</button>
            </div>
            
            {{-- In this div i just show all the info from my DB. --}}
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg flex">
                <div class="">
                    <h2 class="font-bold text-4xl">
                        {{ $tea->name }}
                    </h2>
                    <img class="border-b border-gray-400 shadow-lg sm:rounded-lg mt-5" src="{{ asset('storage/images/' . $tea->tea_img) }}" width="350">
                </div>

                <div class="ml-6">
                    <p class="mt-20 text-1xl text-gray-500"><em>Brand : </em> {{$tea->brand->name}}</p>
                    <p class="mt-3">Brands Address:{{$tea->brand->address}}</p>
                    <p class="mt-3 whitespace-">{{$tea->description}}</p>
                    <p class="mt-3">Find us at: {{$tea->location}}</p>
                    <p class="mt-3 font-serif text-2xl">€{{$tea->price }}</p>
                        
                    <div>
                        @foreach ($tea->stores as $store)
                        <p class="mt-3">Store Location: {{$store->location}}<p>
                        @endforeach
                    </div>
                </div>
                
            </div>


        </div>
    </div>
</x-app-layout>