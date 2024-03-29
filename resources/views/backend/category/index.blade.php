@extends('backend.index')

@section('title', 'Basic Stock Manager' . ' | ' . 'Admin Dashboard')

@section('breadcrumb-links')
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1 col-md-4">{{ $stock->name }}/Categories</h2>
                <div class="btn-create">
                    <button class="btn btn-success btn-add-category" {{--data-toggle="modal" data-target="#update-stock-dialog"--}}>Add Category</button>
                    <a href="{{ route('admin.products.create', $stock->id) }}" class="btn btn-success btn-add-product" {{--data-toggle="modal" data-target="#update-stock-dialog"--}}>Add Product</a>
                    <a href="{{ route('admin.products.index', $stock->id) }}" class="btn btn-dark btn-add-product">All Products</a>
                </div>
                <div class="btn-create-product">

                </div>
                <div class="bs-example widget-shadow" data-example-id="contextual-table">
                    <h4>Categories List</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>SKU</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $index => $category)
                        <tr data-category_id="{{ $category->id }}" class="active">
                            <th scope="row"> {{ $index }}</th>
                            <td class="name"><a href="">{{ $category->name }}</a></td>
                            <td class="description">{{ $category->description }}</td>
                            <td class="sku">{{ $category->sku }}</td>
                            <td class="status" data-status_val="{{ $category->status }}">{{ $category->status ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <button class="btn btn-primary btn-edit-category"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/categories.js') }}"></script>
    <input type="hidden" value="{{ $stock->id }}" name="stock_id">
    @include('backend.category.includes.add_update_category_dialog')
@endsection
{{--{{ script('js/stocks.js') }}--}}
