<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.brands.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class=" mb-10 text-4xl">Create your Brand</h2>
                    <p>Name of the brand:</p>
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

                    <p class="mt-6">Address:</p>
                    <x-text-input
                        type="text"
                        name="address"
                        field="address"
                        placeholder="address"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('address')">
                    </x-text-input>
                    @error('address')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                    <x-primary-button class="mt-6">Save Brand</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>