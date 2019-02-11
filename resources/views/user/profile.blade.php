@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

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
                </div>
                
                <div class="clearfix"></div>
                
                <hr>
            </div>

            <div class="clearfix"></div>

            @foreach($user->images as $image)

            @include('includes.image', ['image' => $image])

            @endforeach



        </div>


    </div>
</div>
@endsection