<div class="card-body ">
    <div class="form-group  row ">
        {{ Form::label('name', '账号', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            @if(isset($user))
                {{ Form::text('name', null, ['class' => 'form-control ', 'placeholder' => '账号','disabled'=>'disabled']) }}
            @else
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '账号']) }}
            @endif

        </div>
    </div>
    <div class="form-group row ">
        {{ Form::label('email', '邮箱', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            @if(isset($user))
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '登录邮箱','disabled'=>'disabled']) }}
            @else
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '登录邮箱']) }}
            @endif

        </div>
    </div>
    <div class="form-group row ">
        {{ Form::label('password', '密码', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            @if ($errors->has('password'))
                {{ Form::password('password', ['class' => 'form-control is-invalid', 'placeholder' => '密码']) }}
            @else
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '密码']) }}
            @endif
            @if ($errors->has('password'))
                <p >
                    <code>{{ $errors->first('password') }}</code>
                </p>
            @endif
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('password_confirmation', '确认密码', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            @if ($errors->has('password_confirmation'))
            {{ Form::password('password_confirmation',['class' => 'form-control is-invalid', 'placeholder' => '确认密码']) }}
            @else
            {{ Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => '确认密码']) }}
            @endif
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('is_administrator', '管理员', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-1">
            @if(isset($user) && $user->hasRole('administrator'))
                {{ Form::checkbox('is_administrator', '1',true) }}
            @else
                {{ Form::checkbox('is_administrator', '1') }}
            @endif
        </div>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-info">提交</button>
    <button type="button" class="btn btn-default float-right" onclick="javascript:history.back(-1);">取消</button>
</div>
