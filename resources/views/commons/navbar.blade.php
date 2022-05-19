<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand" href="/">TaskList</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                {{-- タスク作成ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('tasks.create', '新規タスクの登録', [], ['class' => 'nav-link']) !!}</li>
{{-- ログインしていない場合は、ログインと登録の表示 --}}

                @else
                     {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'ユーザー登録', [], ['class' => 'nav-link']) !!}</li>

                    {{-- ログインページへのリンク --}}
                    <li class="nav-item"><a href="#" class="nav-link">ログイン</a></li>


                   
                    
                    {{-- ログインページへのリンク --}}
 {{--                   <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li> --}}
                
                @endif                
            </ul>
        </div>
    </nav>
</header>
