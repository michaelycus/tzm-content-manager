<?php

class ArticleAction extends Eloquent{
    
     protected $fillable = array('author_id', 'reviewer1_id', 'reviewer1_approval', 
                                 'reviewer2_id', 'reviewer2_approval');

    public function user()
    {
        return $this->belongsTo('User', 'author_id');
    }

    // public function article()
    // {
    //     return $this->belongsTo('Article');
    // }
}