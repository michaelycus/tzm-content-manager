@extends('layouts.default')

@section('content')

<script>
	var media_id = 1;	
</script>

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos</span></h1>

	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="#" class="btn btn-primary btn-labeled" style="width: 100%;" data-toggle="modal" data-target="#createArticleModal">
			<span class="btn-label icon fa fa-plus"></span>Criar artigo
		</a>
	</div>

</div> <!-- / .page-header -->


<div ng-app="commentApp" ng-controller="commentController">

	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Para revisar</span>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Criado por</th>
						<th>Links</th>
						<th>Título</th>						
						<th style="text-align: right">Revisado por</th>
						<th style="text-align: right"></th>						
					</tr>
				</thead>
				<tbody>
					@foreach ($medias as $media)					
					<tr>					
						<td><img src="{{ $media->user->photo }}" alt="{{  $media->user->firstname }}" class="user-list"></td>
						<td>
							@if ($media->article->link_wordpress != '')
							<a href="{{ $media->article->link_wordpress }}" target="_blank"><span class="btn-label icon fa fa-wordpress"></span></a>
							@endif
							@if ($media->article->link_extra != '')
							&nbsp;&nbsp;<a href="{{ $media->article->link_extra }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
							@endif
						</td>
						<td> {{ $media->article->title }}</td>
						
						<td>
							<span class="pull-right">
								<div class="text-center tasks-panel" id="{{ $media->id }}"></div>				
							</span>
						</td>

						<td>
							<span class="pull-right">
								<a href="#" onclick="changeArticleId({{ $media->id }})" ng-click="reload({{ $media->id }})" data-toggle="modal" data-target="#commentModal">
									<small>{{ count($media->comments) }} <span class="btn-label icon fa fa-comment"></small>
								</a>
								&nbsp;&nbsp;
								<a class="btn btn-xs btn-primary" href="{{ URL::to('articles/' . $media->id . '/edit') }}"><i class="fa fa-edit"></i></a>
							</span>
						</td>

						<!-- 
						<td><a class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button> 
							<a onClick="remove_article({{ $media->id }});" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>

						<td>
							{{ Form::delete('resource/'. $media->id, 
			                'Delete',
			                array('id'=>$media->id,'class' => 'btn btn-danger btn-xs'),
			                array('class'=>'the-delete-link')
			                ) }}							
						</td>

		                
				        {{-- Form::open(array('method' => 'DELETE', 'route' =>
							array('articles.destroy', $media->id))) }}
						{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
						{{ Form::close() --}} 
						-->

					</tr>							
					@endforeach				
				</tbody>
			</table>
		</div>
	</div>


@include('articles.create')

@include('articles.comments')

</div>

@stop

@section('script')

<script type="text/javascript">

 	function changeArticleId(id)
 	{
 		media_id = id;
 	}	

 	function refresh_medias()
	{
		$('div.tasks-panel').empty();

		$('div.tasks-panel').each(function(index, value){
		    var media_id = $(this).attr('id');
		    //var current_status = ;
		    var url = '<?php echo URL::to('/'); ?>' + '/articles/tasks/' + media_id;
			var div = $(this);

		    $.get(url, function(data) {	                   	    	
	           div.append(data);
	        });	 
		});
	}

	function setAdjust(media_id)
	{		
		var url = '<?php echo URL::to('/'); ?>' + '/articles/adjust/' + media_id;
		$.get(url, function(data) {
           refresh_medias();
	    });			
	}

	function setApproved(media_id)
	{		
		var url = '<?php echo URL::to('/'); ?>' + '/articles/approved/' + media_id;
		$.get(url, function(data) {
           refresh_medias();
	    });			
	}

	function remove_article(media_id)
	{
		bootbox.confirm({
			message: "Remover esse artigo?",
			callback: function(result) {
				if (result)
				{
					var url = '<?php echo URL::to('/'); ?>' + '/articles/remove/' + media_id;
					$.get(url, function(data) {					
					   $.growl.notice({ title: "Ok!", message: "The video was removed!" });
			           $("tr[data-row-id='"+media_id+"']").slideUp("slow");
				    });	
				}							
			},
			className: "bootbox-sm"
		});
	}

	init.push(function () {		

		$("#leave-comment-form").expandingInput({
			target: 'textarea',
			hidden_content: '> div',
			placeholder: 'Write message',
			onAfterExpand: function () {
				$('#leave-comment-form textarea').attr('rows', '3').autosize();
			}
		});
	})	

	refresh_medias();
		
	window.PixelAdmin.start(init);
</script>
			
@stop