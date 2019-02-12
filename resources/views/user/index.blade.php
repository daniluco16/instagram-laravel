@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <h1 class="d-flex justify-content-center">Usuarios</h1>
            <form method="GET" action="{{route('user.index')}}" id="buscador">
                <div class="row">

                    <div class="form-group col">

                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>


                </div>


            </form>
            <hr>
            @foreach($users as $user)

            <div class="col-12 profile-user">

                @if($user->image)

                <div class="container-avatar">

                    <img src=" {{ route('user.avatar', ['filename' => $user->image]) }}"/>

                </div>

                @endif 

                <div class="user-info">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name}}</h2>
                    <p>{{'Se unio hace: '. \FormatTime::LongTimeFilter($user->created_at) }}</p>
                    <a href="{{route('profile', ['id' => $user->id])}}" class="btn btn-success">Ver perfil</a>
                </div>

                <div class="clearfix"></div>

                <hr>
            </div>
            @endforeach

            <!--PAGINACIÓN-->

            <div class="clearfix"></div>
            <div class="d-flex justify-content-center">

                {{ $users->links()}}

            </div>

        </div>


    </div>
</div>
@endsection
