@extends('layouts.site')

@section('content')

    @if(isset($article))

        <h3 class="border-bottom"> {{$article->name }}</h3>

        <a href="{{ asset('articles/' . $article->path) }}">
        <div class="alert alert-success">
            Para baixar o artigo clique aqui
        </div>
        </a>

        <div class="card mt-3">
            <div class="card-header">
                Autor(es)
            </div>

            <div class="card-body">
                {!! $article->authors !!}
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Resumo
            </div>

            <div class="card-body">
                {!! $article->resume !!}
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Abstract
            </div>

            <div class="card-body">
                {!! $article->abstract !!}
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Palavras Chave
            </div>

            <div class="card-body">
                {!! $article->authors !!}
            </div>
        </div>
    @endif

@endsection
