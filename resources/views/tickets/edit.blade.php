<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Flight
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-1 ">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('flights.update',$flights->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="py-3">
                        <h3 class="py-1">Flights information</h3>
                        <hr>
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="aircraft" class="block font-medium text-sm text-gray-700">Aircraft name</label>
                            <input type="text" name="aircraft" id="aircraft" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->aircraft }}"/>
                            @error('aircraft')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="airlines" class="block font-medium text-sm text-gray-700">Airline</label>
                            <input type="text" name="airlines" id="airlines" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->airlines }}" disabled/>

                            <!-- <select id="airlines" name="airlines" class="mt-2 block w-full rounded-md border-0 bg-white py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"  >
                                @foreach ($airlines as $airline)
                                <option value="{{ $airline->name }}">{{ $airline->name }}</option>
                                @endforeach
                            </select> -->
                            @error('airlines')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="number-mask" class="block font-medium text-sm text-gray-700">Flight ID</label>
                            <input type="text" name="flight_code" id="number-mask" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->flight_code }}" disabled />

                            @error('flight_code')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="py-3">
                        <h3 class="py-1">Departure information</h3>
                        <hr>
                    </div>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="flight_from_country" class="block font-medium text-sm text-gray-700">Country </label>
                            <input type="text" name="flight_from_country" id="flight_from_country" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->flight_from_country }}"/>

                            @error('flight_from_country')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="flight_from_city" class="block font-medium text-sm text-gray-700">City</label>
                            <input type="text" name="flight_from_city" id="flight_from_city" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->flight_from_city }}"/>

                            @error('flight_from_city')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="flight_from_city_iso" class="block font-medium text-sm text-gray-700">City ISO</label>
                            <input type="text" maxlength="3" name="flight_from_city_iso" id="flight_from_city_iso" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->flight_from_city_iso }}" style="text-transform: uppercase;"/>

                            @error('flight_from_city_iso')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="py-3">
                        <h3 class="py-1">Arrival information</h3>
                        <hr>
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="flight_to_country" class="block font-medium text-sm text-gray-700">Country</label>
                            <input type="text" name="flight_to_country" id="flight_to_country" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->flight_to_country }}"/>
                            @error('flight_to_country')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="flight_to_city" class="block font-medium text-sm text-gray-700">City</label>
                            <input type="text" name="flight_to_city" id="flight_to_city" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->flight_to_city }}"/>
                            @error('flight_to_city')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="flight_to_city_iso" class="block font-medium text-sm text-gray-700">City ISO</label>
                            <input type="text" maxlength="3" name="flight_to_city_iso" id="flight_to_city_iso" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->flight_to_city_iso }}" style="text-transform: uppercase;"/>
                            @error('flight_to_city_iso')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="py-3">
                        <h3 class="py-1">Flight Time Information</h3>
                        <hr>
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="time_mask" class="block font-medium text-sm text-gray-700">Time to fly</label>
                            <input type="text" name="flying_time" id="time_mask" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->flying_time }}"/>

                            @error('flying_time')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="date_mask_dep" class="block font-medium text-sm text-gray-700">Time to departure</label>
                            <input type="datetime-local" name="departure_date_at" id="date_mask_dep" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $departure }}"/>

                            @error('departure_date_at')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="date_mask_arr" class="block font-medium text-sm text-gray-700">Time to arrival</label>
                            <input type="datetime-local" name="arrival_date_at" id="date_mask_arr" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $arrival }}"/>

                            @error('arrival_date_at')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="py-3">
                        <h3 class="py-1">Information on the number of seats on the plane</h3>
                        <hr>
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="number_seats" class="block font-medium text-sm text-gray-700">Luxury seats</label>
                            <input type="text" name="f_class" id="f_class" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->f_class }}" disabled/>

                            @error('f_class')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="number_seats" class="block font-medium text-sm text-gray-700">Business seats</label>
                            <input type="text" name="b_class" id="b_class" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->b_class }}" disabled/>

                            @error('b_class')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                            <label for="number_seats" class="block font-medium text-sm text-gray-700">Economy  seats</label>
                            <input type="text" name="e_class" id="e_class" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $flights->e_class }}" disabled/>

                            @error('e_class')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full py-10">
                        <button type="submit" class="float-right flex items-center justify-center  px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/imask"></script>
    <script>
        var numberMask = IMask(
            document.getElementById('number-mask'), {
                mask: Number,
                min: 0,
                max: 100000000000000,
                thousandsSeparator: ''
            });

        var lazyMask = IMask(
            document.getElementById('time_mask'), {
                overwrite: true,
                autofix: true,
                mask: 'HH:MM',
                blocks: {
                    HH: {
                        mask: IMask.MaskedRange,
                        placeholderChar: 'HH',
                        from: 0,
                        to: 23,
                        maxLength: 2
                    },
                    MM: {
                        mask: IMask.MaskedRange,
                        placeholderChar: 'MM',
                        from: 0,
                        to: 59,
                        maxLength: 2
                    }
                }
            }
        );

        var numberMask = IMask(
            document.getElementById('f_class'), {
                mask: Number,
                min: 0,
                max: 100000,
                thousandsSeparator: ''
            });
        var numberMask = IMask(
            document.getElementById('b_class'), {
                mask: Number,
                min: 0,
                max: 100000,
                thousandsSeparator: ''
            });
        var numberMask = IMask(
            document.getElementById('e_class'), {
                mask: Number,
                min: 0,
                max: 100000,
                thousandsSeparator: ''
            });
    </script>
</x-app-layout>