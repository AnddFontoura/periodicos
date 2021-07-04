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
                                <a href='{{ url("subcategory/view/" . $subcategory->id) }}'><div class='btn btn-success fas fa-eye fa-lg'></div></a>
                                <a href='{{ url("subcategory/edit/" . $subcategory->id) }}'><div class='btn btn-primary fas fa-edit fa-lg'></div></a>
                                <div class='btn btn-danger fas fa-trash-alt fa-lg deleteCategory' data-id='{{ $subcategory->id }}'></div>
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

        @if($subcategories->links())
        <div class='card-footer'>
            {{ $subcategories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('js')
    <script>
        $('.deleteCategory').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Deseja realmente excluir esse registro?',
                showDenyButton: true,
                confirmButtonText: `Deletar`,
                denyButtonText: `Não deletar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var request = $.ajax({
                        url: '{{ url("subcategory/delete") }}' + '/' + id,
                        method: "GET",
                        dataType: "json"
                    });
                                
                    request.done(function() {
                        Swal.fire({
                            title: 'Pronto!',
                            text: 'A alteração foi realizada com sucesso',
                            type: 'success',
                            buttons: true,
                        })
                        .then((buttonClick) => {
                            if (buttonClick) {
                            location.reload();
                            }
                        });
                        });

                        request.fail(function( ) {
                        Swal.fire(
                            'Erro',
                            'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
                            'error'
                        )
                    });
                } else if (result.isDenied) {
                    Swal.fire('Nenhum registro deletado', '', 'info')
                }
            });
        });
    </script>
@endsection