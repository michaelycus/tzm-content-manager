<?php

Route::get('/', array('as' => 'home', 'uses' => 'AccountController@getIndex'));

/*
| Authenticated group
*/
Route::group(array('before' => 'auth'), function(){

	/*
	| CSRF protection group
	*/
	Route::group(array('before' => 'csrf'), function(){
		/*
		| Change password (POST)
		*/
		Route::post('/account/change-password', array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		));
	});

	/*
	| Change password (GET)
	*/
	Route::get('/account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));

	/*
	| Sign out (GET)
	*/
	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));

	// --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- 

	/*
	| VIDEOS 
	*/

	Route::get('/videos', array(
	 	'as' => 'videos-available',
	 	'uses' => 'VideoController@getAvailable'
	));

	Route::get('/videos', array(
	 	'as' => 'videos-published',
	 	'uses' => 'VideoController@getPublished'
	));
															//
	Route::get('/videos/tasks/{media_id}/{status}', array( 	// AJAX CALLS
		'as' => 'videos-tasks',								//		
		'uses' => 'VideoController@getTasks'
	));

	// --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- 

	/*
	| ARTICLES
	*/	
	Route::get('/articles', array(
	 	'as' => 'articles-available',
	 	'uses' => 'ArticleController@getAvailable'
	));

	Route::get('/articles', array(
	 	'as' => 'articles-available',
	 	'uses' => 'ArticleController@getPublished'
	));

	Route::post('/articles/create', array(
		'as' => 'articles-create',
		'uses' => 'ArticleController@postCreate'
	));
															//
	Route::get('/articles/tasks/{media_id}', array(			// AJAX CALLS
		'as' => 'articles-tasks',							//
		'uses' => 'ArticleController@getTasks'
	));

	// --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- 

	/*
	| COMMENTS
	*/
	Route::group(array('prefix' => 'api'), function() {
		Route::get('/comments/{media_id}', array(
			'as' => 'get-comments',
			'uses' => 'CommentController@index'
		));

		Route::post('/comments/', array(
			'as' => 'store-comment',
			'uses' => 'CommentController@store'
		));
	});

	// --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- 

	/*
	| USERS
	*/
	Route::get('/users/{id}', array(
		'as' => 'users-profile',
		'uses' => 'UserController@getUser'
	));

	Route::get('/users/manage', array(
		'as' => 'users-manage',
		'uses' => 'UserController@getUsers'
	));

	/*
	| ABOUT
	*/
	Route::get('about', array(
		'as' => 'about',
		'uses' => 'AccountController@about'
	));

	// --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- 

	/*
	| TEST
	*/
	Route::get('/teste/teste', array(
		'as' => 'teste-teste',
		'uses' => 'TestController@getTeste'
	));

	Route::get('/teste/amara', array(
		'as' => 'teste-amara',
		'uses' => 'TestController@getAmara'
	));

});

/*
| Unauthenticated group
*/
Route::group(array('before' => 'guest'), function(){
	/*
	| CSRF protection group
	*/	
	Route::group(array('before' => 'csrf'), function(){		
		/*
		| Create account (POST)
		*/	
		Route::post('/account/sign-up', array(
			'as' => 'account-sign-up-post',
			'uses' => 'AccountController@postSignUp'
		));	

		/*
		| Sign in (POST)
		*/	
		Route::post('/account/sign-in', array(
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));
	});

	/*
	| Sign in (GET)
	*/	
	Route::get('/account/sign-in', array(
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	));	

	/*
	| Create account (GET)
	*/	
	Route::get('/account/sign-up', array(
		'as' => 'account-sign-up',
		'uses' => 'AccountController@getSignUp'		
	));	

	Route::get('/account/activate/{code}', array(
		'as' => 'account-activate',
		'uses' => 'AccountController@getActivate'
	));


	/*
	| Login Facebook (GET)
	*/
	Route::get('login/facebook', array(
		'as' => 'login-facebook',
		'uses' => 'AccountController@getLoginWithFacebook'
	));

	/*
	| Login Google (GET)
	*/
	Route::get('login/google', array(
		'as' => 'login-google',
		'uses' => 'AccountController@getLoginWithGoogle'
	));

});

