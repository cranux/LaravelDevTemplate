@extends('adminlte::page')

@section('title', '管理后台')

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">创建文章</h3>
        </div>
        {{ Form::open(['route' => 'admin.article.store', 'class' => 'form-horizontal', 'method' => 'post']) }}
            @include('admin.article._form')
        {{ Form::close() }}
    </div>
@stop


