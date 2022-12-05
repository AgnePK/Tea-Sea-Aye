<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.stores.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class=" mb-10 text-4xl">Create your store</h2>
                    <p>Name of the store:</p>
                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('name')">
                    </x-text-input>
                    @error('name')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror

                    <p class="mt-6">Location:</p>
                    <x-text-input
                        type="text"
                        name="location"
                        field="location"
                        placeholder="location"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('location')">
                    </x-text-input>
                    @error('location')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror


                    <div class="form-group mt-3">
                        <label for="teas"> <strong>Choose Teas</strong> <br> </label>
                        @foreach ($teas as $tea)
                            <input type="checkbox", value="{{$tea->id}}" name="teas[]">
                           {{$tea->name}}    <br>
                        @endforeach
                    </div>

                    <x-primary-button class="mt-6">Save store</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>