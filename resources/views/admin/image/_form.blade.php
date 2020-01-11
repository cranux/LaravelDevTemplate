<div class="card-body ">
    <div class="form-group  row">
        {{ Form::label('sort', '排序', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            @if ($errors->has('sort'))
                {{ Form::text('sort', 1, ['class' => 'form-control is-invalid', 'placeholder' => '序号越大越靠前']) }}
                <p class="help-block">
                    <code>{{ $errors->first('sort') }}</code>
                </p>
                @else
                {{ Form::text('sort', 1, ['class' => 'form-control', 'placeholder' => '序号越大越靠前']) }}
            @endif
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('image', '缩略图', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            <div class="input-group">
                {{ Form::text('image', null, ['class' => 'form-control','id'=>'thumb-input','readonly'=>'readonly']) }}
                <span class="input-group-btn">
                     <span class="btn btn-info fileinput-button">
                        <span>选择图片</span>
                        <input id="fileupload" type="file" name="file">
                    </span>
                </span>
            </div>
            <div class="input-group">
                <img src="@if(isset($image) && $image->image)  {{ $image->image }} @else {{ asset('/images/nopic.jpg') }} @endif"
                     id="thumb-preview" class="img-responsive img-thumbnail">
            </div>
        </div>
    </div>

    <div class="form-group  row">
        {{ Form::label('status', '是否显示', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::radio('status', '1',true) }} 显示
            {{ Form::radio('status', '0') }} 不显示
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>


<div class="card-footer">
    <button type="submit" class="btn btn-info">提交</button>
    <button type="button" class="btn btn-default float-right" onclick="javascript:history.back(-1);">取消</button>
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

            $('#fileupload').fileupload({
                url: "/admin/upload",
                dataType: 'json',
                type: 'POST',
                done: function (e, data) {
                    if (data.result.code > 5000) {
                        alert(data.result.message);
                        return;
                    }
                    $('#thumb-preview').attr('src', data.result.url);
                    $('#thumb-input').val(data.result.url);
                }
            });
        });

    </script>
@endpush
