<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
 	 #protected $table='articles'; 
	use SoftDeletes;
 	protected $fillable = [
 	 	'user_id','content','live','post_on','title'
 	 ];  

 	protected $guarded = ['id'];
 	protected $dates = ['poston','deleted_at','live'];
 	
 	public function setLiveAttribute($value)
 	{
 		$this->attributes['live'] = (boolean)($value);
 	}

 	public function getShortContentAttribute(){
 		return substr($this->content, 0, random_int(65, 100)). '...';
 	}
}
