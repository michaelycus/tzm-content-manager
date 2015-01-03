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
						<th></th>
						<th>Título</th>
						<th>Links</th>
						<th>Atividades</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($medias as $media)					
					<tr>					
						<td><img src="{{ $media->user->photo }}" alt="{{  $media->user->firstname }}" class="user-list"></td>
						<td> {{ $media->article->title }}</td>
						<td>
							@if ($media->article->link_wordpress != '')
							<a href="{{ $media->article->link_wordpress }}" target="_blank"><span class="btn-label icon fa fa-wordpress"></span></a>
							@endif
							@if ($media->article->link_extra != '')
							&nbsp;&nbsp;<a href="{{ $media->article->link_extra }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
							@endif
						</td>
						<td>
							FAZER AQUI O MESMO QUE FOI FEITO NA CLASSE STATUS.PHP
							<button class="btn btn-flat btn-xs btn-labeled btn-success"><span class="btn-label icon fa fa-check-circle"></span>Aprovado</button>
							<button class="btn btn-flat btn-xs btn-labeled btn-warning"><span class="btn-label icon fa fa-exclamation-circle"></span>Precisa ajuste</button>
						</td>
						<td>							
							<a href="#"  onclick="changeArticleId({{ $media->id }})" ng-click="reload({{ $media->id }})" data-toggle="modal" data-target="#commentModal">
								<small>{{ $media->article->num_comments }} <span class="btn-label icon fa fa-comment"></small>
							</a>							
						</td>						
						
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
		
	window.PixelAdmin.start(init);
</script>
			
@stop