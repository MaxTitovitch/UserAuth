<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Доска объявлений: Главная</title>
        <link rel="shortcut icon" href="{{ asset('icon.ico') }}" type="image/x-icon">
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            html, body {
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

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Управление</a>
                    @else
                        <a href="{{ route('login') }}">Вход</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Регистрация</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    ELECTRICAL BULLETIN BOARD
                </div>                

<!--                 <div class="title m-b-md">
                    <div class="links">
                        <a href="/home">Управлять пользователями!</a>
                    </div>
                </div> -->

                <div class="links">
                    <a href="mailto:puteeva@mail.ru" target="_blank">Написать</a>
                    <a href="tel:+375338372322" target="_blank">Позвонить</a>
                    <a href="https://github.com/Puteeva" target="_blank">GitHub Проекта</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="container" >
            
                <div class="row">
                    <div class="col-md-8" style="margin: 10px auto;">

                        @if($currentUser)
                            @if(Auth::user()->block == null)
                                <h2>Добавьте новое объявление!</h2>
                                <form action="{{ route('welcomepost') }}" method="post">

                                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                  <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Название" required="true">
                                  </div>

                                  <div class="form-group">
                                    <label for="message">Сообщение</label>
                                    <textarea class="form-control" id="message" name="message" placeholder="Сообщение" required="true"></textarea>
                                  </div>

                                  <div class="form-group">
                                    <label for="phone">Номер</label>
                                    +<input type="number" class="form-control" id="phone" name="phone" placeholder="Номер" min="100000000000" max="999999999999" required="true">
                                  </div>

                                  <button type="submit" class="btn btn-primary">Добавить</button>
                                </form>
                                @else
                                    <h2>Вы заблокированы, свяжитесь с администрацией для уточнения причин!</h2>
                                    <a href="mailto:puteeva@mail.ru" target="_blank">Написать</a>
                                    <a href="tel:+375338372322" target="_blank">Позвонить</a>
                                @endif  
                        @else
                            <h2>Для добавления сообщения аутентифицируйтесь!</h2>
                        @endif  
                    </div> 
                </div> 


            @foreach($messages as $key => $value)
            <!-- @<php foreach ($messages as $key => $value): ?> -->
                <hr>
                <div class="row">
                    <div class="col-md-8" style="margin: 10px auto;">
                        <h2>{{$value->name}}</h2>
                        <p>{{$value->text}}</p>
                        <p class="text-danger">+{{$value->phone}}</p>
                        <a href="tel:+{{$value->phone}}">Отозваться</a>
                    </div>
               </div> 
            <!-- <php endforeach ?> -->
            @endforeach
            <hr>
        </div>

    </body>
</html>
