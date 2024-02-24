@extends('backend.index')

@section('title', 'Basic Stock Manager' . ' | ' . 'Admin Dashboard')

@section('breadcrumb-links')
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1 col-md-4" style="width: 100%; margin-top: .8em"><a href="{{ route('admin.categories.index', $stock->id) }}">{{ $stock->name }}</a>/Add Product</h2>
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('admin.products.store', ['stock' => $stock->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label for="prodName">Name</label>
                                <input required type="text" name="name" class="form-control" id="prodName" placeholder="Name">
                            </div>
                            {{--<div class="form-group">
                                <label for="prodSlug">Slug</label>
                                <input type="text" class="form-control" id="prodSlug" placeholder="Slug">
                            </div>--}}
                            <div class="form-group">
                                <label for="prodDescription">Description</label>
                                <textarea class="form-control" id="prodDescription" name="description" cols="30" rows="5" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="prodSupplier">Supplier</label>
                                <select required class="form-control" id="prodSupplier" name="supplier_id">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Images</label>
                                <input type="file" name="images[]" multiple id="prodImages"> <p class="help-block">Select product image(s)</p>
                            </div>
                            <div class="checkbox">
                                <label> <input type="checkbox" name="status"><b>Status</b></label>
                            </div>
                            <div class="form-group">
                                <label for="prodSku">SKU</label>
                                <input name="sku" required type="text" class="form-control" id="prodSku" placeholder="SKU">
                            </div>
                            <div class="form-group">
                                <label for="prodSupplierSku">Supplier SKU</label>
                                <input name="supplier_sku" type="text" class="form-control" id="prodSupplierSku" placeholder="Supplier SKU">
                            </div>
                            <div class="form-group">
                                <label for="prodCost">Cost</label>
                                <input name="cost" required type="number" class="form-control" id="prodCost" placeholder="Cost">
                            </div>
                            <div class="form-group">
                                <label for="prodPrice">Price</label>
                                <input required type="number" name="price" class="form-control" id="prodPrice" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="prodCategory">Category</label>
                                <select required class="form-control" id="prodCategory" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="prodQuantity">Quantity</label>
                                <input required type="number" class="form-control" name="quantity" id="prodQuantity" placeholder="Quantity">
                            </div>
                            <div class="form-group">
                                <label for="prodQuantity">Type</label>
                                <select required class="form-control prodType" id="prodType" name="type">
                                    @foreach(\App\Models\Product::PRODUCT_TYPE as $val => $type)
                                        <option value="{{ $val }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group sub_product_section" style="display: none">
                                <label for="prodQuantity">Sub Products</label>
                                <input required type="text" class="form-control" name="sub_product_sku" id="prodSubProduct" placeholder="Press Sub Product SKU, Ex: MKAR018;MKBN006;...">
                            </div>
                            @if(isset($product))
                                <button type="submit" class="btn btn-default">Update</button>
                            @else
                                <button type="submit" class="btn btn-success">Create</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/products.js') }}"></script>
@endsection
