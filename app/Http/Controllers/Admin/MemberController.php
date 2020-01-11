<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Member\MemberUpdateRequest;
use App\Models\Member;
use App\DataTables\MemberDataTable;
use App\Http\Controllers\Controller;
use App\DataTables\Scopes\MemberScope;
use App\Repositories\Interfaces\MemberRepository;
use App\Validators\MemberValidator;

class MemberController extends Controller
{
    /**
     * @var MemberRepository
     */
    protected $repository;
    /**
     * @var MemberValidator
     */
    protected $validator;

    /**
     * MemberController constructor.
     * @param MemberRepository $memberRepository
     * @param MemberValidator $validator
     */
    public function __construct(MemberRepository $memberRepository, MemberValidator $validator)
    {
        $this->repository = $memberRepository;
        $this->validator = $validator;
    }

    /**
     * @param MemberDataTable $dataTable
     * @return mixed
     */
    public function index(MemberDataTable $dataTable)
    {

        if (request('member_id') || request('inviter_id')) {
            return $dataTable
                ->addScope(new MemberScope())
                ->render('admin.member.index');
        }

        return $dataTable->render('admin.member.index');
    }

    /**
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Member $member)
    {
        return view('admin.member.show')
            ->with('member', $member);
    }

    /**
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Member $member)
    {
        return view('admin.member.edit')
            ->with('member', $member);
    }

    /**
     * @param MemberUpdateRequest $request
     * @param Member $member
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MemberUpdateRequest $request, Member $member)
    {
        $data = [
            'nickname' => request('nickname'),
        ];

        $this->repository->update($data, $member->id);

        flash('会员信息修改成功')->success()->important();

        return redirect()->back();
    }

    /**
     * @param Member $member
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Member $member)
    {
        $this->repository->delete($member->id);

        flash('会员删除成功')->success()->important();

        return redirect()->back();
    }
}
