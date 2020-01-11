@extends('adminlte::page')

@section('title', '管理后台')

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">编辑会员</h3>
        </div>

        {{ Form::model($member, ['route' => ['admin.member.update', $member], 'class' => 'form-horizontal',  'method' => 'PATCH']) }}
            @include('admin.member._form')
        {{ Form::close() }}

    </div>
@stop


