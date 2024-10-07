<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\Product_Season;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $products = Product::Paginate(6);
        return view('product', compact('products'));
    } 

    public function register(){
        $seasons = Season::all();
        return view('register', compact('seasons'));
    } 

    /*今のままだとエラーメッセージが一つしか出力されない*/
    public function store(ProductRequest $request){
        $products = $request->all();
        
        // 画像を保存する処理
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public');
            $products['image_path'] = $path;
        }

        Product::create($products);
        return redirect('/products'); /*ビューファイル名（ product.blade.php）は必ずURLに直接対応するわけではないからルート（/products）で書いた方が確実かみたい！*/
    }

    /*詳細画面に遷移*/
    public function show($product_id){
        $product = Product::with('seasons')->find($product_id);
        $selectedSeasonIds = $product->seasons->pluck('id')->toArray();

        $seasons = Season::all();
        
        return view('detail', compact('product', 'selectedSeasonIds', 'seasons'));
    }

    /*削除機能*/
    public function destroy(Request $request){
        Product::find($request->id)->delete();
        return redirect('/products');
    }





    /*これ必要？？*/
    public function search(Request $request){
        $query = Product::query();

        $query = $this->getSearchQuery($request, $query);
        
        return view('search', compact('products'));
    }

    /*これも必要？？検索機能（仮）*/
    private function getSearchQuery($request, $query)
    {
        if(!empty($request->keyword)){
            $query->where('keyword', 'like', '%' . $request->keyword . '%');
        }

        return $query;
    }
}

