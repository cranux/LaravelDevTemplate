<div class="card-body">
    <div class="form-group row">
        {{ Form::label('appid', 'AppID', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('wechat[appid]', isset($setting['wechat']['appid']) ? $setting['wechat']['appid']: '', ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('app_secret', 'AppSecret', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('wechat[app_secret]', isset($setting['wechat']['app_secret']) ? $setting['wechat']['app_secret']: '', ['class' => 'form-control']) }}
        </div>
    </div>
</div>

