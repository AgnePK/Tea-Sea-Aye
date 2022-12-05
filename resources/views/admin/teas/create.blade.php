<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                {{-- After this form is completed and submitted. the info is stored in the DB. That code is in TeaController --}}
                <form action="{{ route('admin.teas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class=" mb-10 text-4xl">Create your Tea</h2>
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
                    @error('name')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror

                    {{-- <p class="mt-6">Brand that makes the tea:</p> --}}
                    {{-- <x-text-input
                        type="text"
                        name="brand"
                        field="brand"
                        placeholder="brand"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('brand')">
                    </x-text-input>
                    @error('brand')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror --}}

                    <p class="mt-6">Describe the tea:</p>
                    <x-textarea
                        name="description"
                        rows="10"
                        field="description"
                        placeholder="describe here"
                        class="w-full mt-6"
                        :value="@old('description')">
                    </x-textarea>

                    <p class="mt-6">Price:</p>
                    <x-text-input
                        type="decimal"
                        name="price"
                        field="price"
                        placeholder="€00.00"
                        class="w-auto font-serif text-xl"
                        autocomplete="off"
                        :value="@old('price')">
                    </x-text-input>
                    @error('price')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
     
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
                    @error('location')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror

                    <div class="form-group mt-5">
                        <label for="brand"><strong>Choose Brand</strong><br></label>
                        <select name="brand_id">
                          @foreach ($brands as $brand)
                            <option value="{{$brand->id}}" {{(old('brand_id') == $brand->id) ? "selected" : ""}}>
                              {{$brand->name}}
                            </option>
                          @endforeach
                     </select>
                    </div>

                    <div class="form-group mt-5 ">
                        <label for="stores"> <strong>Choose Stores</strong> <br> </label>
                        @foreach ($stores as $store)
                            <input type="checkbox", value="{{$store->id}}" name="stores[]">
                           {{$store->name}}    <br>
                        @endforeach
                    </div>

                    <x-primary-button class="mt-6">Save Tea</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>