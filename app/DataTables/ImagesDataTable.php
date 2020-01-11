<?php

namespace App\DataTables;

use App\Models\Image;
use Yajra\DataTables\Services\DataTable;

class ImagesDataTable extends DataTable
{
    /**
     * @param $query
     * @return \Yajra\DataTables\DataTableAbstract|\Yajra\DataTables\DataTables
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->escapeColumns([])
            ->addColumn('status', function ($model) {
                return $model->status_label;
            })
            ->addColumn('action', function ($model) {
                return $model->action_buttons;
            });
    }

    /**
     * @param Image $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Image $model)
    {
        return $model->newQuery()->select($this->getColumns());
    }

    /**
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
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
            'user_id',
            'sort',
            'status',
            'image',
            'created_at',
        ];
    }

    /**
     * @return array
     */
    protected function colums()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'searchable' => false, 'title' => 'ID'],
            ['data' => 'sort', 'searchable' => false, 'title' => '排序'],
            ['data' => 'image', 'searchable' => false, 'title' => '地址'],
            ['data' => 'status', 'searchable' => false, 'title' => '状态'],
            ['data' => 'created_at', 'searchable' => false, 'title' => '创建时间'],
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
        return '图片列表_'.time();
    }
}
