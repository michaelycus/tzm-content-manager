<?php

class VideoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getAvailable()
	{
		$medias = Media::where('status', '=', MEDIA_VIDEO_AVAILABLE)->get();

		foreach ($medias as $media) {
			$media->tasks = Task::where('media_id', '=', $media->id)->orderBy('user_id')->get();
		}

		return View::make('videos.status', array('medias' => $medias,
		   								         'status' => MEDIA_VIDEO_AVAILABLE));
	}

	public function getPublished()
	{
		
	}

   /**
	*
	* 	AJAX CALLS 
	*
	*/
	public function getTasks($media_id, $status)
	{
		if (Request::ajax())
		{
		    $tasks = Task::where('media_id', '=', $media_id)->orderBy('id')->get();

			$icons = unserialize (IMG_VIDEO_STATUS);

			$currentUser = Auth::id();

			$user_task = array();
			foreach ($tasks as $task) {
				$user_task[$task->user_id][] = $task->type;
			}

			$text = '<div class="text-center">';

			$is_helping = FALSE;

			foreach ($user_task as $user_id => $type) {
				$user = User::find($user_id);

				$text .= '<a href="' . URL::route('users-profile', $user->id) .'" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="  '. $user->firstname . ' ' . $user->lastname . '"><img src="'. $user->photo().'" alt="" class="user-list"></a>';
				
				foreach ($type as $t) {
					if ($t < TASK_REJECTED_VIDEO) // Don't need to present approved icon
						$text .= ' <i class="menu-icon fa '. $icons[$t] . ' text-primary"></i> ';

					if ($currentUser == $user_id && $t == $status) // current is participating of the task
						$is_helping = TRUE;
				}
			}

			$text .= '</div><br/>';

			if ($is_helping)
			{
				$text .= '<button class="btn btn-flat btn-sm btn-labeled btn-danger" onclick="setStopHelp('.$media_id.','.$status.')"><span class="btn-label icon fa fa-times-circle"></span>Stop helping!</button>';
			}
			else
			{
				$text .= '<button class="btn btn-flat btn-sm btn-labeled btn-success" onclick="setHelp('.$media_id.','.$status.')"><span class="btn-label icon fa fa-check-circle"></span>I want to help!</button>';	
			}

			return $text;
		}		
	}

}
