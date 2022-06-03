@extends('layouts.admin')

@section('content')
<div class="container">
    <form action='{{ url("admin/category/save") }}@if(isset($category))/{{ $category->id }}@endif' method='POST'>
        @csrf
        <div class='card'>
            <div class='card-header'>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">Categoria</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nova Categoria</li>
                    </ol>
                </nav>
            </div>

            <div class='card-body'>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingSubCategoryName" placeholder="Nome da categoria" value='@if(isset($category)){{ $category->name }}@endif' name='name'>
                    <label for="floatingCategoryName">Nome da categoria </label>
                </div>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingDescription" placeholder="Descrição da categoria" value='@if(isset($category)){{ $category->description }}@endif' name='description'>
                    <label for="floatingDescription">Descrição da categoria</label>
                </div>
            </div>

            <div class='card-footer'>
                <button type="submit" class='btn bnt-lg btn-success'> @if(isset($category)) Atualizar @else Cadastrar @endif categoria </button>
            </div>
        </div>
    </form>
</div>
@endsection
