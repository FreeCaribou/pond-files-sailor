<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FolderController extends Controller
{
    public function home(string $folderId)
    {
        $currentFolder = Folder::find($folderId);
        if (Auth::id() != $currentFolder->user_id) {
            return redirect()->route('error')->withErrors(['error.not-your-argument-topic']);
        }
        $folders = Folder::where('user_id', Auth::id())->where('parent_id', $folderId)->get();
        $files = File::where('user_id', Auth::id())->where('folder_id', $folderId)->get();

        return Inertia::render('folder-page', [
            'files' => $files,
            'currentFolder' => $currentFolder,
            'folders' => $folders,
            'currentFolderAncestors' => $currentFolder->ancestors(),
        ]);
    }
}