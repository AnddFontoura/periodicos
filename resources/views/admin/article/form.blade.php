@extends('layouts.admin')

@section('content')
<div class="container">
    <form action='{{ url("article/save") }}@if(isset($article))/{{ $article->id }}@endif' method='POST'>
        @csrf
        <div class='card'>
            <div class='card-header'>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('article') }}">Artigo</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novo Artigo</li>
                    </ol>
                </nav>
            </div>

            <div class='card-body'>
                <label for="floatingCategoryName">Nome da Sub categoria </label>
                @error('subCategoryId')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating mb-3">
                    <select class="form-control select2" name="subCategoryId" id="floatingSubCategoryName">
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
                    <input type="text" class="form-control" id="floatingArticleName" placeholder="Nome do artigo" value='@if(isset($article)){{ $article->name }}@endif' name='name'>
                    <label for="floatingArticleName">Nome do artigo </label>
                </div>

                @error('authors')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label class="form-label">Autores</label>
                    <textarea id="ckeditor-author" name="authors">@if(isset($article)){{ $article->authors }}@endif</textarea>
                </div>

                @error('name')
                    <div class="alert alert-danger">{{ resume }}</div>
                @enderror
                <div class="mb-3">
                    <label class="form-label">Resumo</label>
                    <textarea id="ckeditor-resume" name="resume">@if(isset($article)){{ $article->resume }}@endif</textarea>
                </div>

                @error('abstract')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label class="form-label">Abstract</label>
                    <textarea id="ckeditor-abstract" name="abstract">@if(isset($article)){{ $article->abstract }}@endif</textarea>
                </div>

                @error('keywords')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label class="form-label">Palavras-chaves</label>
                    <textarea class="form-control" name="keywords">@if(isset($article)){{ $article->keywords }}@endif</textarea>
                </div>

                @error('fileToUpload')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="formFile" class="form-label">Arquivo do Artigo</label>
                    <input class="form-control" type="file" id="formFile" name="fileToUpload">
                </div>
            </div>

            <div class='card-footer'>
                <button type="submit" class='btn bnt-lg btn-success'> @if(isset($article)) Atualizar @else Cadastrar @endif artigo </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
    <script>
        CKEDITOR.replace('ckeditor-author');
        CKEDITOR.replace('ckeditor-resume');
        CKEDITOR.replace('ckeditor-abstract');
    </script>
@endsection
