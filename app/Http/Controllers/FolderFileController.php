<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\File;
use Response;

class FolderFileController extends Controller
{
    public function getFoldersAndFiles()
    {
        // $data = Folder::with('children','files')->whereNull('parent_id')->get();
    	$data = Folder::whereNull('parent_id')->get();
    	return Response::json($data,200);
    }

    public function addFolderAndFile(Request $request)
    {
        // dd($request->isLeaf);
        // echo json_encode($request->isLeaf);die;
    	if($request->isLeaf === true)
    		$createRecord = File::create(['name'=> $request->get('name'),'folder_id' => $request->get('pid')]);
    	else	
    		$createRecord = Folder::create(['name'=> $request->get('name'),'parent_id' => $request->get('pid')]);
    	return Response::json($createRecord,201);
    }

    public function deleteFolderAndFile(Request $request,$id)
    {
        if($request->isLeaf)
        {
            $file = File::find($id);
            if(is_null($file)){
                return Response::json(['status' => 404,'message' => 'Not Found'],404);
            }
            else
            {
                $file->delete();
            }
        }
        else 
        {   
            $folder = Folder::find($id);
            if(is_null($folder)){
                return Response::json(['status' => 404,'message' => 'Not Found'],404);
            }
            else
            {
                $folder->delete();
            }
        }
        return Response::json(['status' => 200,'message' => 'Successfully Deleted'],200);
    }

    public function updateFolderAndFile(Request $request,$id)
    {
        if($request->isLeaf)
        {
            $file = File::find($id);
            if(is_null($file)){
                return Response::json(['status' => 404,'message' => 'Not Found'],404);
            }
            else
            {
                $file->update(['name' => $request->name]);
            }
        }
        else 
        {   
            $folder = Folder::find($id);
            if(is_null($folder)){
                return Response::json(['status' => 404,'message' => 'Not Found'],404);
            }
            else
            {
                $folder->update(['name' => $request->name]);
            }
        }
        return Response::json(['status' => 200,'message' => 'Successfully Updated'],200);
    }
}
