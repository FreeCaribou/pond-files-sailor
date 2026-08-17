<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function home()
    {
        $folders = Folder::where('user_id', Auth::id())->whereNull('parent_id')->get();
        $files = File::where('user_id', Auth::id())->whereNull('folder_id')->get();

        return Inertia::render('dashboard', [
            'folders' => $folders,
            'files' => $files,
        ]);
    }
}
