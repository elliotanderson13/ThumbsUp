<?php
class Company extends Eloquent
{
	public function users()
	{
		return $this->hasMany('User');
	}
}