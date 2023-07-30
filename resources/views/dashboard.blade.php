<x-app-layout>
    <div class="bg_img d-flex">
        <div class="container">
            <form id="search_ticket_form">
                <div class="style_form">
                    <div class="input_group">
                        <input id="search_from" type="text" name="query_from" placeholder="@lang('public.From')">
                        <ul id="search_from_list"></ul>
                    </div>
                    <div class="input_group">
                        <input id="search_to" type="text" name="query_to" placeholder="@lang('public.To')">
                        <ul id="search_to_list"></ul>
                    </div>

                    <input id="dep_date" type="text" name="dep_date" placeholder="@lang('public.Depart')" onfocus="(this.type='date')">
                    <input id="arrival_date" type="text" name="arr_date" placeholder="@lang('public.Return')" onfocus="(this.type='date')">

                    <div class="input_group">
                        <input id="pas" type="text" name="passenger" placeholder="@lang('public.Passenger_and_class')">
                        <ul id="pass_info">
                            <li>
                                <div class="info_txt">
                                    <p>
                                        @lang('public.Adults') <br>
                                        <span>12+ @lang('public.years')</span>
                                    </p>
                                    <a class="question_tooltip" href="#" data-tooltip="@lang('public.Maximum_9_passenger')"><i class="fa-solid fa-question"></i></a>
                                </div>
                                <div class="quantity">
                                    <input id="total_pas" type="number" name="a_passenger" min="1" max="9" step="1" value="1">
                                </div>
                            </li>
                            <li>
                                <div class="info_txt">
                                    <p>
                                        @lang('public.Children') <br>
                                        <span>2-12 @lang('public.years')</span>
                                    </p>
                                    <a class="question_tooltip" href="#" data-tooltip="@lang('public.Maximum_9_passenger')"><i class="fa-solid fa-question"></i></a>
                                </div>
                                <div class="quantity">
                                    <input id="total_pas" type="number" name="c_passenger" min="0" max="9" step="1" value="0">
                                </div>
                            </li>
                            <li>
                                <div class="info_txt">
                                    <p>
                                        @lang('public.Infants') <br>
                                        <span>@lang('public.up_to_2_years')</span>
                                    </p>
                                    <a class="question_tooltip" href="#" data-tooltip='@lang("public.Infants_description")'><i class="fa-solid fa-question"></i></a>
                                </div>
                                <div class="quantity">
                                    <input id="total_pas" type="number" name="i_passenger" min="0" max="2" step="1" value="0">
                                </div>
                            </li>
                            <li>
                                <div>

                                    <div class="d-flex flex_lable_btn">
                                        <div class="input_radio">
                                            <input type="radio" id="all" name="seats_class" value="All" checked>
                                            <label for="all">@lang('public.All')</label>
                                        </div>
                                        <div class="input_radio">
                                            <input type="radio" id="first_class" name="seats_class" value="First">
                                            <label for="first_class">@lang('public.Luxury')</label>
                                        </div>
                                        <div class="input_radio">
                                            <input type="radio" id="business_class" name="seats_class" value="Business">
                                            <label for="business_class">@lang('public.Business')</label>
                                        </div>
                                        <div class="input_radio">
                                            <input type="radio" id="economy" name="seats_class" value="Economy">
                                            <label for="economy">@lang('public.Economy')</label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <input type="submit" value="" class="search_btn submit-icon">
                </div>
            </form>

        </div>
    </div>
    <div>
        <div class="container">

            <div class="row mt-5">
                <div class="col-3">
                    <div id="filter">

                        <div class="filter">
                            <div class="filter_head">
                                <i class="fa-solid fa-sliders"></i>
                                <h5>@lang('public.Filters')</h5>
                            </div>
                            <div class="polzunok-container-5">
                                <h6>@lang('public.Price'):</h6>
                                <div class="polzunok-5"></div>
                                <div class="d-flex slider_price">
                                    <input type="text" class="polzunok-input-5-left" />
                                    <input type="text" class="polzunok-input-5-right " />
                                </div>
                            </div>
                            <div class="airline">

                            </div>
                            <div class="class">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div id="tickets_result">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("dep_date").setAttribute("min", today);

        var today1 = new Date().toISOString().split('T')[0];
        document.getElementById("arrival_date").setAttribute("min", today1);

        // var today1 = new Date();
        // var tomorrow = new Date(today1);
        // tomorrow.setDate(today1.getDate() + 1);
        // var minDate = tomorrow.toISOString().split('T')[0];
        // document.getElementById("arrival_date").setAttribute("min", minDate);

        var airline = new Set();
        var airline_class = new Set();

        $(document).ready(function() {
            $('#pas').focus(function() {
                $('#pass_info').show();
            });

            $('#pass_info input').on('change', function() {
                var totalPassengers = 0;

                $('input[name="a_passenger"], input[name="c_passenger"], input[name="i_passenger"]').each(
                    function() {
                        totalPassengers += parseInt($(this).val()) || 0;
                    });
                var classValue = $('input[name="seats_class"]:checked').val() || '@lang("public.Economy")';
                var finalValue = totalPassengers + ' @lang("public.passengers"), ' + classValue;
                $('#pas').val(finalValue);
            });


        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('#pass_info, #pas').length) {
                $('#pass_info').hide();
            }
        });

        $(document).ready(function() {
            $('#search_from').on('input', function(event) {
                var searchTerm = $(this).val(); // Получаем поисковый запрос
                $("#search_from_list").attr("style", "display:block");
                // Проверяем, что поисковый запрос не пустой
                if (searchTerm.trim() === '') {
                    $("#search_from_list").empty();
                    return;
                }

                // Отправляем AJAX запрос на сервер для получения результатов поиска
                $.ajax({
                    url: 'https://airfly.kz/api/get_airline_from',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        query_from: searchTerm
                    },
                    success: function(results) {
                        console.log(results);
                        var resultsHtml = '';
                        $.each(results, function(index, result) {
                            resultsHtml += '<li class="from_info" data-index="' +
                                index +
                                '" data-result="' + result.iso +
                                '"><span class="city">' + result.city +
                                '</span><span class="iso">(' + result.iso +
                                ')</span></li>';
                        });
                        $("#search_from_list").html(resultsHtml);

                        // обработчик клика на элементе списка
                        $("#search_from_list li").click(function() {
                            var value = $(this).data(
                                "result"); // получаем значение элемента
                            console.log(value)
                            $("#search_from").val($(this).data("result"));

                            // устанавливаем значение ввода на выбранный элемент

                            // очищаем результаты поиска
                            $("#search_from_list").attr("style", "display:none");
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#search_to').on('input', function(event) {
                var searchTerms = $(this).val(); // Получаем поисковый запрос
                $("#search_to_list").attr("style", "display:block");
                // Проверяем, что поисковый запрос не пустой
                if (searchTerms.trim() === '') {
                    $("#search_to_list").empty();
                    return;
                }
                console.log(searchTerms);
                // Отправляем AJAX запрос на сервер для получения результатов поиска
                $.ajax({
                    url: 'https://airfly.kz/api/get_airline_to',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        query_to: searchTerms
                    },
                    success: function(results) {
                        console.log(results);
                        var resultsHtml = '';
                        $.each(results, function(index, result) {
                            resultsHtml += '<li class="from_info" data-index="' +
                                index +
                                '" data-result="' + result.iso +
                                '"><span class="city">' + result.city +
                                '</span><span class="iso">(' + result.iso +
                                ')</span></li>';
                        });
                        $("#search_to_list").html(resultsHtml);

                        // обработчик клика на элементе списка
                        $("#search_to_list li").click(function() {
                            var value = $(this).data(
                                "result"); // получаем значение элемента
                            console.log(value)
                            $("#search_to").val($(this).data("result"));

                            // устанавливаем значение ввода на выбранный элемент

                            // очищаем результаты поиска
                            $("#search_to_list").attr("style", "display:none");
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#search_to_list').length) {
                $("#search_to_list").attr("style", "display:none");
            }
            if (!$(e.target).closest('#search_from_list').length) {
                $("#search_from_list").attr("style", "display:none");
            }
        });

        jQuery(
                '<div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fa-solid fa-plus"></i></div><div class="quantity-button quantity-down"><i class="fa-solid fa-minus"></i></div></div>'
            )
            .insertAfter('.quantity input');
        jQuery('.quantity').each(function() {
            var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');
            btnUp.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });
            btnDown.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });
        });

        $('#search_ticket_form').submit(function(event) {
            // Отменяем стандартное поведение браузера
            event.preventDefault();

            // Получаем данные формы
            var formData = $(this).serialize();
            console.log(formData);
            // Отправляем данные на сервер методом POST
            $.ajax({
                type: 'POST',
                url: 'https://airfly.kz/api/search_ticket',
                data: formData,
                beforeSend: function() {
                    // показываем лоадер перед отправкой запроса
                    $("#loader").show();
                },
                success: function(response) {
                    $("#filter").attr("style", "display:block");

                    // Обрабатываем ответ от сервера
                    // console.log(response);

                    var tableRows = '';

                    $.each(response, function(index, result) {
                        var duration = moment.duration(result.flying_time);
                        var hours = duration.hours();
                        var minutes = duration.minutes();
                        var time = hours + 'h ' + minutes + 'min';

                        var queryString = formData;

                        // Преобразование строки запроса в объект параметров
                        var queryParams = parseQueryString(queryString);

                        // Извлечение значения параметра dep_date
                        var depDate = queryParams['dep_date'];

                        // Высчитываем Общик кол-во пассажиров
                        var totalPeople = parseInt(queryParams['a_passenger']) + parseInt(
                            queryParams['c_passenger']) + parseInt(queryParams[
                            'i_passenger']);

                        var payment_price = parseInt(result.default_price); // цена билета
                        var selectedDate = moment(depDate); // выбранная дата

                        var currentDate = moment(); // текущая дата
                        var daysDiff = selectedDate.diff(currentDate,
                            'days'); // количество дней между текущей датой и выбранной датой


                        if (daysDiff <= 7) {
                            price = payment_price *
                                totalPeople; // базовую цену умножаем на кол-во пассажиров
                            price = price *
                                3.6; // если выбранная дата находится в пределах недели, умножаем цену на 3.6
                        } else if (daysDiff > 7) {
                            price = payment_price *
                                totalPeople; // базовую цену умножаем на кол-во пассажиров
                            price = price *
                                2.6; // если выбранная дата находится за пределами недели (больше 7 дней), умножаем цену на 2.6
                        } else if (daysDiff > 14) {
                            price = payment_price *
                                totalPeople; // базовую цену умножаем на кол-во пассажиров
                            price = price *
                                1.6; // если выбранная дата находится за пределами недели (больше 14 дней), умножаем цену на 1.6
                        } else if (daysDiff > 21) {
                            price = payment_price *
                                totalPeople; // базовую цену умножаем на кол-во пассажиров
                            price = price *
                                0.6; // если выбранная дата находится за пределами недели (больше 21 дней), умножаем цену на 0.6
                        }

                        var result_data = '';

                        if (queryParams['seats_class'] === 'First' && result.number_seats[0] ===
                            'F') {

                            tableRows += '<div class="one_ticket" data-status="' + result.ticket_status + '" data-id="' + result.id +
                                '" data-price="' + price +
                                '" data-class="' + (result
                                    .number_seats.startsWith('F') ? '@lang("public.Luxury")' : result
                                    .number_seats.startsWith('B') ? '@lang("public.Business")' : result
                                    .number_seats.startsWith('E') ? '@lang("public.Economy")' : result
                                    .number_seats) + '" data-airline="' + result.airlines +
                                '">' +
                                '<div class="company_info">' +
                                '<div class="company">' +
                                '<div class="airplane_icon"><i class="fa-solid fa-plane" style="' +
                                (result.come_back ? 'transform: rotate(180deg);' : '') +
                                '"></i></div>' +
                                '<img class="c_img" src=' + result.company_img + ' />' +
                                '<p class="airlines"><span class="airline">' + result.airlines +
                                ' </span>/<span class="fly_class"> ' + (result
                                    .number_seats.startsWith('F') ? '@lang("public.Luxury")' : result
                                    .number_seats.startsWith('B') ? '@lang("public.Business")' : result
                                    .number_seats.startsWith('E') ? '@lang("public.Economy")' : result
                                    .number_seats) + '</span></p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="informations">' +
                                '<div class="fly_info">' +
                                '<div class="fly_from">' +
                                '<p class="departure_date_at">' + moment(result
                                    .departure_date_at).format("HH:mm") + '</p>' +
                                '<p class="flight_from_city_iso">' + result
                                .flight_from_city_iso + '</p>' +
                                '</div>' +
                                '<p class="flying_time">' + time + '</p>' +
                                '<div class="progress_line">' +
                                '</div>' +
                                '<div class="fly_to">' +
                                '<p class="arrival_date_at">' + moment(result.arrival_date_at)
                                .format("HH:mm") + '</p>' +
                                '<p class="flight_to_city_iso">' + result.flight_to_city_iso +
                                '</p>' +
                                '</div>' +

                                '</div>' +
                                '<div class="bag_info">' +
                                '<a class="bag" href="#" data-tooltip="@lang("public.bag_info")"><i class="fa-solid fa-cart-flatbed-suitcase"></i></a>' +
                                '<a class="carry-on" href="#" data-tooltip="@lang("public.bag_info_to")"><i class="fa-solid fa-person-walking-luggage"></i></a>' +
                                '</div>' +
                                '</div>' +
                                '<div class="price">' +
                                '<p>@lang("public.about_price") ' + totalPeople + ' @lang("public.persons")</p>' +
                                '<form class="buy" action="/buy_tickets" method="POST" id="post_ticket">' +
                                '@csrf' +
                                '<input type="text" name="ticket_id" value="' + result.id +
                                '" class="d-none" />' +
                                '<input type="text" name="total_price" value="' + price +
                                '" class="d-none" />' +
                                '<input type="text" name="a_passenger" value="' + parseInt(
                                    queryParams['a_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="c_passenger" value="' + parseInt(
                                    queryParams['c_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="i_passenger" value="' + parseInt(
                                    queryParams['i_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="ticket_token" value="' + result.ticket_token +
                                '" class="d-none" />' +
                                '<button type="submit" class="default_price">' +
                                '<span>@lang("public.Buy_for")</span>' +
                                '₸ ' + price.toLocaleString('ru-RU') + '</button>' +
                                '</form>' +
                                '</div>' +
                                '</div>';

                        } else if (queryParams['seats_class'] === 'Business' && result
                            .number_seats[0] === 'B') {
                            tableRows += '<div class="one_ticket" data-status="' + result.ticket_status + '" data-id="' + result.id +
                                '" data-price="' + price +
                                '" data-class="' + (result
                                    .number_seats.startsWith('F') ? '@lang("public.Luxury")' : result
                                    .number_seats.startsWith('B') ? '@lang("public.Business")' : result
                                    .number_seats.startsWith('E') ? '@lang("public.Economy")' : result
                                    .number_seats) + '" data-airline="' + result.airlines +
                                '">' +
                                '<div class="company_info">' +
                                '<div class="company">' +
                                '<div class="airplane_icon"><i class="fa-solid fa-plane" style="' +
                                (result.come_back ? 'transform: rotate(180deg);' : '') +
                                '"></i></div>' +
                                '<img class="c_img" src=' + result.company_img + ' />' +
                                '<p class="airlines"><span class="airline">' + result.airlines +
                                ' </span>/<span class="fly_class"> ' + (result
                                    .number_seats.startsWith('F') ? '@lang("public.Luxury")' : result
                                    .number_seats.startsWith('B') ? '@lang("public.Business")' : result
                                    .number_seats.startsWith('E') ? '@lang("public.Economy")' : result
                                    .number_seats) + '</span></p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="informations">' +
                                '<div class="fly_info">' +
                                '<div class="fly_from">' +
                                '<p class="departure_date_at">' + moment(result
                                    .departure_date_at).format("HH:mm") + '</p>' +
                                '<p class="flight_from_city_iso">' + result
                                .flight_from_city_iso + '</p>' +
                                '</div>' +
                                '<p class="flying_time">' + time + '</p>' +
                                '<div class="progress_line">' +
                                '</div>' +
                                '<div class="fly_to">' +
                                '<p class="arrival_date_at">' + moment(result.arrival_date_at)
                                .format("HH:mm") + '</p>' +
                                '<p class="flight_to_city_iso">' + result.flight_to_city_iso +
                                '</p>' +
                                '</div>' +

                                '</div>' +
                                '<div class="bag_info">' +
                                '<a class="bag" href="#" data-tooltip="@lang("public.bag_info")"><i class="fa-solid fa-cart-flatbed-suitcase"></i></a>' +
                                '<a class="carry-on" href="#" data-tooltip="@lang("public.bag_info_to")"><i class="fa-solid fa-person-walking-luggage"></i></a>' +
                                '</div>' +
                                '</div>' +
                                '<div class="price">' +
                                '<form class="buy" action="/buy_tickets" method="POST" id="post_ticket">' +
                                '@csrf' +
                                '<p>@lang("public.about_price") ' + totalPeople + ' @lang("public.persons")</p>' +
                                '<input type="text" name="ticket_id" value="' + result.id +
                                '" class="d-none" />' +
                                '<input type="text" name="total_price" value="' + price +
                                '" class="d-none" />' +
                                '<input type="text" name="a_passenger" value="' + parseInt(
                                    queryParams['a_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="c_passenger" value="' + parseInt(
                                    queryParams['c_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="i_passenger" value="' + parseInt(
                                    queryParams['i_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="ticket_token" value="' + result.ticket_token +
                                '" class="d-none" />' +
                                '<button type="submit" class="default_price">' +
                                '<span>@lang("public.Buy_for")</span>' +
                                '₸ ' + price.toLocaleString('ru-RU') + '</button>' +
                                '</form>' +
                                '</div>' +
                                '</div>';

                        } else if (queryParams['seats_class'] === 'Economy' && result
                            .number_seats[0] === 'E') {
                            tableRows += '<div class="one_ticket" data-status="' + result.ticket_status + '" data-id="' + result.id +
                                '" data-price="' + price +
                                '" data-class="' + (result
                                    .number_seats.startsWith('F') ? '@lang("public.Luxury")' : result
                                    .number_seats.startsWith('B') ? '@lang("public.Business")' : result
                                    .number_seats.startsWith('E') ? '@lang("public.Economy")' : result
                                    .number_seats) + '" data-airline="' + result.airlines +
                                '">' +
                                '<div class="company_info">' +
                                '<div class="company">' +
                                '<div class="airplane_icon"><i class="fa-solid fa-plane" style="' +
                                (result.come_back ? 'transform: rotate(180deg);' : '') +
                                '"></i></div>' +
                                '<img class="c_img" src=' + result.company_img + ' />' +
                                '<p class="airlines"><span class="airline">' + result.airlines +
                                ' </span>/<span class="fly_class"> ' + (result
                                    .number_seats.startsWith('F') ? '@lang("public.Luxury")' : result
                                    .number_seats.startsWith('B') ? '@lang("public.Business")' : result
                                    .number_seats.startsWith('E') ? '@lang("public.Economy")' : result
                                    .number_seats) + '</span></p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="informations">' +
                                '<div class="fly_info">' +
                                '<div class="fly_from">' +
                                '<p class="departure_date_at">' + moment(result
                                    .departure_date_at).format("HH:mm") + '</p>' +
                                '<p class="flight_from_city_iso">' + result
                                .flight_from_city_iso + '</p>' +
                                '</div>' +
                                '<p class="flying_time">' + time + '</p>' +
                                '<div class="progress_line">' +
                                '</div>' +
                                '<div class="fly_to">' +
                                '<p class="arrival_date_at">' + moment(result.arrival_date_at)
                                .format("HH:mm") + '</p>' +
                                '<p class="flight_to_city_iso">' + result.flight_to_city_iso +
                                '</p>' +
                                '</div>' +

                                '</div>' +
                                '<div class="bag_info">' +
                                '<a class="bag" href="#" data-tooltip="@lang("public.bag_info")"><i class="fa-solid fa-cart-flatbed-suitcase"></i></a>' +
                                '<a class="carry-on" href="#" data-tooltip="@lang("public.bag_info_to")"><i class="fa-solid fa-person-walking-luggage"></i></a>' +
                                '</div>' +
                                '</div>' +
                                '<div class="price">' +
                                '<p>@lang("public.about_price") ' + totalPeople + ' @lang("public.persons")</p>' +
                                '<form class="buy" action="/buy_tickets" method="POST" id="post_ticket">' +
                                '@csrf' +
                                '<input type="text" name="ticket_id" value="' + result.id +
                                '" class="d-none" />' +
                                '<input type="text" name="total_price" value="' + price +
                                '" class="d-none" />' +
                                '<input type="text" name="a_passenger" value="' + parseInt(
                                    queryParams['a_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="c_passenger" value="' + parseInt(
                                    queryParams['c_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="i_passenger" value="' + parseInt(
                                    queryParams['i_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="ticket_token" value="' + result.ticket_token +
                                '" class="d-none" />' +
                                '<button type="submit" class="default_price">' +
                                '<span>@lang("public.Buy_for")</span>' +
                                '₸ ' + price.toLocaleString('ru-RU') + '</button>' +
                                '</form>' +
                                '</div>' +
                                '</div>';

                        } else if (queryParams['seats_class'] === 'All') {
                            tableRows += '<div class="one_ticket" data-status="' + result.ticket_status + '" data-id="' + result.id +
                                '" data-price="' + price +
                                '" data-class="' + (result
                                    .number_seats.startsWith('F') ? '@lang("public.Luxury")' : result
                                    .number_seats.startsWith('B') ? '@lang("public.Business")' : result
                                    .number_seats.startsWith('E') ? '@lang("public.Economy")' : result
                                    .number_seats) + '" data-airline="' + result.airlines +
                                '">' +
                                '<div class="company_info">' +
                                '<div class="company">' +
                                '<div class="airplane_icon"><i class="fa-solid fa-plane" style="' +
                                (result.come_back ? 'transform: rotate(180deg);' : '') +
                                '"></i></div>' +
                                '<img class="c_img" src=' + result.company_img + ' />' +
                                '<p class="airlines"><span class="airline">' + result.airlines +
                                ' </span>/<span class="fly_class"> ' + (result
                                    .number_seats.startsWith('F') ? '@lang("public.Luxury")' : result
                                    .number_seats.startsWith('B') ? '@lang("public.Business")' : result
                                    .number_seats.startsWith('E') ? '@lang("public.Economy")' : result
                                    .number_seats) + '</span></p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="informations">' +
                                '<div class="fly_info">' +
                                '<div class="fly_from">' +
                                '<p class="departure_date_at">' + moment(result
                                    .departure_date_at).format("HH:mm") + '</p>' +
                                '<p class="flight_from_city_iso">' + result
                                .flight_from_city_iso + '</p>' +
                                '</div>' +
                                '<p class="flying_time">' + time + '</p>' +
                                '<div class="progress_line">' +
                                '</div>' +
                                '<div class="fly_to">' +
                                '<p class="arrival_date_at">' + moment(result.arrival_date_at)
                                .format("HH:mm") + '</p>' +
                                '<p class="flight_to_city_iso">' + result.flight_to_city_iso +
                                '</p>' +
                                '</div>' +

                                '</div>' +
                                '<div class="bag_info">' +
                                '<a class="bag" href="#" data-tooltip="@lang("public.bag_info")"><i class="fa-solid fa-cart-flatbed-suitcase"></i></a>' +
                                '<a class="carry-on" href="#" data-tooltip="@lang("public.bag_info_to")"><i class="fa-solid fa-person-walking-luggage"></i></a>' +
                                '</div>' +
                                '</div>' +
                                '<div class="price">' +
                                '<p>@lang("public.about_price") ' + totalPeople + ' @lang("public.persons")</p>' +
                                '<form class="buy" action="/buy_tickets" method="POST" id="post_ticket">' +
                                '@csrf' +
                                '<input type="text" name="ticket_id" value="' + result.id +
                                '" class="d-none" />' +
                                '<input type="text" name="total_price" value="' + price +
                                '" class="d-none" />' +
                                '<input type="text" name="a_passenger" value="' + parseInt(
                                    queryParams['a_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="c_passenger" value="' + parseInt(
                                    queryParams['c_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="i_passenger" value="' + parseInt(
                                    queryParams['i_passenger']) +
                                '" class="d-none" />' +
                                '<input type="text" name="ticket_token" value="' + result.ticket_token +
                                '" class="d-none" />' +
                                '<button type="submit" class="default_price">' +
                                '<span>@lang("public.Buy_for")</span>' +
                                '₸ ' + price.toLocaleString('ru-RU') + '</button>' +
                                '</form>' +
                                '</div>' +
                                '</div>';

                        }
                    });
                    var resultsTable = '<div class="ticket_block">' + tableRows + '</div>';
                    $("#tickets_result").html(resultsTable);


                    var prices = [];
                    airline.clear();
                    airline_class.clear();
                    setTimeout(() => {
                        for (var i = 0; i < document.getElementsByClassName('one_ticket')
                            .length; i++) {
                            prices.push(document.getElementsByClassName('one_ticket')[i]
                                .getAttribute('data-price'));
                            airline.add(document.getElementsByClassName('one_ticket')[i]
                                .getAttribute('data-airline'));
                            airline_class.add(document.getElementsByClassName('one_ticket')[i]
                                .getAttribute('data-class'));
                        }

                        $(".polzunok-5").slider({
                            min: Math.min(...prices),
                            max: Math.max(...prices),
                            values: [Math.min(...prices), Math.max(...prices)],
                            range: true,
                            animate: "fast",
                            slide: function(event, ui) {
                                $(".polzunok-input-5-left").val(ui.values[0]);
                                $(".polzunok-input-5-right").val(ui.values[1]);
                                rebuild_tickets();
                            }
                        });

                        $(".polzunok-input-5-left").val($(".polzunok-5").slider("values", 0));
                        $(".polzunok-input-5-right").val($(".polzunok-5").slider("values", 1));
                        $(".polzunok-container-5 input").change(function() {
                            var input_left = $(".polzunok-input-5-left").val().replace(
                                    /[^0-9]/g,
                                    ''),
                                opt_left = $(".polzunok-5").slider("option", "min"),
                                where_right = $(".polzunok-5").slider("values", 1),
                                input_right = $(".polzunok-input-5-right").val()
                                .replace(/[^0-9]/g,
                                    ''),
                                opt_right = $(".polzunok-5").slider("option", "max"),
                                where_left = $(".polzunok-5").slider("values", 0);
                            if (input_left > where_right) {
                                input_left = where_right;
                            }
                            if (input_left < opt_left) {
                                input_left = opt_left;
                            }
                            if (input_left == "") {
                                input_left = 0;
                            }
                            if (input_right < where_left) {
                                input_right = where_left;
                            }
                            if (input_right > opt_right) {
                                input_right = opt_right;
                            }
                            if (input_right == "") {
                                input_right = 0;
                            }
                            $(".polzunok-input-5-left").val(input_left);
                            $(".polzunok-input-5-right").val(input_right);
                            if (input_left != where_left) {
                                $(".polzunok-5").slider("values", 0, input_left);
                            }
                            if (input_right != where_right) {
                                $(".polzunok-5").slider("values", 1, input_right);
                            }
                        });


                        var airlines_result = '<br><fieldset><legend>@lang("public.Airlines"):</legend>';
                        for (var i of airline) {
                            airlines_result +=
                                '<div class="checkbox">' +
                                '<input class="airlinesinp" type="checkbox" onclick="rebuild_tickets()" id="' +
                                i + '" name="' + i + '" checked>' +
                                '<label for="' + i + '">' + i + '</label>' +
                                '</div>';
                        }
                        airlines_result += '</fieldset>';
                        document.getElementsByClassName('airline')[0].innerHTML =
                            airlines_result;


                        var airlines_class_result =
                            '<br><fieldset><legend>@lang("public.Class_type"):</legend>';

                        for (var i of airline_class) {
                            airlines_class_result +=
                                '<div class="checkbox">' +
                                '<input class="airlines_class" type="checkbox" onclick="rebuild_tickets()" id="' +
                                i + '" name="' + i + '" checked>' +
                                '<label for="' + i + '">' + i + '</label>' +
                                '</div>';
                        }
                        airlines_class_result += '</fieldset>';
                        document.getElementsByClassName('class')[0].innerHTML =
                            airlines_class_result;
                    }, 50);
                },
                error: function() {
                    // Обрабатываем ошибку
                    console.log('Error');
                },
                complete: function() {
                    // скрываем лоадер после выполнения запроса
                    $("#loader").hide();

                }
            });
        });


        function parseQueryString(queryString) {
            var query = {};
            var pairs = (queryString[0] === '?' ? queryString.substr(1) : queryString).split('&');
            for (var i = 0; i < pairs.length; i++) {
                var pair = pairs[i].split('=');
                query[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
            }
            return query;
        }



        function rebuild_tickets() {
            for (var p = 0; p < document.getElementsByClassName('one_ticket').length; p++) {
                for (var q = 0; q < document.getElementsByClassName('airlines_class').length; q++) {
                    if (document.getElementsByClassName('airlines_class')[q].checked) {
                        if (document.getElementsByClassName('airlines_class')[q].getAttribute('name') == document
                            .getElementsByClassName('one_ticket')[p].getAttribute('data-class')) {
                            for (var w = 0; w < document.getElementsByClassName('airlinesinp').length; w++) {
                                if (document.getElementsByClassName('airlinesinp')[w].checked) {
                                    if (document.getElementsByClassName('airlinesinp')[w].getAttribute('name') == document
                                        .getElementsByClassName('one_ticket')[p].getAttribute('data-airline')) {
                                        //document.getElementsByClassName('one_ticket')[p].style.display='';

                                        if (parseInt(document.getElementsByClassName('one_ticket')[p].getAttribute(
                                                'data-price')) >= parseInt(document.getElementsByClassName(
                                                'polzunok-input-5-left')[0].value) && parseInt(document
                                                .getElementsByClassName('one_ticket')[p].getAttribute('data-price')) <=
                                            parseInt(document.getElementsByClassName('polzunok-input-5-right')[0].value)) {
                                            document.getElementsByClassName('one_ticket')[p].style.display = '';
                                        } else {
                                            document.getElementsByClassName('one_ticket')[p].style.display = 'none';
                                        }
                                    }
                                } else {
                                    if (document.getElementsByClassName('airlinesinp')[w].getAttribute('name') == document
                                        .getElementsByClassName('one_ticket')[p].getAttribute('data-airline')) {
                                        document.getElementsByClassName('one_ticket')[p].style.display = 'none';
                                    }
                                }
                            }
                        }
                    } else {
                        if (document.getElementsByClassName('airlines_class')[q].getAttribute('name') == document
                            .getElementsByClassName('one_ticket')[p].getAttribute('data-class')) {
                            document.getElementsByClassName('one_ticket')[p].style.display = 'none';
                        }
                    }
                }

            }
            //console.log(document.getElementsByClassName('polzunok-input-5-left')[0].value);
            //console.log(document.getElementsByClassName('polzunok-input-5-right')[0].value);
        }
    </script>
</x-app-layout>