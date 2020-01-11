<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\User\UserCreateRequest;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use App\Validators\UserValidator;
use function flash;
use App\Models\User;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use Prettus\Validator\Contracts\ValidatorInterface;


class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;
    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param UserValidator $userValidator
     */
    public function __construct(UserRepository $userRepository, UserValidator $userValidator)
    {
        $this->repository = $userRepository;
        $this->validator = $userValidator;
    }

    /**
     * @param UserDataTable $dataTable
     * @return mixed
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.user.index');
    }

//    public function userColumnData()
//    {
//        $users = User::query()->select(['id', 'name', 'email', 'created_at', 'updated_at']);
//        $data = DataTables::of($users)
//            ->addColumn('role', function ($model) {
//                return $model->role_name;
//            })
//            ->addColumn('action', function ($model) {
//                return $model->action_buttons;
//            })
//            ->make(true);
//        return $data;
//    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)
    {
        $data = [
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ];
        $this->validator->with(request()->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
        $user = $this->repository->create($data);

        //用户创建失败
        if (! $user) {
            flash('用户创建失败')->error()->overlay();

            return;
        }
        //如果为管理员
        if (request('is_administrator') == 1) {
            $user->assignRole('administrator');
        }

        flash('用户创建成功')->success()->overlay();

        return redirect()->route('admin.user.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.user.show')
            ->with('user', $user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.user.edit')
            ->with('user', $user);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $password = request('password');
        //设置了新密码
        if ($password) {
            $this->repository->update([
                'password' => bcrypt($password),
            ], $user->id);
        }
        //如果设置用户为管理员
        if (request('is_administrator') == 1 && ! $user->hasRole('administrator')) {
            $user->assignRole('administrator');
        }
        //非管理员
        if (request('is_administrator') != 1) {
            $user->removeRole('administrator');
        }
        flash('用户信息修改成功')->success()->overlay();

        return redirect()->back();
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $this->repository->delete($user->id);

        flash('用户删除成功')->success()->overlay();

        return redirect()->back();
    }
}
