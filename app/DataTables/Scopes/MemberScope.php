<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class MemberScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $member_id = request('member_id');
        $inviter_id = request('inviter_id');

        if ($member_id) {
            return $query->where('id', $member_id);
        }
        if ($inviter_id) {
            return $query->where('inviter_id', $inviter_id);
        }
    }
}
