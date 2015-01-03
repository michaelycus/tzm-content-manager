<?php


class Video extends Eloquent{
	
		protected $fillable = array('title', 'duration', 'thumbnail', 'original_link', 'working_link', 'status' );

	public function tasks() {
		return $this->hasMany('Task', 'media_id');
	}

	// public static function forApproval()
	// {
	// 	return Video::where('status', '=', VIDEO_FOR_APPROVAL)->count();
	// }

	public function suggestedBy()
	{
		$task = $this->tasks()->where('type','=',TASK_VIDEO_ADDED)->first();

		return User::find($task['user_id']);		
	}

	public function comments(){		
		return $this->hasMany('Comment');
	}
}
