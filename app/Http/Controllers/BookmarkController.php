<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $history_data = History::getBookmark($user);
            $data = array(
                'history_data' => $history_data
            );
            return view('content.bookmark')->with($data);
        } else {
            return redirect()->back();
        }
    }
}
