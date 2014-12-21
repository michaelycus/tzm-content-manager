<?php

class Article extends Eloquent{
    
     protected $fillable = array('title', 'link_wordpress', 'link_extra', 'owner_id', 
                                 'reviewer1_id', 'reviewer1_approval', 
                                 'reviewer2_id', 'reviewer2_approval', 'status');



    // public function user()
    // {
    //     return $this->belongsTo('User');
    // }

    // public function video()
    // {
    //     return $this->belongsTo('Video');
    // }
}
