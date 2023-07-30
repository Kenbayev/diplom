<x-app-layout>


    <div class="container">
        <div class="table_block">
            <table class="table mt-4">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="50">
                            ID
                        </th>
                        <th scope="col">
                            @lang('public.Aircraft')
                        </th>
                        <th scope="col">
                            @lang('public.Airlines')
                        </th>
                        <th scope="col">
                            @lang('public.Flight_id')
                        </th>
                        <th scope="col">
                            @lang('public.Departure')
                        </th>

                        <th scope="col">
                            @lang('public.Arrival')
                        </th>

                        <th scope="col">
                            @lang('public.Time_to_fly')
                        </th>
                        <th scope="col">
                            @lang('public.Time_to_departure')
                        </th>
                        <th scope="col">
                            @lang('public.Time_to_arrival')
                        </th>
                        <th scope="col">
                            @lang('public.Number_of_seats')
                        </th>

                        <th scope="col">
                            @lang('public.Control_Panel')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flights as $flight)
                    <tr data-index="{{ $flight->id }}">
                        <td>
                            {{ $flight->id }}
                        </td>

                        <td>
                            {{ $flight->aircraft }}
                        </td>

                        <td>

                            {{ $flight->airlines }}

                        </td>

                        <td>
                            {{ $flight->flight_code }}
                        </td>

                        <td>
                            {{ $flight->flight_from_country }} <br> {{ $flight->flight_from_city }} <br> {{ $flight->flight_from_city_iso }}
                        </td>

                        <td>
                            {{ $flight->flight_to_country }} <br> {{ $flight->flight_to_city }} <br> {{ $flight->flight_to_city_iso }}
                        </td>

                        <td>
                            {{ $flight->flying_time }}
                        </td>

                        <td>
                            {{ date('d.m.Y H:i:s', strtotime($flight->departure_date_at)) }}
                        </td>

                        <td>
                            {{ date('d.m.Y H:i:s', strtotime($flight->arrival_date_at)) }}
                        </td>

                        <td>
                            @lang('public.Luxury') - {{ $flight->f_class }} <br> @lang('public.Business') - {{ $flight->b_class }} <br> @lang('public.Economy') - {{ $flight->e_class }}
                        </td>

                        <td>
                            <a href="{{ route('flights.show', $flight->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">@lang('public.View')</a>

                            <a href="{{ route('flights.edit', $flight->id) }}" id="edit_btn" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">@lang('public.Edit')</a>
                            <form class="inline-block" action="{{ route('flights.destroy', $flight->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" id="delete_btn" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="@lang('public.Delete')">
                            </form>
                            <form action="{{ url('tickets_add') }}" method="post" onsubmit="return confirm('After create ticket your can not edit FLIGHT, are your sure to create tickets?');">
                                <input type="hidden" name="id" value="{{$flight->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" id="create_id" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="@lang('public.Create_tickets')">
                            </form>

                            <form action="{{ url('tickets_by_id') }}" method="post">
                                <input type="hidden" name="flight_code" value="{{$flight->flight_code}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="@lang('public.View_tickets')">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('flights.create') }}" class="add_btn">@lang('public.Add_flight')</a>
    </div>


    <script>
        $(document).ready(function() {
            // // Скрыть прелоадер после полной загрузки страницы
            // $(window).on("load", function() {
            //     $(".preloader").fadeOut("slow");
            // });

            // Показать прелоадер при нажатии на кнопку
            $("#create_id").on("click", function() {
                $(".gooey").fadeIn();
                $(".bg_white").fadeIn();
                // Ваш код здесь...

                // Скрыть прелоадер после выполнения действий
                // $(".preloader").fadeOut("slow");
            });
        });
    </script>
</x-app-layout>