<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        
    {
        $tasks =[];    
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
        //タスク一覧を取得

            $tasks = $user->tasks()->orderBy('id', 'asc')->get();
        }        
    
        // タスク一覧ビューで表示
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);        
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;

        // タスク作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly creasted resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーションを追加
        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
        ]);
    
        // タスクを作成
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        
        
        // トップページへリダイレクト
        return redirect('/');        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         // idでタスクを検索して取得
        $task = Task::findOrFail($id);
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を表示
        if (\Auth::id() === $task->user_id) {
            return view('tasks.show', [
                'task' => $task,
            ]);
        }
        return back();
        // タスク詳細でそれを表示
//        return view('tasks.show', [
//            'task' => $task,
//        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idでタスクを検索して取得
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id) {
            // タスク編集Viewで表示
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーションを追加
        $request->validate([
            'content' => 'required',   
            'status' => 'required|max:10',
        ]);


        // idでタスクを検索して取得
        $task = Task::findOrFail($id);
        // タスクを更新
        if (\Auth::id() === $task->user_id) {
    
            $task->content = $request->content;
            $task->status = $request->status; //追加
            $task->save();
        // トップページへリダイレクト

            return redirect('/');
        }
        return back();    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idでタスクを検索して取得
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id) {
            // タスクを削除
            $task->delete();
            // トップページへリダイレクト
            return redirect('/');
        }
        return back();
    }
}
