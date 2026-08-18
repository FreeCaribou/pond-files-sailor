<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'description' => 'nullable|string|max:2000',
        ]);

        $uploadedFile = $request->file('file');
        if ($uploadedFile) {
            $path = $uploadedFile->store('useruploadfile');

            Log::info('the extension of file '.$uploadedFile->extension());

            $newFile = File::create([
                'name' => $uploadedFile->getClientOriginalName(),
                'mime_type' => $uploadedFile->getClientMimeType(),
                'type' => $uploadedFile->extension(),
                'size' => $uploadedFile->getSize(),
                'path' => $path,
                'description' => $request->description,
                'user_id' => Auth::id(),
            ]);
            Log::info('Creation of a file '.$newFile->id.' named by the system '.$newFile->path.' for user '.Auth::id());
        }
    }

    public function addInFolder(Request $request, string $folderId)
    {
        $request->validate([
            'file' => 'required|file',
            'description' => 'nullable|string|max:2000',
        ]);

        $parentFolder = Folder::find($folderId);
        if (Auth::id() != $parentFolder->user_id) {
            return redirect()->route('error')->withErrors(['error.not-your-folder']);
        }

        $uploadedFile = $request->file('file');
        if ($uploadedFile) {
            $path = $uploadedFile->store('useruploadfile');

            $newFile = File::create([
                'name' => $uploadedFile->getClientOriginalName(),
                'mime_type' => $uploadedFile->getClientMimeType(),
                'type' => $uploadedFile->extension(),
                'size' => $uploadedFile->getSize(),
                'path' => $path,
                'description' => $request->description,
                'user_id' => Auth::id(),
                'folder_id' => $parentFolder->id,
            ]);
            Log::info('Creation of a file '.$newFile->id.' named by the system '.$newFile->path.' added to the folder '.$parentFolder->id.'for user '.Auth::id());
        }
    }
}
