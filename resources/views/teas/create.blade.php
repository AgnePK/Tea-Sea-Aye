<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('teas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p>Name of tea:</p>
                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('name')">
                    </x-text-input>

                    <p class="mt-6">Brand that makes the tea:</p>
                    <x-text-input
                        type="text"
                        name="brand"
                        field="brand"
                        placeholder="brand"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('brand')">
                    </x-text-input>

                    <p class="mt-6">Describe the tea:</p>
                    <x-textarea
                        name="description"
                        rows="10"
                        field="description"
                        placeholder="describe here"
                        class="w-full mt-6"
                        :value="@old('description')">
                    </x-textarea>

                    <div class="mt-6">
                        <label for="price">Price (between €1 and €15):</label>
                        <input type="number"
                            name="price"
                            min="1" 
                            max="15"
                            :value="@old('price')">
                    </div> 
                    {{-- could i put this in as a varchar and verify it as numbers/decimals? --}}
     
                    <x-file-input
                        type="file"
                        name="tea_img"
                        placeholder="image"
                        class="w-full mt-6"
                        field="tea_img">
                    </x-file-input>

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

                    <x-primary-button class="mt-6">Save Tea</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>