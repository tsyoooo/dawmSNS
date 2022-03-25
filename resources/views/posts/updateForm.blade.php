@extends('layouts.login')
@section('content')
    <div class='container'>
        {!! Form::open(['url' => '/top']) !!}
        <div class="form-group">
            {!! Form::hidden('id', $post->id) !!}
            {!! Form::input('text', 'upPost', $post->posts, ['required', 'class' => 'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-primary pull-right"><img src="images/edit.png"></button>
        {!! Form::close() !!}
    </div>
    @endsection
