<div class="card-body ">
    <div class="form-group row ">
        {{ Form::label('nickname', '昵称', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            @if ($errors->has('nickname'))
                {{ Form::text('nickname', null, ['class' => 'form-control is-invalid', 'placeholder' => '微信昵称']) }}
            @else
                {{ Form::text('nickname', null, ['class' => 'form-control', 'placeholder' => '微信昵称']) }}
            @endif
            @if ($errors->has('nickname'))
                <p class="help-block">
                    <code>{{ $errors->first('nickname') }}</code>
                </p>
            @endif
        </div>
    </div>

</div>
<div class="card-footer">
    <button type="submit" class="btn btn-info">提交</button>
    <button type="button" class="btn btn-default float-right" onclick="javascript:history.back(-1);">取消</button>
</div>
