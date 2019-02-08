@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            @include('includes.message')

            <div class="card pub_image pub_image_detail">

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

                    <div class="image-container image-detail">

                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}"/>
                    </div>


                    <div class="description">
                        <span class="nickname">{{'@'. $image->users->nick}}</span>
                        <p>{{ $image->description }}</p>

                    </div>

                    <div class="likes">
                        <img src="{{asset('img/heart.png')}}">
                    </div>
                    <div class="clearfix">

                    </div>
                    <div class="comments">
                        <h2>Comentarios {{count($image->comments)}}</h2>
                        <hr>

                        <form method="post" action="{{ route('comment.save') }}">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <p>
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : ''}}" name="content"></textarea>

                                @if($errors->has('content'))
                            <div class="">
                                <span class="alert alert-danger" role='alert'>

                                    <strong>{{ $errors->first('content') }}</strong>

                                </span>
                            </div>

                            @endif
                            </p>

                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-success">
                                    Enviar
                                </button>
                            </div>


                        </form>
                        <hr>
                        @foreach($image->comments as $comment)

                        <div class="comment">

                            <div class="description">
                                <span class="nickname">{{'@'. $comment->users->nick}}</span>
                                <p>{{ $comment->content }}
                                    <span class="nickname date">{{\FormatTime::LongTimeFilter($image->created_at) }}</span>

                                    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                <div>
                                    <a href=" {{route('comment.delete', ['id' => $comment->id])}} " class="btn btn-sm btn-danger">Eliminar</a>

                                </div>

                                @endif
                                </p>
                            </div>


                        </div>

                        @endforeach

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