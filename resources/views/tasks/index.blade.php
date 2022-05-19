@extends('layouts.app')

@section('content')

     @if (Auth::check())

        <h1>タスク一覧</h1>
        @if (count($tasks) > 0)
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>タスク</th>
                        <th>ステータス</th> {{--追加--}}
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                        <td>{{ $task->content }}</td>
                        <td>{{ $task->status }}</td> {{--追加--}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
            {{-- タスク作成ページへのリンク --}}
        {!! link_to_route('tasks.create', '新規タスクの登録', [], ['class' => 'btn btn-primary']) !!}
    
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the TaskList</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'ユーザー登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif    

@endsection