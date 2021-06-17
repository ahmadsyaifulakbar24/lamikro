<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class api extends Controller
{
    public function userPerTahun()
    {
        $total_user = DB::table('VW_TOTAL_USER_2019')->get();
        return response()->json(compact('total_user'));
    }
}
