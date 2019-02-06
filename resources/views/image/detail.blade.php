@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            @include('includes.message')

            <div class="card pub_image">

                <div class="card-header">

                    @if($image->users->image)

                    <div class="container-avatar">

                        <img src=" {{ route('user.avatar', ['filename' => $image->users->image]) }}"/>

                    </div>

                    @endif                    

                    <div class="data-user">

                        {{ $image->users->name . ' ' . $image->users->surname}}

                        <span class="nickname">

                            {{' | @' . $image->users->nick }}

                        </span>
                    </div>
                </div>

                <div class="card-body">

                    <div class="image-container">

                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}"/>
                    </div>


                    <div class="description">
                        <span class="nickname">{{'@'. $image->users->nick}}</span>
                        <p>{{ $image->description }}</p>

                    </div>

                    <div class="likes">
                        <img src="{{asset('img/heart.png')}}">
                    </div>

                    <div class="comments">
                        <a href="" class="btn btn-sm btn-comments">Comentarios {{count($image->comments)}}</a>
                    </div>

                    <div class="fecha text-right">
                        <span class="nickname date">{{\FormatTime::LongTimeFilter($image->created_at) }}</span>
                    </div>

                </div>

            </div>


        </div>


    </div>
</div>
@endsection