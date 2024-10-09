<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\Product_Season;

class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::Paginate(6);
        return view('product', compact('products'));
    } 

    /*検索*/
    public function search(Request $request)
    {
        $sort = $request->input('sort'); /*sortはviewファイルのselectタグ内のnameでつけた名前*/
        $productsQuery = Product::with('seasons')->ProductSearch($request->id)
        ->KeywordSearch($request->keyword);

        if ($request->has('reset')){
            return redirect('/products')->withInput();
        }

        if ($sort === 'up'){
            $productsQuery->orderBy('price', 'desc');
        }elseif($sort === 'down'){
            $productsQuery->orderBy('price', 'asc');
        }

        $products = $productsQuery->paginate(6);
        
        return view('product', compact('products', 'sort'));
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
            $path = $request->file('image')->store('fruits-img', 'public');

            $urlPath = str_replace('public/', '', $path);
            $urlPath = 'storage/' . $urlPath;

            $products['image'] = $urlPath;
        }

        $product = Product::create($products);

        /*seasonsの関連付けを行う*/
        if ($request->has('seasons')){
            $product->seasons()->attach($request->input('seasons'));
        }

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
    public function destroy(Request $request, $product_id){
        $product = Product::find($product_id);
        $product->delete();
        return redirect('products');
    }

    /*更新機能*/
    public function update(ProductRequest $request, $product_id){
        $form = $request->all();
        
        $product = Product::find($product_id);

         // 新しい画像を保存し正しいURLを生成
        if ($request->hasfile('image')){
            $form['image'] = $request->file('image')->store('fruits-img', 'public');
            $form['image'] = 'storage/' . str_replace('public/', '', $form['image']);
        }else {
            $form['image'] = $product->image;
        }

        $product->update($form);  //既存の画像をそのまま使う

        return redirect('products');
    }

   
}

