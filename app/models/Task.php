<?php

class Task extends Eloquent{
	
	protected $fillable = array('media_id', 'user_id', 'type');


	public function user()
    {
        return $this->belongsTo('User');
    }

    public function video()
    {
    	return $this->belongsTo('Video', 'media_id');
    }
}
