<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userOne = User::firstOrCreate(
            ['email' => 'pondfilessailor@freecaribou.net'],
            [
                'name' => 'Freecaribou',
                'password' => 'helloworld',
                'email_verified_at' => now(),
            ]
        );

        $userTwo = User::firstOrCreate(
            ['email' => 'samy@freecaribou.net'],
            [
                'name' => 'Samy Gnu',
                'password' => 'helloworld',
                'email_verified_at' => now(),
            ]
        );

        $folderOne = Folder::create(['label' => 'Main', 'description' => 'My main folder', 'user_id' => $userOne->id]);
        $folderTwo = Folder::create(['label' => 'Pictures', 'user_id' => $userOne->id]);
        $folderThree = Folder::create(['label' => 'Secret', 'description' => 'Some stuff ...', 'user_id' => $userOne->id]);
        $folderFour = Folder::create(['label' => 'Deer', 'description' => 'Info for deer', 'user_id' => $userTwo->id]);
        $folderFive = Folder::create(['label' => 'Videos', 'user_id' => $userOne->id]);
        $folderSix = Folder::create(['label' => 'Documents', 'user_id' => $userOne->id]);
        $folderSeven = Folder::create(['label' => 'Books', 'user_id' => $userOne->id]);
        $folderEight = Folder::create(['label' => 'Work !', 'user_id' => $userOne->id]);
        $folderNine = Folder::create(['label' => 'Nothing', 'user_id' => $userOne->id]);
        $folderTwoOne = Folder::create(['label' => 'Wallpaper', 'user_id' => $userOne->id, 'parent_id' => $folderTwo->id]);
        $folderTwoTwo = Folder::create(['label' => 'Suomi Holiday', 'user_id' => $userOne->id, 'parent_id' => $folderTwo->id]);
        $folderTwoTwoOne = Folder::create(['label' => 'Tampere', 'user_id' => $userOne->id, 'parent_id' => $folderTwoTwo->id]);
        $folderTwoTwoTwo = Folder::create(['label' => 'Oulu', 'user_id' => $userOne->id, 'parent_id' => $folderTwoTwo->id]);

        $fileOne = File::create([
            'name' => 'nice_resume.pdf',
            'mime_type' => 'application/pdf',
            'size' => 159753,
            'path' => 'FakeDocPathOne.pdf',
            'user_id' => $userOne->id,
            'type' => 'pdf',
        ]);
        $fileTwo = File::create([
            'name' => 'nice_resume_cv.pdf',
            'mime_type' => 'application/pdf',
            'size' => 159753,
            'path' => 'FakeDocPathTwo.pdf',
            'user_id' => $userOne->id,
            'type' => 'pdf',
        ]);
        $fileThree = File::create([
            'name' => 'nice_picture.jpg',
            'mime_type' => 'image/jpg',
            'size' => 159753,
            'path' => 'FakePicturePathThree.jpg',
            'user_id' => $userOne->id,
            'folder_id' => $folderTwo->id,
            'type' => 'jpg',
        ]);
        $fileFour = File::create([
            'name' => 'tamere.jpg',
            'mime_type' => 'image/jpg',
            'size' => 159753,
            'path' => 'FakePicturePathFour.jpg',
            'user_id' => $userOne->id,
            'folder_id' => $folderTwoTwoOne->id,
            'type' => 'jpg',
        ]);
        $fileFive = File::create([
            'name' => 'northest_tram.jpg',
            'mime_type' => 'image/jpg',
            'size' => 159753,
            'path' => 'FakePicturePathFive.jpg',
            'user_id' => $userOne->id,
            'folder_id' => $folderTwoTwoOne->id,
            'type' => 'jpg',
        ]);
    }
}
