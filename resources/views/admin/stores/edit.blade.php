<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.stores.update', $store) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <h2 class=" mb-10 text-4xl">Update your store</h2>
                    <p class="font-bold">Name of the store:</p>
                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('name', $store->name)">
                    </x-text-input>
                    @error('name')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror

                    <p>Location:</p>
                    <x-text-input
                        type="text"
                        name="location"
                        field="location"
                        placeholder="location"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('location', $store->location)">
                    </x-text-input>
                    @error('location')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                    <x-primary-button class="mt-6">Save tea</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>