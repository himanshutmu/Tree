<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = ['name'];

    protected $hidden = ['created_at','updated_at'];

    public function files()
    {
    	return $this->hasMany('App\File');
    }

    public function children()
    {
    	return $this->hasMany('App\Folder','parent_id')->with(['children','files']);
    }
}
