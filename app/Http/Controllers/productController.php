<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\StockModel;
use Redirect;
use DB;

class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function productList(Request $request)
    {
        //Laravel standards
        $products = ProductModel::paginate(2);
        
        //custom query
        $query = DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->join('stock', 'stock.id', '=', 'products.stock_id');
        //category filter
        $categoryFilter = $request->input('category') ?? '';
        if ($categoryFilter) {
            $query->where('categories.id', $categoryFilter);
        }
        //price filter
          $minPriceFilter = $request->input('min_price') ?? 0;
          $maxPriceFilter = $request->input('max_price') ?? 0;
        if ($minPriceFilter > 0 && $maxPriceFilter > 0) {
            $query->where('products.price', '>', $minPriceFilter)->where('products.price', '<', $maxPriceFilter);
        }
        
        $products = $query->select('products.*', 'categories.name as categoryName', 'stock.name as StockName')->get();
        
        $categoryData = CategoryModel::where('status', 'active')->get();
        return view('products')->with('products', $products)->with('categoryData', $categoryData)->with('categoryFilter', $categoryFilter);
    }

    public function manageProduct(Request $request, $productId = null)
    {
        $productInfo  = array();
        if ($productId) {
            $productId = base64_decode($productId);
            $productInfo = ProductModel::find($productId);
        }
        if ($request->isMethod('POST')) {
            $formData = $request->all();
            if ($productInfo) {
                $productImage = $productInfo->image;
            }
            if ($request->has('product_image')) {
                $productImage =  time() . $request->product_image->getClientOriginalExtension();
                $request->product_image->storeAs('images', $productImage);
            }

 

            $dataArray = array(
                        'name' => $formData['productName'],
                        'category_id' => $formData['category'],
                        'stock_id' => $formData['stock'],
                        'image' => $productImage ?? 'default.jpg' ,
                        'status' => $formData['status'] ,
                        'price' => $formData['product_price'],
                        );
                        
            if ($productInfo) {
                $dataArray['updated_at'] = date("Y-m-d H:i:s");
                $result =   ProductModel::where("id", $productId)->update($dataArray);
            } else {
                $dataArray['created_at'] = date("Y-m-d H:i:s");
                $dataArray['slug'] = $this->createSlug($dataArray['name']);
                $result =   ProductModel::insert($dataArray);
            }
            if ($result) {
                return Redirect::to('product-list')->with('message', 'Product saved successfully!');
            } else {
                return Redirect::to('product-list')->with('error', 'Something went wrong please try again');
            }
        } else {
            $categoryData = CategoryModel::where('status', 'active')->get();
            
            $stockData = StockModel::all();
         
            
            return view('manage-product')->with('productInfo', $productInfo)->with('categoryData', $categoryData)->with('stockData', $stockData);
        }
    }

    public function createSlug($name)
    {
        $cleanSlug = str_replace(" ", "-", strtolower($name));
        if (ProductModel::where('slug', $cleanSlug)->first()) {
            return time() . '-' . $cleanSlug;
        } else {
            return $cleanSlug;
        }
    }
}