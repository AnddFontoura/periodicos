@extends('layouts.site')

@section('content')

    @if(isset($homePage))

        <h3 class="border-bottom"> {{$homePage->name }}</h3>

        {!! $homePage->description !!}
    @endif

@endsection
