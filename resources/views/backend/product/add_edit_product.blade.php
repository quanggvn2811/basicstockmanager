@extends('backend.index')

@section('title', 'Basic Stock Manager' . ' | ' . 'Admin Dashboard')

@section('breadcrumb-links')
@endsection

@section('content')
    <?php $isEdit = isset($product); ?>
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1 col-md-4" style="width: 100%; margin-top: .8em"><a href="{{ route('admin.categories.index', $stock->id) }}">{{ $stock->name }}</a>/Add Product</h2>
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-body">
                        @php
                            $routeForm = route('admin.products.store', ['stock' => $stock->id]);
                            if ($isEdit) {
                                $routeForm = route('admin.products.update', ['stock' => $stock->id, 'product' => $product->id]);
                            }
                        @endphp
                        <form enctype="multipart/form-data" method="post" action="{{ $routeForm }}">
                            @csrf
                            <div class="form-group">
                                <label for="prodName">Name</label>
                                <input required type="text" @if($isEdit) value="{{ $product->name }}" @endif name="name" class="form-control" id="prodName" placeholder="Name">
                            </div>
                            {{--<div class="form-group">
                                <label for="prodSlug">Slug</label>
                                <input type="text" class="form-control" id="prodSlug" placeholder="Slug">
                            </div>--}}
                            <div class="form-group">
                                <label for="prodDescription">Description</label>
                                <textarea class="form-control" id="prodDescription" name="description" cols="30" rows="5" placeholder="Description">@if($isEdit) {!! $product->description !!} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="prodSupplier">Supplier</label>
                                <select required class="form-control" id="prodSupplier" name="supplier_id">
                                    @foreach($suppliers as $supplier)
                                        <?php
                                            $selectedSupplier = '';
                                            if ($isEdit && $supplier->id === $product->supplier_id) {
                                                $selectedSupplier = 'selected';
                                            }
                                        ?>
                                        <option {{ $selectedSupplier }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Images</label>
                                <input type="file" name="images[]" multiple id="prodImages"> <p class="help-block">Select product image(s)</p>
                            </div>
                            <div class="checkbox">
                                <?php
                                    $checkedStatus = '';
                                    if ($isEdit && $product->status) {
                                        $checkedStatus = 'checked';
                                    }
                                ?>
                                <label> <input {{ $checkedStatus }} value="1" type="checkbox" name="status"><b>Status</b></label>
                            </div>
                            <div class="form-group">
                                <label for="prodSku">SKU</label>
                                <input name="sku" @if($isEdit) value="{{ $product->sku }}" @endif required type="text" class="form-control" id="prodSku" placeholder="SKU">
                            </div>
                            <div class="form-group">
                                <label for="prodSupplierSku">Supplier SKU</label>
                                <input @if($isEdit) value="{{ $product->supplier_sku }}" @endif name="supplier_sku" type="text" class="form-control" id="prodSupplierSku" placeholder="Supplier SKU">
                            </div>
                            <div class="form-group">
                                <label for="prodCost">Cost</label>
                                <input name="cost" @if($isEdit) value="{{ $product->cost }}" @endif required type="number" class="form-control" id="prodCost" placeholder="Cost">
                            </div>
                            <div class="form-group">
                                <label for="prodPrice">Price</label>
                                <input required @if($isEdit) value="{{ $product->price }}" @endif type="number" name="price" class="form-control" id="prodPrice" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="prodCategory">Category</label>
                                <select required class="form-control" id="prodCategory" name="category_id">
                                    @foreach($categories as $category)
                                        <?php
                                            $selectedCategory = '';
                                            if ($isEdit && $category->id == $product->category_id) {
                                                $selectedCategory = 'selected';
                                            }
                                        ?>
                                        <option {{ $selectedCategory }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="prodQuantity">Quantity</label>
                                <input @if($isEdit) value="{{ $product->quantity }}" @endif required type="number" class="form-control" name="quantity" id="prodQuantity" placeholder="Quantity">
                            </div>
                            <div class="form-group">
                                <label for="prodQuantity">Type</label>
                                <select required class="form-control prodType" id="prodType" name="type">
                                    @foreach(\App\Models\Product::PRODUCT_TYPE as $val => $type)
                                            <?php
                                            $selectedType = '';
                                            if ($isEdit && $val === $product->type) {
                                                $selectedType = 'selected';
                                            }
                                            ?>
                                        <option {{ $selectedType }} value="{{ $val }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <?php
                                $display = 'none';
                                if ($isEdit && \App\Models\Product::TYPE_MULTIPLE === $product->type) {
                                    $display = 'block';
                                }
                            ?>
                            <div class="form-group sub_product_section" style="display: {{$display}}">
                                <label for="prodQuantity">Sub Products</label>
                                <input @if($isEdit) value="{{ $subProductSku }}" @endif required type="text" class="form-control" name="sub_product_sku" id="prodSubProduct" placeholder="Press Sub Product SKU, Ex: MKAR018;MKBN006;...">
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
