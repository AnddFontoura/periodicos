@extends('layouts.admin')

@section('content')
<div class="container">
    <form action='{{ url("category/save") }}@if(isset($category))/{{ $category->id }}@endif' method='POST'>
        @csrf
        <div class='card'>
            <div class='card-header'>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('category') }}">Categoria</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nova Categoria</li>
                    </ol>
                </nav>
            </div>

            <div class='card-body'>
                <label for="floatingCategoryName">Nome da Sub categoria </label>
                @error('subCategoryId')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating mb-3">
                    <select class="form-control select2" name="subCategoryId" id="floatingSubCategoryName" placeholder="Nome da categoria">
                        @if(count($subCategories) > 0)
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" @if(isset($category) && $category->subcategory_id == $subCategory->id) selected @endif> {{ $subCategory->name }} </option>
                            @endforeach
                        @else
                            <option selected>Nenhuma Sub categoria cadastrada, antes de continuar você deve cadastra ao menos uma</option>
                        @endif
                    </select>
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingSubCategoryName" placeholder="Nome da categoria" value='@if(isset($category)){{ $category->name }}@endif' name='name'>
                    <label for="floatingCategoryName">Nome da categoria </label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingDescription" placeholder="Descrição da categoria" value='@if(isset($category)){{ $category->description }}@endif' name='description'>
                    <label for="floatingDescription">Descrição da categoria</label>
                </div>
            </div>

            <div class='card-footer'>
                <button type="submit" class='btn bnt-lg btn-success'> @if(isset($category)) Atualizar @else Cadastrar @endif nova categoria </button>
            </div>
        </div>
    </form>
</div>
@endsection
