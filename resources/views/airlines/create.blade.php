<x-app-layout>

    <div>
        <div class="container">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('airlines.store')}}">
                    @csrf

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-2 py-2 bg-white ">
                            <label for="name" class="block font-medium text-sm text-gray-700">@lang('public.Company_name')</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-2 py-2 bg-white ">
                            <label for="description" class="block font-medium text-sm text-gray-700">@lang('public.description')</label>
                            <input type="text" name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" />

                            @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-2 py-2 bg-white ">
                            <label for="country" class="block font-medium text-sm text-gray-700">@lang('public.Country')</label>
                            <input type="text" name="country_name" id="country" class="form-input rounded-md shadow-sm mt-1 block w-full" />

                            @error('country_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-2 py-2 bg-white ">
                            <label for="plain" class="block font-medium text-sm text-gray-700">@lang('public.Country_iso')</label>
                            <input type="text" name="country_iso" id="plain" class="form-input rounded-md shadow-sm mt-1 block w-full" />

                            @error('country_iso')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-2 py-2 bg-white ">
                            <label for="plain" class="block font-medium text-sm text-gray-700">@lang('public.Company_Price')</label>
                            <input type="text" name="default_price" id="plain" class="form-input rounded-md shadow-sm mt-1 block w-full" />

                            @error('default_price')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                @lang('public.Create')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>