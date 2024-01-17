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
use phpDocumentor\Reflection\Type;

class ProductController extends Controller
{
    public function index(Request $request, Stock $stock)
    {
        $categoryInStock = Category::whereStockId($stock->id)->pluck('id')->toArray();
        $products = Product::whereIn('category_id', $categoryInStock)
                        ->with('category')
                        ->paginate(10)
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
            'type',
        ]);

        if ($data['type'] && Product::TYPE_MULTIPLE === intval($data['type']) && $request->get('sub_product_sku')) {
            $subProdSkus = explode(';', $request->get('sub_product_sku'));
            $subProdSkuArr = array_map('trim', $subProdSkus);
            $subProdIds = Product::whereIn('sku', $subProdSkuArr)->pluck('id')->toArray();
            if (count($subProdIds)) {
                $data['sub_product_id'] = json_encode($subProdIds);
            }
        }

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

        return redirect()->route('admin.products.index', ['stock' => $stock->id]);
    }

    public function update()
    {

    }

    public function updateQuantity(Request $request, Product $product)
    {
        $plusVal = $request->get('plus_value');
        $product->update([
            'quantity' => $product->quantity + $plusVal,
        ]);

        return response()->json([
            'status' => 'Update quantity successfully!',
            'product_quantity' => $product->quantity,
        ]);
    }
}
