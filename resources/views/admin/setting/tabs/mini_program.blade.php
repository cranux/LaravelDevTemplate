<div class="card-body">
    <div class="form-group row">
        {{ Form::label('appid', 'AppID', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('mini_program[appid]', isset($setting['mini_program']['appid']) ? $setting['mini_program']['appid']: '', ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('app_secret', 'AppSecret', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('mini_program[app_secret]', isset($setting['mini_program']['app_secret']) ? $setting['mini_program']['app_secret']: '', ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('token', 'Token', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('mini_program[token]', isset($setting['mini_program']['token']) ? $setting['mini_program']['token']: '', ['class' => 'form-control','placeholder' => '选填']) }}
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('aes_key', 'EncodingAESKey', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('mini_program[aes_key]', isset($setting['mini_program']['aes_key']) ? $setting['mini_program']['aes_key']: '', ['class' => 'form-control','placeholder' => '选填']) }}
        </div>
    </div>
</div>
