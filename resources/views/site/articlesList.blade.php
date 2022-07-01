@extends('layouts.site')

@section('content')

    @if(isset($articles) && count($articles) > 0)
        <div class="card">
            <div class="card-header">  {{ $subCategory->name }}</div>

            <div class="card-body m-0 p-0">
                <div class="list-group">
                    @foreach($articles as $article)
                        <a href="{{ url('article/' . $article->id ) }}" class="list-group-item list-group-item-action"> 
                                
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $article->name }}</h5>
                            </div>
                            <p> {!! $article->authors !!} </p>
                            <small> {{ $subCategory->category->name }} / {{ $article->subcategory->name }} </small>
                        </a>

                    @endforeach
                </div>
            </div>

            <div class="card-footer">
                @if($articles->links())
                    {{ $articles->links() }}
                @endif
            </div>
        </div>
    @else
        <div class='alert alert-danger'> Não há artigos cadastrados para essa edição </div>
    @endif

@endsection
