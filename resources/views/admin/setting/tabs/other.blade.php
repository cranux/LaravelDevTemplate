<div class="card-body">
    <div class="form-group row">
        {{ Form::label('withdrawal_fee', '提现手续费', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            <div class="input-group">
                {{ Form::text('other[withdrawal_fee]', isset($setting['other']['withdrawal_fee']) ? $setting['other']['withdrawal_fee']: '', ['class' => 'form-control']) }}
                <div class="input-group-append">
                    <span class="input-group-text">%</span>
                </div>
            </div>
            <p class="help-block">提现所扣手续费百分比 (只需填写数字即可)</p>
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('recharge', '充值优惠', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">充值</span>
                </div>
                {{ Form::text('other[recharge1]', isset($setting['other']['recharge1']) ? $setting['other']['recharge1']: '', ['class' => 'form-control']) }}
                <div class="input-group-prepend">
                    <span class="input-group-text">元，送</span>
                </div>
                {{ Form::text('other[recharge2]', isset($setting['other']['recharge2']) ? $setting['other']['recharge2']: '', ['class' => 'form-control']) }}
                <div class="input-group-prepend">
                    <span class="input-group-text">元</span>
                </div>
            </div>
            <p class="help-block">
               充值越多送的越多
            </p>
        </div>
    </div>

</div>

