@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('common.css') }}">
<link rel="stylesheet" href="{{ asset('category.css') }}">
@endsection

@section('content')
<!-- アラートメッセージ表示エリア -->
<div class="category__alert">
  @if(session('message'))
  <!-- 成功メッセージ -->
  <div class="category__alert--success">
    {{ session('message') }}
  </div>
  @endif
  @if ($errors->any())
  <!-- エラーメッセージ -->
  <div class="category__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>

<!-- メインコンテンツエリア -->
<div class="category__content">
  <!-- 新規作成セクション -->
  <div class="section__title">
    <h2>カテゴリ新規作成</h2>
  </div>
  <!-- 新規作成フォーム -->
  <form class="create-form" action="/categories" method="post">
    @csrf
    <div class="create-form__item">
      <!-- カテゴリ名入力フィールド -->
      <input
        class="create-form__item-input"
        type="text"
        name="name"
        value="{{ old('name') }}"
        placeholder="カテゴリ名を入力"
      />
    </div>
    <!-- 作成ボタン -->
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>

  <!-- カテゴリ一覧テーブル -->
  <div class="category-table">
    <table class="category-table__inner">
      <!-- テーブルヘッダー -->
      <tr class="category-table__row">
        <th class="category-table__header">
          <span class="category-table__header-span">カテゴリ名</span>
        </th>
        <th class="category-table__header">
          <span class="category-table__header-span">操作</span>
        </th>
      </tr>
      <!-- カテゴリアイテムの繰り返し表示 -->
      @foreach ($categories as $category)
      <tr class="category-table__row">
        <!-- カテゴリ名表示エリア -->
        <td class="category-table__item">
          <!-- 更新フォーム -->
          <form class="update-form" action="/categories/update" method="POST">
            @method('PATCH')
            @csrf
            <div class="update-form__item">
              <!-- カテゴリ名編集フィールド -->
              <input class="update-form__item-input" type="text" name="name" value="{{ $category['name'] }}">
              <!-- カテゴリ ID（隠しフィールド） -->
              <input type="hidden" name="id" value="{{ $category['id'] }}">
            </div>
            <!-- 更新ボタン -->
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </form>
        </td>
        <!-- 削除ボタンエリア -->
        <td class="category-table__item">
          <!-- 削除フォーム -->
          <form class="delete-form" action="/categories/delete" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
              <!-- カテゴリ ID（隠しフィールド） -->
              <input type="hidden" name="id" value="{{ $category['id'] }}">
              <!-- 削除ボタン -->
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection