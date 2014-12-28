@extends('layouts.default')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos</span></h1>

	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="#" class="btn btn-primary btn-labeled" style="width: 100%;" data-toggle="modal" data-target="#createArticleModal">
			<span class="btn-label icon fa fa-plus"></span>Criar artigo
		</a>
	</div>

</div> <!-- / .page-header -->


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
				@foreach ($articles_available as $article)
				<tr>					
					<td><img src="{{ $article->action->user->photo }}" alt="{{ $article->action->user->firstname }}" class="user-list"></td>
					<td> {{ $article->title }}</td>
					<td>
						@if ($article->link_wordpress != '')
						<a href="{{ $article->link_wordpress }}" target="_blank"><span class="btn-label icon fa fa-wordpress"></span></a>
						@endif
						@if ($article->link_extra != '')
						&nbsp;&nbsp;<a href="{{ $article->link_extra }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
					</td>
					<td></td>
					<td>
						<a href="#" onclick="changeArticleId({{ $article->id }})" data-toggle="modal" data-target="#commentModal">
							<small>6 <span class="btn-label icon fa fa-comment"></small>
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

@stop

@section('script')

<script type="text/javascript">

 	function changeArticleId(id)
 	{
 		init_video_id = id;
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