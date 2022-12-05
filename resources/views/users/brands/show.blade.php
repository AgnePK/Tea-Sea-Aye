<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $brand->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{ $brand->updated_at->diffForHumans() }}
                </p>
            </div>
            
            {{-- In this div i just show all the info from my DB. --}}
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg flex">
                <div class="">
                    <h2 class="font-bold text-4xl">
                        {{ $brand->name }}
                    </h2>
                </div>

                <div class="ml-6">
                    <p class="mt-3">ID : {{$brand->id}}</p>
                    <p class="mt-3">Brands Address : {{$brand->address}}</p>
                    @foreach ($teas as $tea)
                    <p class="mt-3">Our Teas : {{$tea->name}}</p>
                    @endforeach
                </div>

                
            </div>


        </div>
    </div>
</x-app-layout>