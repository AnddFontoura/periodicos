@extends('layouts.admin')

@section('content')
<div class="container">

    <form method="GET" action="{{ url('admin/subcategory') }}">
        <div class="card">
            <div class="card-header">
                Filtrar
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <select class="form-control select2" name="categoryId" id="floatingCategoryName" placeholder="Nome da Categoria">
                                @if(count($categories) > 0)
                                    <option value="0"> Nenhuma Categoria Especifica </option>

                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if(isset($subcategory) && $category->subcategory_id == $subCategory->id) selected @endif> {{ $category->name }} </option>
                                    @endforeach
                                @else
                                    <option selected>Nenhuma categoria cadastrada, antes de continuar você deve cadastra ao menos uma</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingSubCategoryId" placeholder="Id da Sub Categoria" value='@if(Request::get('subCategoryId')){{ Request::get('subCategoryId') }}@endif' name='subCategoryId'>
                            <label for="floatingCategoryName">Id da Sub Categoria </label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingSubCategoryName" placeholder="Nome da Sub Categoria" value='@if(Request::get('subCategoryName')){{ Request::get('subCategoryName') }}@endif' name='subCategoryName'>
                            <label for="floatingCategoryName">Nome da Sub Categoria </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header text-end">
                <button class="btn btn-success" type="submit">Filtrar</button>
            </div>
        </div>
    </form>

    <div class='card mt-3'>
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
                        <th scope="col" width='30%'>Categoria</th>
                        <th scope="col" width='30%'>Sub Categoria</th>
                        <th scope="col" width='20%' class='text-end'>Opções</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($subcategories as $subcategory)
                        <tr>
                            <td> {{ $subcategory->id }} </td>
                            <td> {{ $subcategory->category->name }} </td>
                            <td> {{ $subcategory->name }} </td>
                            <td class='text-end'>
                                <a href='{{ url("subcategory/view/" . $subcategory->id) }}'><div class='btn btn-success fas fa-eye fa-lg'></div></a>
                                <a href='{{ url("subcategory/form/" . $subcategory->id) }}'><div class='btn btn-primary fas fa-edit fa-lg'></div></a>
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

                <a href='{{ url("admin/subcategory/form") }}' class='btn btn-lg btn-success'> Cadastrar Sub Categoria </a>
            @endif
        </div>

        @if($subcategories->links())
        <div class='card-footer'>
            {{ $subcategories->appends(request()->query())->links() }}
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
                        url: '{{ url("api/subcategory/delete") }}',
                        method: "POST",
                        dataType: "json",
                        data: { subCategoryId : id },
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
