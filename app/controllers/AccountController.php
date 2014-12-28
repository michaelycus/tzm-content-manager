<?php

class AccountController extends BaseController{

	public function getIndex()
	{
		if (Auth::check())
		{
			$data = array(
			    'count_videos_trans'   => Video::where('status', '=', VIDEO_STATUS_TRANSLATING)->count(),
			    'count_videos_synch'   => Video::where('status', '=', VIDEO_STATUS_SYNCHRONIZING)->count(),
			    'count_videos_proof'   => Video::where('status', '=', VIDEO_STATUS_PROOFREADING)->count(),
			    'count_videos_finish'  => Video::where('status', '=', VIDEO_STATUS_FINISHED)->count(),

			    'count_users'		   => User::where('auth', '!=', USER_NOT_AUTHORIZED)->count(),
			    'count_user_trans'     => Auth::user()->translated_videos(),
			    'count_user_synch'     => Auth::user()->synchronized_videos(),
			    'count_user_proof'     => Auth::user()->proofreaded_videos(),
			    'count_user_worked'    => Auth::user()->worked_in_videos(),
			    'count_user_score'     => Auth::user()->score_total(),

			    'last_videos'		   => Video::where('status', '>', VIDEO_FOR_APPROVAL)->orderBy('id', 'desc')->take(10)->get(),
			    'last_tasks'		   => Task::where('type', '>', TASK_SUGGESTED_VIDEO)->orderBy('id', 'desc')->take(10)->get(),			    
			);

			return View::make('dashboard')->with($data);
		}
		else
		{
			return View::make('sign.signin');
		}
	}

	public function getSignIn()
	{
		return View::make('sign.signin');
	}

