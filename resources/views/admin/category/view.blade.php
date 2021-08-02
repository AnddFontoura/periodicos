@extends('layouts.admin')

@section('content')
<div class="container">
    <div class='card'>
        <div class='card-header'>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('category') }}">Categoria</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Exibir</li>
                </ol>
            </nav>
        </div>

        <div class='card-body'>
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">{{ $category->name }}</h1>
                    <p class="col-md-8 fs-4">{{ $category->description }}</p>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-md-6">
                    <div class="h-100 p-3 text-white bg-success rounded-3">
                    <h2>SubCategorias nessa Categoria</h2>
                    <p>{{ $countSubCategory }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="h-100 p-3 text-white bg-primary rounded-3">
                    <h2>Artigos</h2>
                    <p>{{ $countArticle }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
