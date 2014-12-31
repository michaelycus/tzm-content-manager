<?php

class ArticleController extends \BaseController {

	public function getAvailable()
	{
		// $articles_available = Article::where('status', '=', ARTICLE_STATUS_AVAILABLE)->get();
		// $articles_reviewed  = Article::where('status', '=', ARTICLE_STATUS_REVIEWED)->get();
  //       $articles_scheduled = Article::where('status', '=', ARTICLE_STATUS_SCHEDULED)->get();
		
        $articles = MEDIAS::where('status', '=', MEDIA_ARTICLE_AVAILABLE)->get();

        foreach ($articles as $article) {
            $article->num_comments = Comment::where('media_id', '=', $article->id)->count();
        }

		$users = User::all();

        return View::make('articles.available', array('articles' => $articles,
                                                      'users' => $users));

		// return View::make('articles.available', array('articles_available' => $articles_available,
		// 											  'articles_reviewed'  => $articles_reviewed,
		// 											  'articles_scheduled' => $articles_scheduled,
		// 											  'users' => $users));
	}

	public function postNew()
	{		
		$rules = array(
            'title'   		 => 'required',
            'link_wordpress' => 'required',
            'author_id'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
             return Redirect::route('articles-available');
        } else {
            // store
            $media = new Media;
            $media->user_id = Input::get('user_id');
            $media->status  = MEDIA_ARTICLE_AVAILABLE;

            $article = new Article;
            $article->title 	      = Input::get('title');
            $article->link_wordpress  = Input::get('link_wordpress');
            $article->link_extra      = Input::get('link_extra');            
            $article->save();            

            // redirect
            Session::flash('message', 'Artigo criado com sucesso!');
            return Redirect::route('articles-available');
        }
	}
}