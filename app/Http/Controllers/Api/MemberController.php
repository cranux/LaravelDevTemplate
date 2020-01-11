<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Repositories\Interfaces\MemberRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\UserRepositoryEloquent;

/**
 * Class UserController.
 */
class MemberController extends Controller
{
    /**
     * @var MemberRepository
     */
    protected $repository;
    protected $userRepository;
    /**
     * MemberController constructor.
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository,UserRepository $userRepository)
    {
        $this->repository = $memberRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * 用户列表.
     *
     *   additional  添加额外参数
     *   return MemberResource::collection($users)
     *      ->additional([
     *      'code' => 1001,
     *      'message' => '用户获取成功',
     *   ]);
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        var_dump(auth()->user()->id);
//        $this->repository->setPresenter("Prettus\\Repository\\Presenter\\ModelFractalPresenter");
//        $members = $this->repository->paginate();
//        return response()->json([
//            'code' => 1001,
//            'data' =>$members
//        ],200);
    }

    public function getUserList()
    {
        $this->userRepository->setPresenter("Prettus\\Repository\\Presenter\\ModelFractalPresenter");
        $users = $this->userRepository->paginate();
        return response()->json([
            'code' => 1001,
            'data' =>$users
        ],200);
    }
}
