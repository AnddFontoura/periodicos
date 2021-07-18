@extends('layouts.admin')

@section('content')
<div class="container">
    <div class='card'>
        <div class='card-header'>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('category') }}">Categoria</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar</li>
                </ol>
            </nav>
        </div>

        <div class='card-body'>
            @if(sizeof($categories) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col" width='10%'>#</th>
                        <th scope="col" width='30%'>Sub Categoria</th>
                        <th scope="col" width='30%'>Categoria</th>
                        <th scope="col" width='30%' class='text-right'>Opções</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td> {{ $category->id }} </td>
                            <td> {{ $category->subcategory->name }} </td>
                            <td> {{ $category->name }} </td>
                            <td>
                                <a href='{{ url("category/view/" . $category->id) }}'><div class='btn btn-success fas fa-eye fa-lg'></div></a>
                                <a href='{{ url("category/form/" . $category->id) }}'><div class='btn btn-primary fas fa-edit fa-lg'></div></a>
                                <div class='btn btn-danger fas fa-trash-alt fa-lg deleteCategory' data-id='{{ $category->id }}'></div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger" role="alert">
                    Não existem Categorias cadastradas. Você pode começar a cadastrar agora.
                </div>

                <a href='{{ url("category/form") }}' class='btn btn-lg btn-success'> Cadastrar Categoria </a>
            @endif
        </div>

        @if($categories->links())
        <div class='card-footer'>
            {{ $categories->links() }}
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
                        url: '{{ url("api/category/delete") }}',
                        method: "POST",
                        dataType: "json",
                        data: { categoryId : id },
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
