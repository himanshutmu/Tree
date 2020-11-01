<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Files;
use Response;

class FolderFileController extends Controller
{
    public function getFoldersAndFiles()
    {
    	$data = Folder::with('children','files')->whereNull('parent_id')->get();
    	return Response::json($data,200);
    }

    public function addFolderAndFile(Request $request)
    {
    	echo json_encode($request->all());die;
    	if($request->isLeaf)
    		$createRecord = File::create(['name'=> $request->get('name'),'folder_id' => $request->get('pid')]);
    	else	
    		$createRecord = Folder::create(['name'=> $request->get('name'),'parent_id' => $request->get('pid')]);
    	return Response::json($createRecord,201);
    }
}
