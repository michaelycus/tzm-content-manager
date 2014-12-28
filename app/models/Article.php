<?php

class Article extends Eloquent{
    
    protected $fillable = array('title', 'link_wordpress', 'link_extra', 'status');


    public function action()
    {
        return $this->hasOne('ArticleAction');
    }
}
