@extends('layouts.default')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Artigo: {{ $media->article->title }}</span></h1>
</div> <!-- / .page-header -->

{{ Debugbar::warning('feito'); }}

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			
			<div class="panel-heading">
				<span class="panel-title">Informações</span>
			</div>

			<div class="panel-body">

				{{ Form::model($media, array('route' => array('articles.update', $media->id), 'method' => 'PUT')) }}

					<div class="modal-body">
						
						<div class="form-group">							
							{{ Form::label('title', 'Título', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-10">								
        						{{ Form::text('title', $media->article->title, array('class' => 'form-control')) }}					
							</div>
						</div>

			 			<div class="form-group">
			 				{{ Form::label('link_wordpress', 'Link Wordpress', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-10">
								{{ Form::text('link_wordpress', $media->article->link_wordpress, array('class' => 'form-control')) }}
							</div>
						</div>

						<div class="form-group">							
							{{ Form::label('link_extra', 'Link Extra', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-10">
								{{ Form::text('link_extra', $media->article->link_extra, array('class' => 'form-control')) }}
							</div>
						</div>

						<div class="form-group">
							<label for="user_id" class="col-sm-2 control-label">Autor</label>
							<div class="col-sm-10">	
								{{ Form::select('user_id', $users, $media->user_id, ['class' => 'form-control form-group-margin'] ) }}
							</div>
						</div>

					</div> <!-- / .modal-body -->

					<div class="modal-footer">

						{{ HTML::link('/articles', 'Cancelar', array('class' => 'btn btn-default')) }}
						{{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
					</div>

					{{ Form::token() }}

				{{ Form::close() }}

				<span class="pull-left">
					{{ Form::delete('articles/'. $media->id, 
		                'Remover',
		                array('id'=>'delete_form'),
		                array('class'=>'btn btn-danger button', 'id'=> 'ui-bootbox-confirm')
	                ) }}
				</span>

			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Comentários</span>
			</div>

			<div class="panel-body tab-content tab-content-bordered panel-padding" ng-app="commentApp" ng-controller="commentController"> 
					
				<div class="widget-article-comments tab-pane panel no-padding no-border fade in active" id="profile-tabs-board">

					<div class="comment">
						<img src="{{ Auth::user()->photo() }}" alt="" class="comment-avatar">

						<div class="comment-body">
							<form id="leave-comment-form" class="comment-text no-padding no-border" ng-submit="submitComment()" ng-init="commentData.media_id={{ $media->id }}">
								<textarea class="form-control" rows="1" ng-model="commentData.message"></textarea>
								<div class="expanding-input-hidden" style="margin-top: 10px;">
									<label class="checkbox-inline pull-left">
										<input type="checkbox" class="px">													
									</label>
									<button type="submit" class="btn btn-primary pull-right">Comentar</button>
								</div>
							</form>
						</div> <!-- / .comment-body -->
					</div>

					<hr class="no-panel-padding-h panel-wide">

					<!-- LOADING ICON =============================================== -->
					<!-- show loading icon if the loading variable is set to true -->

					<div class="text-center" ng-show="loading"><span class="fa fa-refresh fa-5x fa-spin"></span></div>

					<div class="comment" ng-hide="loading" ng-repeat="comment in comments | limitTo: -10 | orderBy: 'id':true">
						
						<div ng-show="comment.reply_to == 0">
							<img ng-src="@{{ comment.user.photo }}" alt="" class="comment-avatar">
							<div class="comment-body">
								<div class="comment-text">
									<div class="comment-heading">
										<a href="#" title="">@{{ comment.user.firstname + ' ' + comment.user.lastname  }}</a><span>@{{ comment.created_at | date:'medium' }}</span>
									</div>
									@{{ comment.message }}
								</div>
								<div class="comment-footer">
									<a href="" ng-click="replyComment($index)" class="text-muted">
									<i class="fa fa-reply"></i> Responder</a>

									<a href="#" ng-show="showComment(comment, {{ Auth::id() }})" ng-click="deleteComment(comment.id)" class="text-muted">
									<i class="fa fa-trash-o"></i> Remover</a>												
								</div>
							</div>

							<div class="comment-body" ng-show="$index == replyTo">										
								<form class="comment-text no-padding no-border" ng-submit="submitReply(comment.id)">
									<textarea class="form-control" rows="1" ng-model="commentData.reply_text"></textarea>
									<div style="margin-top: 10px;">
										<label class="checkbox-inline pull-left">
											<input type="checkbox" class="px">													
										</label>
										<button type="submit" class="btn btn-primary pull-right">Responder</button>
									</div>
								</form>
								<br><br>
							</div>

						</div>
						
						<div class="comment" ng-repeat="subcomment in comments | limitTo: 100 | orderBy: 'id':false" ng-show="subcomment.reply_to == comment.id">
							
							<img ng-src="@{{ subcomment.user.photo }}" alt="" class="comment-avatar">
							<div class="comment-body">
								<div class="comment-text">
									<div class="comment-heading">
										<a href="#" title="">@{{ subcomment.user.firstname + ' ' + subcomment.user.lastname  }}</a><span>@{{ subcomment.created_at | date:'medium' }}  @{{ subcomment.reply_to + ' - ' + comment.id }}</span>
									</div>
									@{{ subcomment.message }}
								</div>
								<div class="comment-footer">										
									<a href="#" ng-show="showComment(subcomment, {{ Auth::id() }})" ng-click="deleteComment(subcomment.id)" class="text-muted"><i class="fa fa-trash-o"></i> Remover</a>
								</div>
							</div> <!-- / .comment-body -->	
						</div>									
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>

@stop

@section('script')

<script type="text/javascript">
	media_id = {{ $media->id }};

	function teste()
	{
		//confirm("mesmo?");
	}

	$('#delete_form').on('submit', 'bootbox-sm', function(){
	    return alert('Are you sure?');
	});	

	init.push(function () {

			

		$("#leave-comment-form").expandingInput({
			target: 'textarea',
			hidden_content: '> div',
			placeholder: 'Escreva um comentário',
			onAfterExpand: function () {
				$('#leave-comment-form textarea').attr('rows', '3').autosize();
			}
		});
	});
		
	window.PixelAdmin.start(init);
</script>
		
@stop