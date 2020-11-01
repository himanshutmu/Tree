<?php

use Illuminate\Database\Seeder;
use App\Folder;
use App\File;

class FoldersAndFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Folder::insert([
        	[
        		'name' => 'Folder1',
        		'parent_id' => null
        	],
        	[
        		'name' => 'Folder2',
        		'parent_id' => 1	
        	],
        	[
        		'name' => 'Folder3',
        		'parent_id' => 2
        	],
        	[
        		'name' => 'Folder4',
        		'parent_id' => 3
        	],
        	[
        		'name' => 'Folder5',
        		'parent_id' => 4
        	],
        	[
        		'name' => 'Folder6',
        		'parent_id' => 1
        	],
        	[
        		'name' => 'Folder7',
        		'parent_id' => 2
        	],
        	[
        		'name' => 'Folder8',
        		'parent_id' => 3
        	],
        	[
        		'name' => 'Folder9',
        		'parent_id' => 4
        	],
        	[
        		'name' => 'Folder10',
        		'parent_id' => 5
        	],
        ]);

        File::insert([
        	['folder_id' => 1,'name'=> 'File1'],
        	['folder_id' => 2,'name'=> 'File2'],
        	['folder_id' => 3,'name'=> 'File3'],
        	['folder_id' => 4,'name'=> 'File4'],
        	['folder_id' => 5,'name'=> 'File5'],
        	['folder_id' => 6,'name'=> 'File6'],
        	['folder_id' => 7,'name'=> 'File7'],
        	['folder_id' => 8,'name'=> 'File8'],
        	['folder_id' => 9,'name'=> 'File9'],
        	['folder_id' => 10,'name'=> 'File10'],
        	['folder_id' => 1,'name'=> 'File11'],
        	['folder_id' => 1,'name'=> 'File12'],
        	['folder_id' => 2,'name'=> 'File13'],
        ]);
    }
}
