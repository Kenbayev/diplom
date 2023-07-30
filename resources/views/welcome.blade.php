<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="https://airfly.kz/storage/logo.png" width="50px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 w-100 mb-lg-0">
                    <li class="nav-item">
                        <a class="text-sm nav-link active" aria-current="page" href="#">Flight</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="text-sm nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Information
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="text-sm dropdown-item" href="#">FAQ</a></li>
                            <li><a class="text-sm dropdown-item" href="#">About platform</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="text-sm dropdown-item" href="#">Support <i class="fa fa-envelope-open"></i></a></li>
                        </ul>
                    </li>
                </ul>
                @if (Route::has('login'))
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-end w-100 rigth_menu">
                    @auth
                    <li class="nav-item"><a href="{{ url('/dashboard') }}" class="text-sm nav-link">Dashboard</a></li>
                    @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="text-sm nav-link">Log in</a></li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="text-sm nav-link">Register</a>
                    </li>
                    @endif
                    @endauth
                </ul>
                @endif
            </div>
        </div>
    </nav>


    <div class="container">
        <?php
        // $ipaddress = getenv("REMOTE_ADDR");
        // // echo "Your IP Address is " . $ipaddress;

        // $cURLConnection = curl_init();

        // curl_setopt($cURLConnection, CURLOPT_URL, 'http://ip-api.com/json/' . $ipaddress . '?fields=country,countryCode,regionName,city,currency');
        // curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        // $phoneList = curl_exec($cURLConnection);
        // curl_close($cURLConnection);

        // print_r(json_decode($phoneList));






        // $curl = curl_init();

        // curl_setopt_array($curl, [
        //     CURLOPT_URL => "https://iatacodes-iatacodes-v1.p.rapidapi.com/api/v9/flights?bbox=46.01%2C-12.21%2C56.84%2C9.66",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_HTTPHEADER => [
        //         "X-RapidAPI-Host: iatacodes-iatacodes-v1.p.rapidapi.com",
        //         "X-RapidAPI-Key: 4b6a1c3e3cmshe3eb1d189785446p1484a8jsn33fe3a76e822"
        //     ],
        // ]);

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }
        ?>
        <!-- multistep form -->
        <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">The first step</li>
                <li>The second step</li>
                <li>The third step</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Flight</h2>
                <h3 class="fs-subtitle">This is step 1</h3>

                <div class="row">
                    <div class="col-2">
                        <input type="text" name="from" placeholder="From" />
                    </div>
                    <div class="col-2">
                        <input type="text" name="to" placeholder="To" />
                    </div>
                    <div class="col-2">
                        <input type="text" id="search_checkin" name="depart" placeholder="Depart" />
                    </div>
                    <div class="col-2">
                        <input type="text" id="search_checkout" name="return" placeholder="Return" />
                    </div>
                    <div class="col-2">
                        <input type="text" name="passengers" placeholder="Passengers" />
                    </div>
                    <div class="col-2">
                        <input type="submit" value="Find" />
                    </div>
                </div>


                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Social Profiles</h2>
                <h3 class="fs-subtitle">Your presence on the social network</h3>
                <input type="text" name="twitter" placeholder="Twitter" />
                <input type="text" name="facebook" placeholder="Facebook" />
                <input type="text" name="gplus" placeholder="Google Plus" />
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Personal Details</h2>
                <h3 class="fs-subtitle">We will never sell it</h3>
                <input type="text" name="fname" placeholder="First Name" />
                <input type="text" name="lname" placeholder="Last Name" />
                <input type="text" name="phone" placeholder="Phone" />
                <textarea name="address" placeholder="Address"></textarea>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <a href="https://twitter.com/GoktepeAtakan" class="submit action-button" target="_top">Submit</a>
            </fieldset>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function() {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50) + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function() {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1 - now) * 50) + "%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });


        if ($('#search_checkin, #search_checkout').length) {
            // check if element is available to bind ITS ONLY ON HOMEPAGE
            var currentDate = moment().format("DD-MM-YYYY");

            $('#search_checkin, #search_checkout').daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY'
                },
                "alwaysShowCalendars": true,
                "minDate": currentDate,
                "maxDate": moment().add('months', 1),
                autoApply: true,
                autoUpdateInput: false
            }, function(start, end, label) {
                // console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
                // Lets update the fields manually this event fires on selection of range
                var selectedStartDate = start.format('DD-MM-YYYY'); // selected start
                var selectedEndDate = end.format('DD-MM-YYYY'); // selected end

                $checkinInput = $('#search_checkin');
                $checkoutInput = $('#search_checkout');

                // Updating Fields with selected dates
                $checkinInput.val(selectedStartDate);
                $checkoutInput.val(selectedEndDate);

                // Setting the Selection of dates on calender on CHECKOUT FIELD (To get this it must be binded by Ids not Calss)
                var checkOutPicker = $checkoutInput.data('daterangepicker');
                checkOutPicker.setStartDate(selectedStartDate);
                checkOutPicker.setEndDate(selectedEndDate);

                // Setting the Selection of dates on calender on CHECKIN FIELD (To get this it must be binded by Ids not Calss)
                var checkInPicker = $checkinInput.data('daterangepicker');
                checkInPicker.setStartDate(selectedStartDate);
                checkInPicker.setEndDate(selectedEndDate);

            });

        } // End Daterange Picker
    </script>
</body>

</html>