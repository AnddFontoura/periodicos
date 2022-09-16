@extends('layouts.admin')

@section('content')
<div class="container">
    <div class='card'>
        <div class='card-header'>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('article') }}">Artigos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar</li>
                </ol>
            </nav>
        </div>

        <form method="GET" action="{{ url('admin/article') }}">
        <div class="card">
            <div class="card-header">
                Filtrar
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingSubCategoryId" placeholder="Id do Artigo" value='@if(Request::get('articleId')){{ Request::get('articleId') }}@endif' name='articleId'>
                            <label for="floatingCategoryName">Id do Artigo </label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingSubCategoryName" placeholder="Nome do Artigo" value='@if(Request::get('articleName')){{ Request::get('articleName') }}@endif' name='articleName'>
                            <label for="floatingCategoryName">Nome do Artigo </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header text-end">
                <button class="btn btn-success" type="submit">Filtrar</button>
            </div>
        </div>
    </form>

        <div class='card-body'>
            @if(sizeof($articles) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col" width='10%'>#</th>
                        <th scope="col" width='30%'>Sub Categoria</th>
                        <th scope="col" width='30%'>Nome</th>
                        <th scope="col" width='30%' class='text-end'>Opções</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($articles as $article)
                        <tr>
                            <td> {{ $article->id }} </td>
                            <td> {{ $article->subcategory->name ?? '' }} </td>
                            <td> {{ $article->name }} </td>
                            <td class='text-end'>
                                <a href='{{ url("admin/article/view/" . $article->id) }}'><div class='btn btn-success fas fa-eye fa-lg'></div></a>
                                <a href='{{ url("admin/article/form/" . $article->id) }}'><div class='btn btn-primary fas fa-edit fa-lg'></div></a>
                                <div class='btn btn-danger fas fa-trash-alt fa-lg deleteCategory' data-id='{{ $article->id }}'></div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger" role="alert">
                    Não existem Artigos cadastrados. Você pode começar a cadastrar agora.
                </div>

                <a href='{{ url("admin/article/form") }}' class='btn btn-lg btn-success'> Cadastrar Artigo </a>
            @endif
        </div>

        @if($articles->links())
        <div class='card-footer'>
            {{ $articles->links() }}
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
                        url: '{{ url("api/article/delete") }}',
                        method: "POST",
                        dataType: "json",
                        data: { articleId : id },
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
