<?php

class Media extends Eloquent{
    
    protected $fillable = array('user_id', 'status', 'schedule');

    public function article()
    {
        return $this->hasOne('Article');
    }

    public function video()
    {
        return $this->hasOne('Video');
    }

    public function user()
    {
         return $this->belongsTo('User');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function tasks()
    {
        return $this->hasMany('Task');
    }    
}
