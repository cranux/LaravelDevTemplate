<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\MemberRepository;
use App\Repositories\Interfaces\SettingRepository;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


/**
 * Class WechatController
 * @package App\Http\Controllers\Api
 */
class WechatController extends Controller
{
    /**
     * @var MemberRepository
     */
    protected $memberRepository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * WechatController constructor.
     * @param MemberRepository $memberRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(MemberRepository $memberRepository, SettingRepository $settingRepository)
    {
        $this->memberRepository = $memberRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function onLogin(Request $request)
    {
        //验证code
        $code = request('code');
        if (! $code) {
            return response()->json([
                'code' => '4002',
                'message' => 'Required Code',
            ]);
        }
        //验证encryptedData
        $encryptedData = request('encryptedData');
        if (! $encryptedData) {
            return response()->json([
                'code' => '4003',
                'message' => 'Required EncryptedData',
            ]);
        }
        //验证iv
        $iv = request('iv');
        if (! $iv) {
            return response()->json([
                'code' => '4004',
                'message' => 'Required iv',
            ]);
        }

        //初始化小程序  TODO 设置信息根据后台设置读取
        $config = [
            'app_id' => '',
            'secret' => ''
        ];

        $miniProgram = Factory::miniProgram($config);

        $session = $miniProgram->auth->session($code);

        if (! isset($session['session_key'])) {
            return response()->json([
                'code' => '4005',
                'message' => 'UserInfo Get Failed',
            ]);
        }
        //解密用户信息
        try {
            $data = $miniProgram->encryptor->decryptData($session['session_key'], $iv, $encryptedData);
            if (!$data) {
                return response()->json([
                    'code' => '4006',
                    'message' => 'UserInfo Decode Failed',
                ]);
            }
        }catch (\Exception $e) {
            return response()->json([
                'code' => 5001,
                'message' => "{$e->getMessage()},sessionKey:{$session['session_key']},iv:{$iv},encryptedData:{$encryptedData}",
            ]);
        }

        //判断是否为新用户
        $insert['nickname'] = $data['nickName'];
        $insert['headimgurl'] = ! empty($data['avatarUrl']) ? $data['avatarUrl'] : '';
        $insert['openid'] = $data['openId'];

        $member = $this->memberRepository->updateOrCreate([
            'openid' => $insert['openid'],
        ], $insert);

        //返回token
        return response()->json([
            'code' => 200,
            'message' => '用户注册成功',
            'data' => [
                'token' => Auth::guard('api')->login($member),
            ]
        ]);
    }
}
