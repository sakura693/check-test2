@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <div class="product-content__left-column">
                    <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                    <input class="search-form__btn btn" type="submit" value="検索">
           
                    <div class="product-sort">
                        <label class="product-sort__label">価格順で表示</label>
                        <select class="sort-select" name="sort">
                            <option disabled selected>価格で並べ替え</option>
                            <option value="up" {{ request('sort') === 'up' ? 'selected' : '' }}>高い順に表示</option>
                            <option value="down" {{ request('sort') === 'down' ? 'selected' : ''}}>低い順に表示</option>
                        </select>
                        
                        <div class="sort-tag">
                            @if(request('sort'))
                            <input type="hidden" name="reset">
                            <button class="sort-tag__reset" type="submit">{{ request('sort') === 'up' ? '高い順に表示' : (request('sort') === 'down' ? '低い順に表示' : '') }}
                                <div class='x-icon'>
                                    <i class="fa-regular fa-circle-xmark fa-lg" style="color: #fbd40e;"></i>
                                </div>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>    
        
                <div class="product-content__group">
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

            <div class="pagination">
                {{ $products->links() }}
            </div>
         </form>
    </div>
</div>

@endsection
