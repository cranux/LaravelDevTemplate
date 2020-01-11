@extends('adminlte::page')

@section('title', '管理后台')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">用户管理</h3>
                    <div class="card-tools pull-right">
                        <div class="pull-right mb-10 hidden-sm hidden-xs">
                            {{ link_to_route('admin.user.index', "所有用户", [], ['class' => 'btn btn-primary btn-xs']) }}
                            {{ link_to_route('admin.user.create', "创建用户", [], ['class' => 'btn btn-success btn-xs']) }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! $dataTable->table() !!}
        {{--            <table class="table" id="users-table">--}}
        {{--                <thead></thead>--}}
        {{--            </table>--}}
                </div>
            </div>
        </div>

    </div>
@stop

@push('js')
{!! $dataTable->scripts() !!}
{{--<script>--}}
{{--    $('#users-table').DataTable({--}}
{{--        processing: true,--}}
{{--        serverSide: true,--}}
{{--        ajax: "{{url('admin/userData')}}",--}}
{{--        columns: [--}}
{{--            {data: 'id', name: 'id',title: 'ID',searchable: false,},--}}
{{--            {data: 'name', name: 'name', title: '用户名'},--}}
{{--            {data: 'email', name: 'email', title: '邮箱',searchable: false,},--}}
{{--            {--}}
{{--                data: 'role', name: 'role', orderable: false, searchable: false, title: '角色',--}}
{{--                render:function (data, type, full, meta) {--}}
{{--                    if (data == ''){--}}
{{--                        return data="<label class='label label-info'>无</label>";--}}
{{--                    }--}}
{{--                    return "<label class='label label-success'>"+data+"</label>";--}}

{{--                }--}}
{{--            },--}}
{{--            {data: 'created_at', name: 'created_at', title: '创建时间',searchable: false,},--}}
{{--            {data: 'updated_at', name: 'updated_at', title: '更新时间',searchable: false,},--}}
{{--            {data: 'action', name: 'action', orderable: false, searchable: false, width: '80px', title: '操作'}--}}
{{--        ],--}}
{{--        order:[--}}
{{--            [0, 'desc'],--}}
{{--        ],--}}
{{--        language: {--}}
{{--            'url': "{{url('Chinese.json')}}",--}}
{{--        },--}}
{{--        // searching:true,--}}
{{--    });--}}
{{--</script>--}}
@endpush
