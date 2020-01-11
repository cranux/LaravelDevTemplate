<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\MemberRepository;
use App\Models\Member;
use App\Validators\MemberValidator;

/**
 * Class MemberRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MemberRepositoryEloquent extends BaseRepository implements MemberRepository
{
    protected $fieldSearchable=[];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Member::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MemberValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
