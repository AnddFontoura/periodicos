@extends('layouts.admin')

@section('content')
<div class="container">
    <div class='card'>
        <div class='card-header'>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/article') }}">Categoria</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Exibir</li>
                </ol>
            </nav>
        </div>

        <div class='card-body'>
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">{{ $article->name }}</h1>
                    <p class="col-md-8 fs-4">{{ $category->name }} / {{ $subCategory->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
