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


    public function search(Request $request)
    {
        $sort = $request->input('sort');
        $keyword = $request->input('keyword');
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
        
        return view('product', compact('products', 'sort', 'keyword'));
    }


    public function register(){
        $seasons = Season::all();
        return view('register', compact('seasons'));
    } 

    public function store(ProductRequest $request){
        $products = $request->all();

        if($request->hasFile('image')){
            $path = $request->file('image')->store('fruits-img', 'public');

            $urlPath = str_replace('public/', '', $path);
            $urlPath = 'storage/' . $urlPath;

            $products['image'] = $urlPath;
        }

        $product = Product::create($products);

        if ($request->has('seasons')){
            $product->seasons()->attach($request->input('seasons'));
        }

        return redirect('/products'); 
    }

    public function show($product_id){
        $product = Product::with('seasons')->find($product_id);
        $selectedSeasonIds = $product->seasons->pluck('id')->toArray();

        $seasons = Season::all();
        
        return view('detail', compact('product', 'selectedSeasonIds', 'seasons'));
    }


    public function destroy(Request $request, $product_id){
        $product = Product::find($product_id);
        $product->delete();
        return redirect('products');
    }


    public function update(ProductRequest $request, $product_id){
        $form = $request->all();
        
        $product = Product::find($product_id);

        if ($request->hasfile('image')){
            $form['image'] = $request->file('image')->store('fruits-img', 'public');
            $form['image'] = 'storage/' . str_replace('public/', '', $form['image']);
        }else {
            $form['image'] = $product->image;
        }

        $product->update($form); 

        return redirect('products');
    }

   
}

