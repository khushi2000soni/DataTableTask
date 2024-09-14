<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()                    
            ->editColumn('email',function($row){
                return $row->email  ?? "";
            })
            ->editColumn('username',function($row){
                return $row->username  ?? "";
            })
            ->editColumn('status',function($row){
                return $row->status  ?? "";
            })
            ->editColumn('type',function($row){
                return $row->type  ?? "";
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->addColumn('action',function($row){
                $action='';
                return $action;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(users.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action']);
    }
    

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $query = $model->newQuery();

        if(isset(request()->email) && request()->email){            
            $query = $query->searchByEmail(request()->email);
        }

        if(isset(request()->username) && request()->username){
            $query = $query->searchByUsername(request()->username);           
        }

        if(isset(request()->status) && request()->status){
            $query = $query->where('status', request()->status);
        }

        if(isset(request()->type) && request()->type){
            $query = $query->where('type', request()->type);
        }

        if(isset(request()->created_at) && request()->created_at){
           $query = $query->searchByCreatedAt(request()->created_at);
        }

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->parameters([
                'responsive' => false,
                'pageLength' => 15,
                'searching' => true,
                'lengthChange' => false,
                'scrollX' => true,
                'scrollY' => '780px',
                'scrollCollapse' => true,
                'paging' => false,
                'ajax' => [
                    'url' => route('user.index'),
                    'type' => 'POST',
                    'data' => function ($params) {
                        $params['start'] = $params['start'];
                        $params['length'] = 15;
                        return $params;
                    },
                ],                                    
                'initComplete' => "function() { 
                    var api = this.api();                                    
                    var searchRow = $('<tr></tr>').appendTo('.dataTable thead');                    
                    api.columns().every(function (index) {
                        var column = this;
                        var header = $('.dataTable thead tr.headingRow th').eq(index);
                        var searchInput;
                        switch (index) {
                            case 0:
                                searchInput = '';
                                break;
                            case 1:
                                searchInput = $('<input type=\"text\" id=\"email\" placeholder=\"Search\" />');                                    
                                break;
                            case 2:
                                searchInput = $('<input type=\"text\" id=\"username\" placeholder=\"Search\" />');                                    
                                break;
                            case 3:
                                searchInput = $('<select id=\"status\"><option value=\"\">Select status</option><option value=\"active\">Active</option><option value=\"inactive\">Inactive</option></select>');                                    
                                break;
                            case 4:
                                searchInput = $('<select id=\"type\"><option value=\"\">Select type</option><option value=\"admin\">Admin</option><option value=\"user\">User</option><option value=\"merchant\">Merchant</option></select>');                                    
                                break;
                            case 5:
                                searchInput = $('<input type=\"text\" id=\"created_at\" placeholder=\"YYYY-mm-dd\" />');                                    
                                break;
                            case 6:
                                searchInput = $('<button type=\"button\" class=\"btn btn-primary custom-filter-submit\">Submit</button><button type=\"button\" class=\"btn btn-secondary custom-filter-reset \">Reset</button>');                                                           
                                break;
                        }
                        $(searchInput).appendTo(searchRow.append('<th></th>').find('th').eq(index));
                    });
                }",
            ])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt')
            ->orderBy(2,'asc')
            ->selectStyleSingle();
    }
     


    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title(trans('quickadmin.qa_sn'))->orderable(false)->searchable(false),
            Column::make('email')->title(trans('quickadmin.users.fields.email')),
            Column::make('username')->title(trans('quickadmin.users.fields.username')),
            Column::make('status')->title(trans('quickadmin.users.fields.status')),
            Column::make('type')->title(trans('quickadmin.users.fields.type')),
            Column::make('created_at')->title(trans('quickadmin.users.fields.created_at')),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center')->title(trans('quickadmin.qa_action')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
