<?php

class ArticleController extends \BaseController {

	public function getAvailable()
	{
		$articles = Article::where('status', '!=', ARTICLE_STATUS_PUBLISHED);

		return View::make('articles.available', array('articles' => $articles));
	}
}