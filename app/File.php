<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $fillable = ['folder_id','name'];

    protected $hidden = ['created_at','updated_at'];

    protected $appends = ['is_leaf'];

	public function folder()
	{
		return $this->belongsTo('App\Folder');
	}

	public function getIsLeafAttribute()
	{
		return true;
	}
}
