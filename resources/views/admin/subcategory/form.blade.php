@extends('layouts.admin')

@section('content')
<div class="container">
    <form action='{{ url("admin/subcategory/save") }}@if(isset($subcategory))/{{ $subcategory->id }}@endif' method='POST'>
        @csrf
        <div class='card'>
            <div class='card-header'>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/subcategory') }}">Sub Categoria</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nova Subcategoria</li>
                    </ol>
                </nav>
            </div>

            <div class='card-body'>
                <label for="floatingCategoryName">Nome da Sub categoria </label>
                @error('categoryId')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating mb-3">
                    <select class="form-control select2" name="categoryId" id="floatingCategoryName" placeholder="Nome da Categoria">
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(isset($subcategory) && $category->subcategory_id == $subCategory->id) selected @endif> {{ $category->name }} </option>
                            @endforeach
                        @else
                            <option selected>Nenhuma categoria cadastrada, antes de continuar você deve cadastra ao menos uma</option>
                        @endif
                    </select>
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingSubCategoryName" placeholder="Nome da subcategoria" value='@if(isset($subcategory)){{ $subcategory->name }}@endif' name='name'>
                    <label for="floatingSubCategoryName">Nome da Subcategoria </label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingDescription" placeholder="Descrição da Subcategoria" value='@if(isset($subcategory)){{ $subcategory->description }}@endif' name='description'>
                    <label for="floatingDescription">Descrição da Subcategoria</label>
                </div>
            </div>

            <div class='card-footer'>
                <button type="submit" class='btn bnt-lg btn-success'> @if(isset($subcategory)) Atualizar @else Cadastrar @endif Subcategoria </button>
            </div>
        </div>
    </form>
</div>
@endsection
