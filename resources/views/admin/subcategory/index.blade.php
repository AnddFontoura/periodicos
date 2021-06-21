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
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col" width='10%'>#</th>
                        <th scope="col" width='30%'>Nome</th>
                        <th scope="col" width='40%'>Descrição</th>
                        <th scope="col" width='20%' class='text-right'>Opções</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($subcategories as $subcategory)
                        <tr>
                            <td> {{ $subcategory->id }} </td>
                            <td> {{ $subcategory->name }} </td>
                            <td> {{ $subcategory->description }} </td>
                            <td> 
                                <a href=''><div class='btn btn-success fas fa-eye fa-lg'></div></a>
                                <a href=''><div class='btn btn-primary fas fa-edit fa-lg'></div></a>
                                <a href=''><div class='btn btn-danger fas fa-trash-alt fa-lg'></div></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
