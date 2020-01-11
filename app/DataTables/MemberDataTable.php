<?php

namespace App\DataTables;

use App\Models\Member;
use Yajra\DataTables\Services\DataTable;

class MemberDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->escapeColumns([])
            ->addColumn('memberAvatar', function ($model) {
                return $model->member_avatar;
            })
            ->addColumn('inviterAvatar', function ($model) {
                return $model->inviter_avatar;
            })
            ->addColumn('sex', function ($model) {
                return $model->sex_label;
            })
            ->addColumn('action', function ($model) {
                return $model->action_buttons;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Member $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Member $model)
    {
        return $model->newQuery()->select($this->getColumns());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this
            ->builder()
            ->columns($this->colums())
            ->minifiedAjax()
            ->addAction(['width' => '80px', 'title' => '操作'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'inviter_id',
            'nickname',
            'sex',
            'credit1',
            'credit2',
            'head_img_url',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    protected function colums()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'searchable' => false, 'title' => 'ID'],
            ['data' => 'memberAvatar', 'name' => 'nickname', 'orderable' => false, 'title' => '昵称'],
            ['data' => 'inviterAvatar', 'searchable' => false, 'orderable' => false, 'title' => '邀请人'],
            ['data' => 'sex', 'searchable' => false, 'orderable' => false, 'title' => '性别'],
            ['data' => 'credit1', 'searchable' => false, 'orderable' => false, 'title' => '积分'],
            ['data' => 'credit2', 'searchable' => false, 'orderable' => false, 'title' => '余额'],
            ['data' => 'created_at', 'searchable' => false, 'title' => '注册时间'],
        ];
    }

    /**
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'order' => [[0, 'desc']],
            'language' => [
                'url' => url('Chinese.json'),
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return '会员列表_'.time();
    }
}
