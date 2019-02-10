@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            @include('includes.message')

            @foreach($images as $image)

            @include('includes.image', ['image' => $image])
            
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
