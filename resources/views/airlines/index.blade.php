<x-app-layout>
    <div class="container">
        <div class="body_block">
            <table class="table mt-4">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="50">
                            ID
                        </th>
                        <th scope="col">
                            @lang('public.Company_name')
                        </th>
                        <th scope="col">
                            @lang('public.description')
                        </th>
                        <th scope="col">
                            @lang('public.Country')
                        </th>
                        <th scope="col">
                            @lang('public.Country_iso')
                        </th>
                        <th scope="col">
                            @lang('public.Company_Price')
                        </th>
                        <th scope="col">
                            @lang('public.Company_Photo')
                        </th>
                        <th scope="col">
                            @lang('public.Control_Panel')
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($airlines as $airline)
                    <tr>
                        <td>
                            {{ $airline->id }}
                        </td>
                        <td>
                            {{ $airline->name }}
                        </td>
                        <td>
                            {{ $airline->description }}
                        </td>
                        <td>
                            {{ $airline->country_name }}
                        </td>
                        <td>
                            {{ $airline->country_iso }}
                        </td>
                        <td>
                            {{ $airline->default_price }}
                        </td>
                        <td>
                            <img src="{{ $airline->company_img }}" width="150px" alt="">
                        </td>
                        <td>
                            <a href="{{ route('airlines.show', $airline->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">@lang('public.View')</a>
                            <a href="{{ route('airlines.edit', $airline->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">@lang('public.Edit')</a>
                            <form class="inline-block" action="{{ route('airlines.destroy', $airline->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="@lang('public.Delete')">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="">
            <a href="{{ route('airlines.create') }}" class="add_btn">@lang('public.Add_airlines')</a>
        </div>
    </div>
</x-app-layout>