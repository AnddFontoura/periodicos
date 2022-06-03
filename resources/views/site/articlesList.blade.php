@extends('layouts.site')

@section('content')

    @if(isset($articles) && count($articles) > 0)

        @if(isset($subCategory))

            <h3 class=""> {{ $subCategory->name }}</h3>

        @endif

        <div class="list-group">
            @foreach($articles as $article)
                <a href="{{ url('article/' . $article->id ) }}" class="list-group-item list-group-item-action">{{ $article->name }}</a>
            @endforeach
        </div>

        @if($articles->links())
            {{ $articles->links() }}
        @endif
    @else
        <div class='alert alert-danger'> Não há artigos cadastrados para essa edição </div>
    @endif

@endsection
