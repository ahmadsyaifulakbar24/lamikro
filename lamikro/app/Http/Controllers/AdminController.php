<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Excel;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $userPerTahun = DB::table('VW_TOTAL_USER_2019')->get();
        return view('app/admin/total-pengguna', compact('userPerTahun'));
    }

    public function userExport()
    {
        $data_users = DB::table('vw_detail_user_lamikro_2019')->get();
        return view('app/exports/usersExport', compact('data_users'));
        // return Excel::download(new UsersExport, 'Detail Pengguna Lamikro.xlsx');
    }
}
