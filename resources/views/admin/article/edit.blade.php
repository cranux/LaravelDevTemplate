@extends('adminlte::page')

@section('title', '管理后台')

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">编辑文章</h3>
        </div>

        {{ Form::model($article, ['route' => ['admin.article.update', $article], 'class' => 'form-horizontal',  'method' => 'PATCH']) }}
            @include('admin.article._form')
        {{ Form::close() }}

    </div>
@stop


