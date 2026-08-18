<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class FolderController extends Controller
{
    public function home(string $folderId)
    {
        $currentFolder = Folder::find($folderId);
        if (Auth::id() != $currentFolder->user_id) {
            return redirect()->route('error')->withErrors(['error.not-your-folder']);
        }
        $folders = Folder::where('user_id', Auth::id())->where('parent_id', $folderId)->get();
        $files = File::where('user_id', Auth::id())->where('folder_id', $folderId)->get();

        return Inertia::render('folder-page', [
            'files' => $files,
            'folders' => $folders,
            'currentFolder' => $currentFolder,
            'currentFolderAncestors' => $currentFolder->ancestors(),
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
        ]);

        $newFolder = Folder::create([
            'label' => $request->label,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        Log::info('Creation of a folder '.$newFolder->id.' for user '.Auth::id());
    }

    public function addSubFolder(Request $request, string $folderId)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
        ]);

        $parentFolder = Folder::find($folderId);
        if (Auth::id() != $parentFolder->user_id) {
            return redirect()->route('error')->withErrors(['error.not-your-folder']);
        }

        $newFolder = Folder::create([
            'label' => $request->label,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'parent_id' => $folderId,
        ]);

        Log::info('Creation of a subfolder '.$newFolder->id.' for folder '.$folderId.' for user '.Auth::id());
    }
}
