@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('common.css') }}">
<link rel="stylesheet" href="{{ asset('index.css') }}">
@endsection

@section('content')
<!-- アラートメッセージ表示エリア -->
<div class="todo__alert">
  @if(session('message'))
  <!-- 成功メッセージ -->
  <div class="todo__alert--success">
    {{ session('message') }}
  </div>
  @endif
  @if ($errors->any())
  <!-- エラーメッセージ -->
  <div class="todo__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>

<!-- メインコンテンツエリア -->
<div class="todo__content">
  <!-- 新規作成セクション -->
  <div class="section__title">
    <h2>新規作成</h2>
  </div>
  <!-- 新規作成フォーム -->
  <form class="create-form" action="/todos" method="post">
    @csrf
    <div class="create-form__item">
      <!-- Todo内容入力フィールド -->
      <input
        class="create-form__item-input"
        type="text"
        name="content"
        value="{{ old('content') }}"
      />
      <!-- カテゴリ選択ドロップダウン -->
      <select class="create-form__item-select" name="category_id">
        @foreach ($categories as $category)
        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
        @endforeach
      </select>
    </div>
    <!-- 作成ボタン -->
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>

  <!-- 検索セクション -->
  <div class="section__title">
    <h2>Todo検索</h2>
  </div>
  <!-- 検索フォーム -->
  <form class="search-form" action="/todos/search" method="get">
    <div class="search-form__item">
      <!-- 検索キーワード入力フィールド -->
      <input class="search-form__item-input" type="text" name="keyword" value="{{ request('keyword') }}">
      <!-- 検索用カテゴリ選択ドロップダウン -->
      <select class="search-form__item-select" name="category_id">
        <option value="">カテゴリを選択</option>
        @foreach ($categories as $category)
        <option value="{{ $category['id'] }}" {{ request('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
        @endforeach
      </select>
    </div>
    <!-- 検索ボタン -->
    <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
  </form>

  <!-- Todo一覧テーブル -->
  <div class="todo-table">
    <table class="todo-table__inner">
      <!-- テーブルヘッダー -->
      <tr class="todo-table__row">
        <th class="todo-table__header">
          <span class="todo-table__header-span">Todo</span>
          <span class="todo-table__header-span">カテゴリ</span>
        </th>
      </tr>
      <!-- Todoアイテムの繰り返し表示 -->
      @foreach ($todos as $todo)
      <tr class="todo-table__row">
        <!-- Todo内容とカテゴリ表示エリア -->
        <td class="todo-table__item">
          <!-- 更新フォーム -->
          <form class="update-form" action="/todos/update" method="POST">
            @method('PATCH')
            @csrf
            <div class="update-form__item">
              <!-- Todo内容編集フィールド -->
              <input class="update-form__item-input" type="text" name="content" value="{{ $todo['content'] }}">
              <!-- Todo ID（隠しフィールド） -->
              <input type="hidden" name="id" value="{{ $todo['id'] }}">
            </div>
            <div class="update-form__item">
              <!-- カテゴリ表示 -->
              <p class="update-form__item-p">{{ $todo['category']['name'] }}</p>
            </div>
            <!-- 更新ボタン -->
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </form>
        </td>
        <!-- 削除ボタンエリア -->
        <td class="todo-table__item">
          <!-- 削除フォーム -->
          <form class="delete-form" action="/todos/delete" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
              <!-- Todo ID（隠しフィールド） -->
              <input type="hidden" name="id" value="{{ $todo['id'] }}">
              <!-- Todo内容（隠しフィールド） -->
              <input type="hidden" name="content" value="{{ $todo['content'] }}">
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