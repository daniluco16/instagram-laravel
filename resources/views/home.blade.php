@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            @include('includes.message')

            @foreach($images as $image)

            <div class="card pub_image">

                <div class="card-header">

                    @if($image->users->image)

                    <div class="container-avatar">

                        <img src=" {{ route('user.avatar', ['filename' => $image->users->image]) }}"/>

                    </div>

                    @endif                    

                    <div class="data-user">
                        <a href="{{ route('image.detail', ['id' => $image->id])}}">
                            {{ $image->users->name . ' ' . $image->users->surname}}

                            <span class="nickname">

                                {{' | @' . $image->users->nick }}

                            </span>
                        </a>
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
                    <div class="fecha">
                        <span class="nickname date">{{\FormatTime::LongTimeFilter($image->created_at) }}</span>
                    </div>


                </div>

            </div>
            @endforeach

            <!--PAGINACIÓN-->

            <div class="clearfix">



            </div>
            <div class="d-flex justify-content-center">

                {{ $images->links()}}

            </div>

        </div>


    </div>
</div>
@endsection
