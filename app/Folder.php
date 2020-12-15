<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = ['name','parent_id'];

    protected $hidden = ['created_at','updated_at','files','folders'];

    protected $appends = ['children'];

    public function files()
    {
    	return $this->hasMany('App\File');
    }
    
    public function folder()
    {
        return $this->hasMany('App\Folder','parent_id')->with(['folder','files']);
    }

    public function getChildrenAttribute()
    {
        $files = $this->files;
        $folders = $this->folder;

        return $folders->merge($files);
    	return $this->hasMany('App\Folder','parent_id')->with(['children','files']);
    }
}