Route::get('testes', function()
{
    return 'testes!';
});





	// Route::get('/videos/translating', array(
	// 	'as' => 'videos-translating',
	// 	'uses' => 'VideoController@getTranslating'
	// ));

	// Route::get('/videos/synchronizing', array(
	// 	'as' => 'videos-synchronizing',
	// 	'uses' => 'VideoController@getSynchronizing'
	// ));

	// Route::get('/videos/proofreading', array(
	// 	'as' => 'videos-proofreading',
	// 	'uses' => 'VideoController@getProofreading'
	// ));

	// Route::get('/videos/finished', array(
	// 	'as' => 'videos-finished',
	// 	'uses' => 'VideoController@getFinished'
	// ));

	/*
	| VIDEOS - Details
	*/

	// Route::get('/videos/details/{id}', array(
	// 	'as' => 'videos-details',
	// 	'uses' => 'VideoController@getDetails'
	// ));

    /*
	| VIDEOS - Ajax calls
	*/

	// Route::get('/videos/tasks/{media_id}/{status}', array(
	// 	'as' => 'videos-tasks',
	// 	'uses' => 'VideoController@getTasks'
	// ));

	// Route::get('/videos/detail-tasks/{media_id}/{status}', array(
	// 	'as' => 'videos-detail-tasks',
	// 	'uses' => 'VideoController@getDetailTasks'
	// ));

	// Route::get('/videos/help/{id}/{status}', array(
	// 	'as' => 'videos-help',
	// 	'uses' => 'VideoController@getHelp'
	// ));

	// Route::get('/videos/stophelp/{id}/{status}', array(
	// 	'as' => 'videos-stop-help',
	// 	'uses' => 'VideoController@getStopHelp'
	// ));

	// Route::get('/videos/remove/{id}', array(
	// 	'as' => 'videos-remove',
	// 	'uses' => 'VideoController@getRemove'
	// ));

	// Route::get('/videos/move-to/{id}/{status}', array(
	// 	'as' => 'videos-move-to',
	// 	'uses' => 'VideoController@getMoveTo'
	// ));

	// Route::get('/videos/return-to/{id}/{status}', array(
	// 	'as' => 'videos-return-to',
	// 	'uses' => 'VideoController@getReturnTo'
	// ));

	//  Route::post('/videos/suggestion', array(
	//  	'as' => 'videos-suggestion',
	//  	'uses' => 'VideoController@postSuggestion'
	//  ));


	

	
	// Route::controller("articles", "ArticleController", array(
	// 	'getAvailable'  => 'articles-available',
	// 	'postNew' 		=> 'articles-new',		
	// ));

	/*
	| ARTICLES - Ajax calls
	*/

	// Route::get('/articles/tasks/{media_id}', array(
	// 	'as' => 'articles-tasks',
	// 	'uses' => 'ArticleController@getTasks'
	// ));

	// Route::get('/articles/adjust/{media_id}', array(
	// 	'as' => 'articles-adjust',
	// 	'uses' => 'ArticleController@getAdjust'
	// ));

	// Route::get('/articles/approved/{media_id}', array(
	// 	'as' => 'articles-approved',
	// 	'uses' => 'ArticleController@getApproved'
	// ));



	// Route::get('/articles', array(
	// 	'as' => 'articles-available',
	// 	'uses' => 'ArticleController@getAvailable'
	// ));

	// Route::post('/articles/new', array(
	// 	'as' => 'articles-new',
	// 	'uses' => 'ArticleController@postNew'
	// ));

	// Route::get('/articles/teste', array(
	// 	'as' => 'articles-teste',
	// 	'uses' => 'ArticleController@getTeste'
	// ));


