@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-content">
    <h2 class="register-content_heading">商品登録</h2>
    <form  class="register-form" action="/products" method="post" enctype="multipart/form-data">
        @csrf
        <div class="register-form__group">
            <label class="register-form__label" for="name">商品名<span class="register-form__required">必須</span>
            </label>
            <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力"> 
            <p class="register-form__error-message">
                @error('name')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="register-form__group">
            <label class="register-form__label" for="price">値段<span class="register-form__required">必須</span>
            </label>
            <input class="register-form__input" type="text" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
            <p class="register-form__error-message">
                @error('price')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="register-form__group">
            <label class="register-form__label" for="price">商品画像<span class="register-form__required">必須</span>
            </label>

            <!--ファイルを選択ボタン-->
            <input class="file-btn" type="file" name="image">
            <p class="register-form__error-message">
                <!--⇩分らん-->
                @error('image')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="register-form__group">
            <label class="register-form__label" for="season">季節<span class="register-form__required">必須</span>
            <span class="register-form_message">複数選択可</span>
            </label>

            <div class="register-form__option-inner">
                @foreach($seasons as $season)
                <div class="register-form__option">
                    <!--checkbox：複数選択
                    in_array：戻っても内容が保持される設定。seasonモデルからidを取り出し'seasons'(inputのnameで指定した名前なだけでcheckboxの値を表す)にそのidが含まれるか確認。含まれてればtrueを返しcheckeにする-->
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}> 
                    <label>{{ $season->name }}</label>
                </div>
                @endforeach
            </div>
            <p class="register-form__error-message">
                @error('season')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="register-form__group">
            <label class="register-form__label" for="price">商品説明<span class="register-form__required">必須</span>
            </label>
            <textarea class="register-form__textarea" name="description" id="" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            <p class="register-form__error-message">
                @error('description')
                {{ $message }}
                @enderror
            </p>
        </div>

        <!--ボタン-->
        <div class="register-form__btn-inner">
            <a class="register-form__back-btn btn"  href="/products">戻る</a>
            <input class="register-form__register-btn btn" type="submit" value="登録" name="register">
        </div>
    </form>
</div>


@endsection