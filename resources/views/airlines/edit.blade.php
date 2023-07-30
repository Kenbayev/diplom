<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('public.Edit_airline')
        </h2>
    </x-slot>

    <div class="container">
        <div class="max-w-4xl mx-auto py-10 ">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('airlines.update',$airlines->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-3 py-3 bg-white">
                            <label for="name" class="block font-medium text-sm text-gray-700">@lang('public.Name')</label>
                            <input type="text" name="name" id="name" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ $airlines->name }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-3 py-3 bg-white">
                            <label for="description" class="block font-medium text-sm text-gray-700">@lang('public.description')</label>
                            <input type="text" name="description" id="description" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ $airlines->description }}" />
                            @error('description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-3 py-3 bg-white ">
                            <label for="country" class="block font-medium text-sm text-gray-700">@lang('public.Country')</label>
                            <input type="text" name="country_name" id="country" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ $airlines->country_name }}" />
                            @error('country_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-3 py-3 bg-white ">
                            <label for="plane" class="block font-medium text-sm text-gray-700">@lang('public.Country_iso')</label>
                            <input type="text" name="country_iso" id="plane" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ $airlines->country_iso }}" />
                            @error('country_iso')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-3 py-3 bg-white ">
                            <label for="plane" class="block font-medium text-sm text-gray-700">@lang('public.Company_Price')</label>
                            <input type="text" name="default_price" id="plane" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ $airlines->default_price }}" />
                            @error('default_price')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                @lang('public.Edit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>