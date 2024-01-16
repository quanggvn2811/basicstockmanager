@extends('backend.index')

@section('title', 'Basic Stock Manager' . ' | ' . 'Admin Dashboard')

@section('breadcrumb-links')
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1 col-md-4">{{ $stock->name }}/All Products</h2>
                <div class="btn-create">
                    <a href="{{ route('admin.products.create', $stock->id) }}" class="btn btn-success btn-add-product">Add Product</a>
                </div>
                <div class="bs-example widget-shadow" data-example-id="contextual-table">
                    <h4>Products List</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Avatar</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <?php
                                $prodImages = json_decode($product->images);
                                $avatar = $prodImages[0];
                                $avatarSrc = asset(\App\Models\Product::PUBLIC_PROD_IMAGE_FOLDER . '/' . $avatar);
                                ?>
                        <tr data-product_id="{{ $product->id }}" class="active product-lines">
                            <td class="sku"> {{ $product->sku }}</td>
                            <td class="name"><a href="#">{{ $product->name }}</a></td>
                            <td class="description">{{ $product->description }}</td>
                            <td class="avatar"><img style="max-width: 150px; max-height: 150px" src="{{ $avatarSrc }}"></td>
                            <td class="quantity">
                                <button class="btn btn-danger"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-default">
                                    {{ $product->quantity }}
                                </button>
                                <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                            </td>
                            <td class="category">{{ $product->category->name }}</td>
                            <td class="status" data-status_val="{{ $product->status }}">{{ $product->status ? 'Active' : 'Inactive' }}</td>
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
    <style>
        .product-lines td {
            vertical-align: middle !important;
        }
        .product-lines .name, .product-lines .description {
            max-width: 250px;
        }
    </style>
    <script src="{{ asset('js/categories.js') }}"></script>
    <input type="hidden" value="{{ $stock->id }}" name="stock_id">
    @include('backend.category.includes.add_update_category_dialog')
@endsection
{{--{{ script('js/stocks.js') }}--}}