	public function postSignIn()
	{
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|email',
				'password' => 'required'
			)
		);

		if ($validator->fails()){
			return Redirect::route('account-sign-in')
				->withErrors($validator)
				->withInput();
		} else{

			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),				
			), $remember);

			if ($auth){
				// Redirect to the intended page
				return Redirect::intended('/');
			} else{
				return Redirect::route('account-sign-in')
						->with('global', 'Email/password wrong, or account not activated.');
			}
		}

		return Redirect::route('account-sign-in')
				->with('global', 'There was a problem signing you in.');
	}

	public function getSignUp()
	{
		return View::make('sign.signup');
	}

	public function postSignUp()
	{
		$validator = Validator::make(Input::all(), 
			array(
				'email' 		 => 'required|max:50|email|unique:users',
				'firstname'		 => 'required|max:20|min:1',
				'lastname' 		 => 'required|max:20|min:1',
				'password' 		 => 'required|min:6',
				'password_again' => 'required|same:password'
			)
		);

		if ($validator->fails()) {
			return Redirect::route('account-sign-up')
					->withErrors($validator)
					->withInput();
		} else {
			$email     = Input::get('email');
			$firstname = Input::get('firstname');
			$lastname  = Input::get('lastname');
			$password  = Input::get('password');

			// Activation code
			$code = str_random(60);

			$user = User::create(array(
				'email'		=> $email,
				'firstname' => $firstname,
				'lastname'	=> $lastname,
				'password' 	=> Hash::make($password),
				'code' 		=> $code,
				'auth' 		=> USER_NOT_AUTHORIZED,
				'score'		=> '0,0,0,0,0,0,0'
			));

			if ($user){
				Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code) , 'firstname' => $firstname), function($message) use ($user){
 					$message->to($user->email, $user->firstname)->subject('Activate your account');
				});

				return Redirect::route('home')
						->with('account-created', 'Your account has been created! We have sent you an email to active your account.');
			}
		}
	}

	public function getSignOut()
	{
		Auth::logout();

		return Redirect::route('home');
	}

	public function getActivate($code){
		$user = User::where('code', '=', $code)->where('auth', '=', USER_NOT_AUTHORIZED);

		if ($user->count()){
			$user = $user->first();

			// Update user to active state	
			$user->auth = USER_AUTH_OPERATOR;
			$user->code = '';

			if ($user->save()){
				return Redirect::route('home')
						->with('account-actived', '<strong>Activated!</strong> You can now sign in!');
			}
		}

		return Redirect('home')
				->with('global', 'We could not activate your account. Try again later.');
	}

	public function getChangePassword()
	{
		return View::make('account.password');
	}

	public function postChangePassword()
	{
		$validator = Validator::make(Input::all(),
			array(
				'old_password' 	 => 'required',
				'password' 		 => 'required|min:6',
				'password_again' => 'required|same:password'
			)
		);

		if ($validator->fails()){
			return Redirect::route('account-change-password')
					->withErrors($validator);
		} else {
			$user = User::find(Auth::user()->id);

			$old_password = Input::get('old_password');
			$password 	  = Input::get('password');

			if (Hash::check($old_password, $user->getAuthPassword())){
				$user->password = Hash::make($password);

				if ($user->save()){
					return Redirect::route('home')
							->with('global', 'Your password has been changed.');
				}
			} else {
				return Redirect::route('account-change-password')
						->with('global', 'Your old password is incorrect.');
			}
		}

		return Redirect::route('account-change-password')
				->with('global', 'Your password could not be changed.');
	}

	public function about()
	{
//		return View::make('about');
	}


	public function getLoginWithFacebook() 
	{
	    // get data from input
	    $code = Input::get( 'code' );

	    // get fb service
	    $fb = OAuth::consumer( 'Facebook' );

	    // check if code is valid

	    // if code is provided get user data and sign in
	    if ( !empty( $code ) ) {

	        // This was a callback request from facebook, get the token
	        $token = $fb->requestAccessToken( $code );

	        // Send a request with it
	        $me = json_decode( $fb->request( '/me' ), true );

	        $profile = Profile::whereUid($me['id'])->first();

	        if (empty($profile)) 
		    {
		    	$user = User::where('email', '=', $me['email']);

		    	if ($user->count())
		    	{
		    		$user = $user->first();

		    		$user->firstname = $me['first_name'];
			        $user->lastname  = $me['last_name'];
			        $user->photo     = 'https://graph.facebook.com/'.$me['id'].'/picture?type=large';
		    	}
		    	else
		    	{
		    		$user = new User;
			        $user->firstname = $me['first_name'];
			        $user->lastname  = $me['last_name'];	        
			        $user->email     = $me['email'];
			        $user->photo     = 'https://graph.facebook.com/'.$me['id'].'/picture?type=large';
			        $user->score	 = '0,0,0,0,0,0,0';
		    	}

		        $user->save();

		        $profile = new Profile();
		        $profile->uid = $me['id'];
		        $profile->username = $me['id'];
		        $profile = $user->profiles()->save($profile);
		    }

		    $profile->save();

		    $user = $profile->user;

		    Auth::login($user);

		    return Redirect::to('/')->with('message', 'Logged in with Facebook');
	    }
	    // if not ask for permission first
	    else {
	        // get fb authorization
	        $url = $fb->getAuthorizationUri();

	        // return to facebook login url
	         return Redirect::to( (string)$url );
	    }
	}

	public function getLoginWithGoogle() {
	    // get data from input
	    $code = Input::get( 'code' );

	    // get google service
	    $googleService = OAuth::consumer( 'Google' );

	    // check if code is valid

	    // if code is provided get user data and sign in
	    if ( !empty( $code ) ) {

	        // This was a callback request from google, get the token
	        $token = $googleService->requestAccessToken( $code );

	        // Send a request with it
	        $me = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

	        $profile = Profile::whereUid($me['id'])->first();

	        if (empty($profile)) 
		    {
		    	$user = User::where('email', '=', $me['email']);

		    	if ($user->count())
		    	{
		    		$user = $user->first();

		    		$user->firstname = $me['given_name'];
			        $user->lastname  = $me['family_name'];
			        $user->photo     = $me['picture'];
		    	}
		    	else
		    	{
		    		$user = new User;
			        $user->firstname = $me['given_name'];
			        $user->lastname  = $me['family_name'];	        
			        $user->email     = $me['email'];
			        $user->photo     = $me['picture'];
			        $user->score	 = '0,0,0,0,0,0,0';
		    	}

		        $user->save();

		        $profile = new Profile();
		        $profile->uid = $me['id'];
		        $profile->username = $me['id'];
		        $profile = $user->profiles()->save($profile);
		    }

		    $profile->save();

		    $user = $profile->user;

		    Auth::login($user);

		    return Redirect::to('/')->with('message', 'Logged in with Google');


	        // $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
	        // echo $message. "<br/>";

	        // //Var_dump
	        // //display whole array().
	        // dd($result);

	    }
	    // if not ask for permission first
	    else {
	        // get googleService authorization
	        $url = $googleService->getAuthorizationUri();

	        // return to google login url
	        return Redirect::to( (string)$url );
	    }
	}
}