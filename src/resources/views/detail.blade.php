@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-content">
    <div class="content-heading">
        <a class="index" href="/products">商品一覧</a>><span class="fruit-name">{{ $product->name }}</span>
    </div>

    <form class="detail-form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
        @csrf
        <!--ファイルから季節までの部分-->
        <div class="detail-form__upper">
            <!--ファイル部分-->
            <div class="detail-form__left">
                <div class="detail-form__group">
                    <img class="fruit-img" src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="{{ $product->name }}">
                    <input class="file-btn" type="file">
                    <p class="detail-form__error-message">
                        <!--⇩分らん-->
                        @error('image')
                        {{ $message }}
                        @enderror
                    </p> 
                </div>
            </div>

            <!--商品名から季節までの部分-->
            <div class="detail-form__right">
                <div class="detail-form__group">
                    <label class="detail-form__label" for="name">商品名</label>
                    <input class="detail-form__input" type="text" name="name" id="name" value="{{ $product->name }}" placeholder="商品名を入力">
                    <p class="detail-form__error-message">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="detail-form__group">
                    <label class="detail-form__label" for="price">値段</label>
                    <input class="detail-form__input" type="text" name="price" id="price" value="{{ $product->price }}" placeholder="値段を入力">
                    <p class="detail-form__error-message">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <!--とりま保留（product_idのseasonを取得しcheckedにする-->
                <div class="detail-form__group">
                    <label class="detail-form__label" for="season">季節</label>
                    <div class="detail-form__option-inner">
                        @foreach($seasons as $season)
                        <div class="detail-form__option">
                            <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, $selectedSeasonIds) ? 'checked' : '' }}>
                            <label>{{ $season->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    <p class="detail-form__error-message">
                        @error('season')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        

        <div class="detail-form__group">
            <label class="detail-form__label" for="price">商品説明</label>
            <textarea class="detail-form__textarea" name="description" id="" placeholder="商品の説明を入力">{{ $product->description }}</textarea> <!--※ここでは$がいる-->
            <p class="detail-form__error-message">
                @error('description')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="detail-form__btn-inner">
            <a class="detail-form__back-btn btn"  href="/products">戻る</a>
            <input class="detail-form__update-btn btn" type="submit" value="変更を保存" name="update">
            <input type="hidden" name="id" value="{{ $product->id }}">
        </div>
        
    </form>

    <!--削除ボタン-->
    <form action="/products/{{ $product->id }}/delete" method="post">
        @csrf
        <input class="delete-btn" type="submit" value="削除">
        <input type="hidden" name="id" value="{{ $product->id }}">
    </form>
</div>
@endsection