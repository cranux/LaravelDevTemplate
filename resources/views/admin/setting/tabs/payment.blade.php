<div class="card-body">
    <div class="form-group row">
        {{ Form::label('app_id', 'AppID', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('payment[app_id]', isset($setting['payment']['app_id']) ? $setting['payment']['app_id'] : '', ['class' => 'form-control', 'placeholder' => '微信支付AppID']) }}
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('mch_id', '商户号', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('payment[mch_id]', isset($setting['payment']['mch_id']) ? $setting['payment']['mch_id'] : '', ['class' => 'form-control', 'placeholder' => '微信支付商户号']) }}
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('key', 'API密钥', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            {{ Form::text('payment[key]', isset($setting['payment']['key']) ? $setting['payment']['key'] : '', ['class' => 'form-control', 'placeholder' => '微信支付秘钥']) }}
        </div>
    </div>


    <div class="form-group row">
        {{ Form::label('apiclient_cert', '支付证书', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            <div class="input-group">
                {{ Form::text('payment[cert_path]', isset($setting['payment']['cert_path']) && file_exists($setting['payment']['cert_path']) ? "证书apiclient_cert.pem已上传" : '', ['class' => 'form-control','id'=>'thumb-input','readonly'=>'readonly','placeholder'=>'商户号后台下载证书，并上传apiclient_cert.pem']) }}
                <span class="input-group-btn">
                     <span class="btn btn-info fileinput-button">
                        <span>上传证书</span>
                        <input id="fileupload1" type="file" name="file">
                    </span>
                </span>
            </div>
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('apiclient_key', '证书秘钥', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-lg-10">
            <div class="input-group">
                {{ Form::text('payment[key_path]', isset($setting['payment']['key_path']) && file_exists($setting['payment']['key_path']) ? '证书apiclient_key.pem已上传' : '', ['class' => 'form-control','id'=>'thumb-input','readonly'=>'readonly','placeholder'=>'商户号后台下载证书，并上传apiclient_key.pem']) }}
                <span class="input-group-btn">
                     <span class="btn btn-info fileinput-button">
                        <span>上传证书</span>
                        <input id="fileupload2" type="file" name="file">
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>

@push('css')
    <link href="https://cdn.staticfile.org/blueimp-file-upload/9.18.0/css/jquery.fileupload.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.staticfile.org/blueimp-file-upload/9.18.0/js/vendor/jquery.ui.widget.min.js"></script>
    <script src="https://cdn.staticfile.org/blueimp-file-upload/9.18.0/js/jquery.iframe-transport.min.js"></script>
    <script src="https://cdn.staticfile.org/blueimp-file-upload/9.18.0/js/jquery.fileupload.min.js"></script>
    <script>
        $(function () {
            'use strict';

            // Change this to the location of your server-side upload handler:

            $('#fileupload1').fileupload({
                url: "/admin/upload?type=2",
                dataType: 'json',
                type: 'POST',
                done: function (e, data) {
                    console.log(data);
                    if (data.result.code > 5000) {
                        alert(data.result.message);
                        return;
                    }

                    $('#thumb-preview').attr('src', data.result.url);
                    $('#thumb-input').val(data.result.url);

                }
            });
            $('#fileupload2').fileupload({
                url: "/admin/upload?type=2",
                dataType: 'json',
                type: 'POST',
                done: function (e, data) {
                    if (data.result.code > 5000) {
                        alert(data.result.message);
                    }
                    $('#thumb-preview').attr('src', data.result.url);
                    $('#thumb-input').val(data.result.url);
                }
            });
        });
    </script>
@endpush
