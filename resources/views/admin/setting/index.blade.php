@extends('adminlte::page')

@section('title', '管理后台')

@section('content')
    <div class="card card-primary card-outline ">
        <div class="card-header">
            <h3 class="card-title">系统设置</h3>
        </div>
        <div class="card-body">
            {{ Form::model($setting, ['route' => ['admin.setting.update', $setting], 'class' => 'form-horizontal',  'method' => 'PATCH']) }}
            @include('admin.setting._form')
            @if(isset($tab))
                <input type="hidden" name="tab" value="{{ $tab }}" >
            @else
                <input type="hidden" name="tab" value="1" >
            @endif
            {{ Form::close() }}
        </div>
    </div>
@stop


