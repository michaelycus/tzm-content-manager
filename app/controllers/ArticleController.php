<?php

class ArticleController extends \BaseController {

	public function getAvailable()
	{
		$articles_available = Article::where('status', '=', ARTICLE_STATUS_AVAILABLE)->get();
		$articles_reviewed  = Article::where('status', '=', ARTICLE_STATUS_REVIEWED)->get();
		$articles_scheduled = Article::where('status', '=', ARTICLE_STATUS_SCHEDULED)->get();

		$users = User::all();

		return View::make('articles.available', array('articles_available' => $articles_available,
													  'articles_reviewed'  => $articles_reviewed,
													  'articles_scheduled' => $articles_scheduled,
													  'users' => $users));
	}

	public function getTeste()
	{
		Debugbar::warning("passou getTeste");

		return 'caramba';
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
            $article = new Article;
            $article->title 	      = Input::get('title');
            $article->link_wordpress  = Input::get('link_wordpress');
            $article->link_extra      = Input::get('link_extra');
            $article->status          = ARTICLE_STATUS_AVAILABLE;            
            $article->save();

            $articleAction = new ArticleAction;
            $articleAction->article_id  = $article->id;
            $articleAction->author_id   = Input::get('author_id');
            
            $articleAction->save();

            // redirect
            Session::flash('message', 'Artigo criado com sucesso!');
            return Redirect::route('articles-available');
        }
	}
}