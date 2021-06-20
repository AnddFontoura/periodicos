@extends('layouts.admin')

@section('content')
<div class="container">
    <div class='card'>
        <div class='card-header'>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('subcategory') }}">Sub Categoria</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar</li>
                </ol>
            </nav>
        </div>

        <div class='card-body'>
            @if(sizeof($subcategories) > 0)
                @foreach($subcategories as $subcategory)
                    
                @endforeach
            @else 
                <div class="alert alert-danger" role="alert">
                    Não existem Sub Categorias cadastradas. Você pode começar a cadastrar agora.
                </div>

                <a href='{{ url("subcategory/form") }}' class='btn btn-lg btn-success'> Cadastrar Sub Categoria </a>
            @endif
        </div>

        @if(!$subcategories->links())
        <div class='card-footer'>
            {{ $subcategories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
