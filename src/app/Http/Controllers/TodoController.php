<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        return view('index', compact('todos', 'categories'));
    }
    public function store(TodoRequest $request)
    {
        $todo = $request->only(['category_id', 'content']);
        Todo::create($todo);

        return redirect('/')->with('message', 'Todoを作成しました');
    }
    public function update(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::find($request->id)->update($todo);

        return redirect('/')->with('message', 'Todoを更新しました');
    }
    public function destroy(TodoRequest $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', $request->content.'を削除しました');
    }
    public function search(Request $request)
    {
        // デバッグ情報をログに出力
        Log::info('Search request received', [
            'keyword' => $request->keyword,
            'category_id' => $request->category_id,
            'all_params' => $request->all()
        ]);
        
        $query = Todo::with('category');
        
        // カテゴリ検索
        if ($request->filled('category_id')) {
            $query->categorySearch($request->category_id);
        }
        
        // キーワード検索
        if ($request->filled('keyword')) {
            $query->keywordSearch($request->keyword);
        }
        
        $todos = $query->get();
        $categories = Category::all();
        
        // デバッグ情報をログに出力
        Log::info('Search results', [
            'todos_count' => $todos->count(),
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        return view('index', compact('todos', 'categories'));
    }
}
