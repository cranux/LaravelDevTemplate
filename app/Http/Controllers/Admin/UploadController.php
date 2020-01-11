<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        $file = $request->file('file');
        if (! $file) {
            return response()->json([
                'code' => '5001',
                'message' => '上传失败',
            ]);
        }
        //上传证书文件
        if (request('type') == 2) {
            //获取上传目录
            $fileName = $file->getClientOriginalName();
            if (! in_array($fileName, ['apiclient_key.pem', 'apiclient_cert.pem'])) {
                return response()->json([
                    'code' => '5002',
                    'message' => '请上传对应名称的证书',
                ]);
            }
            $fileExtension = $file->getClientOriginalExtension();
            if ($fileExtension != 'pem') {
                return response()->json([
                    'code' => '5003',
                    'message' => '证书格式错误',
                ]);
            }
            $filePath = Storage::disk('local')->putFileAs('apiclient/'.Hashids::encode(session('uuid')), $file, $fileName);

            return response()->json([
                'code' => '1001',
                'message' => '上传成功',
                'url' => $filePath,
            ]);
        } else {
            //图片
            $mimeType = $file->getClientMimeType();
            if (! Str::contains($mimeType, 'image/')) {
                return response()->json([
                    'code' => '5004',
                    'message' => '图片格式错误',
                ]);
            }
            $path = 'images/'.date('Ymd');
            $filePath = $file->store($path);

            return response()->json([
                'code' => '1001',
                'message' => '上传成功',
                'url' => Storage::url($filePath),
            ]);
        }
    }
}
