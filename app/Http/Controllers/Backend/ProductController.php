<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request, Stock $stock)
    {
        $categoryInStock = Category::whereStockId($stock->id)->pluck('id')->toArray();
        $products = Product::whereIn('category_id', $categoryInStock)
                        ->with('category')
                        ->get()
                        ;
        return view('backend.product.index')
            ->withStock($stock)
            ->withProducts($products)
            ;
    }

    public function create(Request $request, Stock $stock)
    {
        $suppliers = Supplier::whereStockId($stock->id)->get();
        $categories = Category::whereStockId($stock->id)->get();
        return view('backend.product.add_edit_product')
            ->withStock($stock)
            ->withSuppliers($suppliers)
            ->withCategories($categories)
            ;
    }

    public function store(Request $request, Stock $stock)
    {
        $data = $request->only([
            'name',
            // 'slug',
            'description',
            'images',
            'status',
            'sku',
            'supplier_sku',
            'cost',
            'price',
            'category_id',
            'supplier_id',
            'quantity',
        ]);

        $prodImages = [];

        if ($request->hasFile('images')) {
            foreach($request->file('images') as $img)
            {
                $imgName = Date('YmdHis') . '_' . $img->getClientOriginalName();
                $img->move(public_path(Product::PUBLIC_PROD_IMAGE_FOLDER), $imgName);
                $prodImages[] = $imgName;
            }
        }

        $data['images'] = json_encode($prodImages);

        $data['slug'] = Str::slug($data['name']);

        $product = Product::create($data);

        return redirect()->back();
    }

    public function update()
    {

    }
}
