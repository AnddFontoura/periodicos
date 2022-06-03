@extends('layouts.admin')

@section('content')
<div class="container">
    <form action='{{ url("admin/page/save") }}@if(isset($page))/{{ $page->id }}@endif' method='POST'>
        @csrf
        <div class='card'>
            <div class='card-header'>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/page') }}">Artigo</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novo Artigo</li>
                    </ol>
                </nav>
            </div>

            <div class='card-body'>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingArticleName" placeholder="Nome da Pagina" value='@if(isset($page)){{ $page->name }}@endif' name='name'>
                    <label for="floatingArticleName">Nome da pagina </label>
                </div>

                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea id="ckeditor-description" name="description">@if(isset($page)){{ $page->description }}@endif</textarea>
                </div>
            </div>

            <div class='card-footer'>
                <button type="submit" class='btn bnt-lg btn-success'> @if(isset($page)) Atualizar @else Cadastrar @endif página </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
    <script>
        CKEDITOR.replace('ckeditor-description');
    </script>
@endsection
