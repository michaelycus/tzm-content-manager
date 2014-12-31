<?php

class CommentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($media_type, $media_id)
	{
		return Response::json(Comment::with('user')->where('media_type', '=', $media_type)
												   ->where('media_id', '=', $media_id)->get());

		//return Response::json(Comment::get());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		Comment::create(array(
			'media_type'=> Input::get('media_type'),
			'media_id' 	=> Input::get('media_id'),
			'reply_to' 	=> Input::get('reply_to'),
			'user_id' 	=> Auth::id(),
			'message' 	=> Input::get('message')		
		));

		return Response::json(array('success' => true));
	}

	/**
	 * Return the specified resource using JSON
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(Comment::find($id));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Comment::destroy($id);

		Comment::where('reply_to', '=', $id)->delete();

		return Response::json(array('success' => true));
	}

}
