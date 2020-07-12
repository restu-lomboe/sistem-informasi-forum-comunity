<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pertanyaan;
use App\user;

class DashboardController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::orderBy('created_at', 'DESC')->paginate(5);

        return view ('frontend.dashboard', compact('pertanyaan'));
    }
}
