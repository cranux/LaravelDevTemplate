@extends('adminlte::page')

@section('title', '管理后台')

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">编辑用户</h3>
        </div>

        {{ Form::model($user, ['route' => ['admin.user.update', $user], 'class' => 'form-horizontal',  'method' => 'PATCH']) }}
            @include('admin.user._form')
        {{ Form::close() }}

    </div>
@stop


