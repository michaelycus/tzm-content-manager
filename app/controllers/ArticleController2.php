<?php

class ArticleController extends \BaseController {

	public function getAvailable()
	{
		// $articles_available = Article::where('status', '=', ARTICLE_STATUS_AVAILABLE)->get();
		// $articles_reviewed  = Article::where('status', '=', ARTICLE_STATUS_REVIEWED)->get();
  //       $articles_scheduled = Article::where('status', '=', ARTICLE_STATUS_SCHEDULED)->get();
		
        //$medias = Media::all();
        $medias = Media::where('status', '=', MEDIA_ARTICLE_AVAILABLE)->get();
        //$articles = MEDIAS::all();//where('status', '=', MEDIA_ARTICLE_AVAILABLE)->get();

  //       foreach ($articles as $article) {
  //           $article->num_comments = Comment::where('media_id', '=', $article->id)->count();
  //       }

		$users = User::all();

        return View::make('articles.available', array('medias' => $medias,
                                                      'users' => $users));


        //return View::make('articles.available');

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
            'user_id'        => 'required'
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
            $media->save();

            $article = new Article;
            $article->media_id        = $media->id;
            $article->title 	      = Input::get('title');
            $article->link_wordpress  = Input::get('link_wordpress');
            $article->link_extra      = Input::get('link_extra');            
            $article->save();

            // redirect
            Session::flash('message', 'Artigo criado com sucesso!');
            return Redirect::route('articles-available');
        }
	}

    public function getTasks($media_id)
    {
        if (Request::ajax())
        {
            $my_tasks = Task::where('media_id', '=', $media_id)->
                              where('user_id', '=', Auth::id())->orderBy('id')->get();

            $need_adjust = FALSE;
            $approved = FALSE;

            foreach ($my_tasks as $t) 
            {                
                if ($t->type == TASK_ARTICLE_APPROVED)
                    $approved = TRUE;

                if ($t->type == TASK_ARTICLE_NEED_ADJUST)
                    $need_adjust = TRUE;
            }                  

            $text = '<div class="btn-group" style="width: 110px">';

            if (!$approved)
            {
                if (!$need_adjust)
                {
                    $text .= '<button class="btn btn-flat btn-xs btn-labeled btn-warning btn-block" onclick="setAdjust('.$media_id.')"><span class="btn-label icon fa fa-exclamation-circle"></span>Precisa ajuste</button><br/><br/>';
                }
                $text .= '<button class="btn btn-flat btn-xs btn-labeled btn-success btn-block" onclick="setApproved('.$media_id.')"><span class="btn-label icon fa fa-check-circle"></span>Aprovado</button>';
            }

            $text .= '</div>';

            $tasks = Task::where('media_id', '=', $media_id)->orderBy('type')->get();

            $user_task = array();
            foreach ($tasks as $task) {
                $user_task[$task->user_id][] = $task->type;
            }

            $u_adjust = '';
            $u_approved = '';

            foreach ($user_task as $user_id => $type) {
                $user = User::find($user_id);

                foreach ($type as $t) {
                    if ($t == TASK_ARTICLE_APPROVED)
                    {
                        $u_approved .= '<a href="' . URL::route('users-profile', $user->id) .'" target="_blank" 
                                data-toggle="tooltip" data-placement="top" data-original-title="  '. $user->firstname . ' ' . $user->lastname . '">
                                    <img src="'. $user->photo().'" alt="" class="user-list">
                                </a>';
                        break;   
                    }
                    else if ($t == TASK_ARTICLE_NEED_ADJUST)
                    {
                        $u_adjust .= '<a href="' . URL::route('users-profile', $user->id) .'" target="_blank" 
                                data-toggle="tooltip" data-placement="top" data-original-title="  '. $user->firstname . ' ' . $user->lastname . '">
                                    <img src="'. $user->photo().'" alt="" class="user-list">
                                </a>';
                    }
                }
            }

            if ($u_adjust != '')
            {
                $text .= '<i class="icon fa fa-2x fa-exclamation text-warning"></i>';
                $text .= $u_adjust;
            }

            if ($u_approved != '')
            {
                $text .= '<i class="btn-label icon fa fa-2x fa-check text-success"></i>';
                $text .= $u_approved;
            }            

            return $text;
        }
    }

    public function getAdjust($media_id)
    {
        if (Request::ajax())
        {
            Task::create(array(
                'type' => TASK_ARTICLE_NEED_ADJUST,
                'user_id' => Auth::id(),
                'media_id' => $media_id
            ));
        }
    }

    public function getApproved($media_id)
    {
        if (Request::ajax())
        {
            Task::create(array(
                'type' => TASK_ARTICLE_APPROVED,
                'user_id' => Auth::id(),
                'media_id' => $media_id
            ));
        }
    }
}