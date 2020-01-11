@extends('adminlte::page')

@section('title', '管理后台')

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">创建用户</h3>
        </div>

        {{ Form::open(['route' => 'admin.user.store', 'class' => 'form-horizontal', 'method' => 'post']) }}
            @include('admin.user._form')
        {{ Form::close() }}

    </div>
@stop


