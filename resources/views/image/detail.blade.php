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


                        <!--Comprobar si el usuario le dio like a la imagen-->

                        <?php $user_like = FALSE; ?>

                        @foreach($image->likes as $like)

                        @if($like->users->id == Auth::user()->id)

                        <?php $user_like = TRUE; ?>

                        @endif

                        @endforeach

                        @if($user_like)

                        <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                        @else
                        <img src="{{asset('img/heart.png')}}" data-id="{{$image->id}}" class="btn-like">
                        @endif

                        <span class="number_likes"><strong>{{count($image->likes)}}</strong></span>
                    </div>
                    <div class="clearfix">

                    </div>
                    @if(Auth::user() && Auth::user()->id == $image->user_id)

                    <div class="actions p-3">

                        <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
                        <!--<a href="{{ route('image.delete', ['id' => $image->id])}}" class="btn btn-danger">Borrar</a>-->


                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                            Eliminar
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿Estas seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Si eliminas esta imagen nunca podras recuperarla. 
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('image.delete', ['id' => $image->id])}}" class="btn btn-danger">Borrar</a>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    @endif
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