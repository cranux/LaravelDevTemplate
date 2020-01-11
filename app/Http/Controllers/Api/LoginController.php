<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\MemberRepository;
use App\Validators\MemberValidator;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @var MemberRepository
     */
    protected $repository;
    /**
     * @var
     */
    protected $validator;

    /**
     * LoginController constructor.
     * @param MemberRepository $memberRepository
     * @param MemberValidator $validator
     */
    public function __construct(MemberRepository $memberRepository,MemberValidator $validator)
    {
        $this->repository = $memberRepository;
        $this->validator = $validator;
    }

    /**
     * jwt-auth 登录演示
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function index()
    {
        $this->validator->with(request()->all())->passesOrFail();
        $member = $this->repository->find(2);
        $token = auth()->guard('api')->login($member);

        return response()->json([
            'code' => 1001,
            'message' => 'Login Success',
            'token' => $token,
        ]);
    }
}
