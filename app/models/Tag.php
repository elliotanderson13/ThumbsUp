<?php
class Tag extends Eloquent
{
	public function thumbs()
	{
		return $this->belongsTo('Thumb');
	}
	public $timestamps = false;
}