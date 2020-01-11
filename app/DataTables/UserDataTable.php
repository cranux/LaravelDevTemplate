<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('role', function ($model) {
                return $model->role_name;
            })
            ->addColumn('action', function ($model) {
                return $model->action_buttons;
            })
           ;
    }

    /**
     * Get query source of dataTable.
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
        return $this->builder()
                    ->columns($this->colums())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px', 'title'=>'操作'])
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
            'name',
            'email',
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
            ['data' => 'name', 'name' => 'name', 'orderable' => false, 'title' => '用户名'],
            ['data' => 'email', 'name' => 'email', 'orderable' => false, 'title' => '邮箱'],
            ['data' => 'role', 'name' => 'role', 'orderable' => false, 'searchable' => false, 'title' => '角色'],
            ['data' => 'created_at', 'name' => 'created_at', 'searchable' => false, 'title' => '创建时间'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'searchable' => false, 'title' => '更新时间'],
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
        return '用户列表_'.time();
    }
}
