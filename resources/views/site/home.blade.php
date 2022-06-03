@extends('layouts.site')

@section('content')

    @if(isset($page))

        <h3 class="border-bottom"> {{$page->name }}</h3>

        {!! $page->description !!}
    @endif

@endsection
