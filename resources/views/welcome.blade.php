<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .container {
            margin-top: 100px;
            margin-right: auto;
            margin-left: auto;
            max-width: 900px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref">
        @guest
        @if (Route::has('login'))
        <div class="top-right links">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
        @endif
        @else
        <div class="top-right links">
            <a href="#">{{ Auth::user()->name }}</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        @endguest
    </div>

    <div class="container">
        <h3>今日星座運勢 {{$today_date}}</h3>
        @foreach ($today_fortune as $fortune)
        <div>
            <p>星座名 : {{$fortune->constellation_name}}</p>
            <p>整體評分 : {{$fortune->all_score}}</p>
            <p>整體說明 : {{$fortune->all_description}}</p>
            <p>愛情評分 : {{$fortune->love_score}}</p>
            <p>愛情說明 : {{$fortune->love_description}}</p>
            <p>事業評分 : {{$fortune->work_score}}</p>
            <p>事業說明 : {{$fortune->work_description}}</p>
            <p>財運評分 : {{$fortune->fortune_score}}</p>
            <p>財運評分 : {{$fortune->fortune_description}}</p>
        </div>
        <hr>
        @endforeach
    </div>
</body>

</html>