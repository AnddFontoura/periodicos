@extends('layouts.site')

@section('content')

    @if(isset($subCategories) && count($subCategories) > 0)

        <h3 class=""> {{ $category->name }} </h3>

        <div class="list-group">
            @foreach($subCategories as $subCategory)
                <a href="{{ url('subcategory/' . $subCategory->id ) }}" class="list-group-item list-group-item-action">{{ $subCategory->name }}</a>
            @endforeach
        </div>

        <hr>

        @if($subCategories->links())
            {{ $subCategories->links() }}
        @endif
    @else
        <div class="alert alert-danger"> Não existem revistas nessa edição ainda </div>
    @endif



@endsection
