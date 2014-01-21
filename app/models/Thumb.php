<?php
class Thumb extends Eloquent
{
	public function tags()
	{
		return $this->hasMany('Tag');
	}
	public function users()
	{
		return $this->belongsTo('User');
	}
}