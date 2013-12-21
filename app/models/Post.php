<?php
class Post extends Eloquent
{
	public $timestamps = false;
	public function users()
	{
		return $this->belongsTo('User');
	}
}