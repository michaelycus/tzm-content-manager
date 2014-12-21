<?php

class Comment extends Eloquent {        
	protected $fillable = array('message', 'video_id', 'user_id', 'reply_to'); 

	public function user()
    {
        return $this->belongsTo('User');
    }

    public function video()
    {
        return $this->belongsTo('Video');
    }
}