@extends('adminlte::page')

@section('title', '管理后台')

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">编辑图片信息</h3>
        </div>
        {{ Form::model($image, ['route' => ['admin.image.update', $image], 'class' => 'form-horizontal',  'method' => 'PATCH']) }}
            @include('admin.image._form')
        {{ Form::close() }}

    </div>
@stop


