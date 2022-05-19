@extends('layouts.app')

@section('content')
    <h1>ユーザー登録</h1>
    <div class="row">
        <div class="col-6">
            {!! Form::open(['route' => 'signup.post']) !!}
            
                <div class="form-group">
                    {!! Form::label('name','氏名:') !!}
                    {!! Form::text('name', null,  ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス:') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                
                <div class="form-group">
                    {!! Form::label('password', 'パスワード:') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード（確認）:') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                 {!! Form::submit('登録', ['class' => 'btn btn-primary btm_block']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection