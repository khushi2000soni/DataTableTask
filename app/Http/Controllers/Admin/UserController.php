<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {             
        return $dataTable->render('admin.users.index');
    }
}
