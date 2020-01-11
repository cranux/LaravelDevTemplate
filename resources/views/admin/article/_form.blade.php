<div class="card-body ">
    <div class="form-group row">
        {{ Form::label('title', '标题', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            @if ($errors->has('title'))
                {{ Form::text('title', null, ['class' => 'form-control is-invalid', 'placeholder' => '文章标题']) }}
                <p class="help-block">
                    <code>{{ $errors->first('title') }}</code>
                </p>
                @else
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => '文章标题']) }}
            @endif
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('thumb', '缩略图', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            <div class="input-group">
                {{ Form::text('thumbnail', null, ['class' => 'form-control','id'=>'thumb-input','readonly'=>'readonly']) }}
                <span class="input-group-btn">
                     <span class="btn btn-info fileinput-button">
                        <span>选择图片</span>
                        <input id="fileupload" type="file" name="file">
                    </span>
                </span>
            </div>

            <div class="input-group">
                <img src="@if(isset($article) && $article->thumbnail)  {{ $article->thumbnail }} @else {{ asset('/images/nopic.jpg') }} @endif"
                     id="thumb-preview" class="img-responsive img-thumbnail">
            </div>
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('content', '内容', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            <script id="container" name="content" type="text/plain">
                @if(isset($article))
                    {!! $article->content !!}
                @endif
            </script>
        </div>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-info">提交</button>
    <button type="button" class="btn btn-default float-right" onclick="javascript:history.back(-1);">取消</button>
</div>

@include('vendor.ueditor.assets')


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
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            autoHeightEnabled: true,
            initialFrameHeight: 500,
            autoFloatEnabled: false,
            toolbars: [
                ['fullscreen', 'source', 'bold', 'italic', 'underline', '|', 'justifyleft', 'justifyright', 'justifycenter', '|', 'removeformat', 'formatmatch', 'forecolor', 'autotypeset', '|', 'simpleupload', 'insertimage']
            ]
        });
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endpush
