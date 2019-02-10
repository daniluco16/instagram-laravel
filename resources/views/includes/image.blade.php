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

        <div class="comments">
            <a href="" class="btn btn-sm btn-comments">Comentarios {{count($image->comments)}}</a>

        </div>
        <div class="fecha">
            <span class="nickname date">{{\FormatTime::LongTimeFilter($image->created_at) }}</span>
        </div>


    </div>

</div>