@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">Доска объявлений: Панель управления</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Пользователь(-ли) {{ session('type') }} : {{ session('status') }} 
                        </div>
                    @endif

                    @if (session('errors'))
                        <div class="alert alert-danger" role="alert">
                            Пользователь(-ли) уже были {{ session('type') }} : {{ session('errors') }} 
                        </div>
                    @endif
                    

                    <div class="card">
                        <form action="/home" method="POST">
                            <div class="containerr">
                                <table border="1" class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Чек</th>
                                            <th>ИД</th>
                                            <th>Логин</th>
                                            <th>Имя</th>
                                            <th>Почта</th>
                                            <th>Забанен?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td><input type="checkbox" name="{{ $user->id }}"/></td>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->login }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td class="text-danger">{{ $user->block }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="container">
                                <nav class="navbar navbar-default">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="submit" id="deleteButton" name="delete"  class="btn btn-outline-danger" style="width: 20%;" value="Удалить" />
                                    <input type="submit" id="block" name="block"  class="btn btn-outline-danger" style="width: 20%;" value="Забанить" />
                                    <input type="submit" id="unblock" name="unblock" class="btn btn-outline-success" style="width: 20%;" value="Разбанить" />
                                    <input type="submit" id="ckeckButton" class="btn btn-outline-secondary" style="width: 20%;" value="Выбрать все" />
                                </nav>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
