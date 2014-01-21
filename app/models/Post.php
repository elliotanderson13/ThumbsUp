<?php
class Post extends Eloquent
{
	public function users()
	{
		return $this->belongsTo('User');
	}
}