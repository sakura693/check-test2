@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="container-heading">
        <h2 class="container-heading__text">商品一覧</h2>

        <a class="add-btn btn" href="/products/register">+ 商品を追加</a>
    </div>

    <div class="product-content">
        <form class="search-form" action="/products/search" method="get">
            <div class="search-form__content">

                <!--左側の機能-->
                <div class="product-content__left-column">
                    <!--検索機能-->
                    <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                    <!--検索ボタン-->
                    <input class="search-form__btn btn" type="submit" value="検索">
           
                    <!--ソート機能-->
                    <div class="product-sort">
                        <label class="product-sort__label">価格順で表示</label>
                        <select class="sort-select">
                            <option value="up">高い順に表示</option>
                            <option value="down">低い順に表示</option>
                        </select>
                    </div>
                </div>    
        
                <!--写真の部分-->
                <div class="product-content__group">
                    <!--商品一覧をgridで表示-->
                    <div class="product-cards">
                        @foreach($products as $product)
                        
                        <a class="product-card" href="/products/{{ $product->id }}">
                            <div class="product-card__img-wrapper">
                                <img class="product-card__img" src="{{ asset( $product->image ) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="product-body">
                                <p class="product-name">{{ $product->name }}</p>
                                <P class="product-price">￥{{ $product->price }}</P>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
            <!--ページネーション-->
            <div class="pagination">
                {{ $products->links() }}
            </div>
         </form>
    </div>
</div>

@endsection
