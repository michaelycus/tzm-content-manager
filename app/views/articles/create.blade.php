<div id="createArticleModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Criar Artigo</h4>
			</div>

			<!-- Form::open(array('url' => url('articles-store'), 
								'class' => 'form-horizontal')) -->

			<!-- Form::open(['route' => 'articles-new']) -->	

			<form class="form-horizontal" method="post" action="{{ URL::route('articles-new') }}">			

				<div class="modal-body">
					
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Título</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="title" placeholder="[título do artigo]">
						</div>
					</div>

		 			<div class="form-group">
						<label for="link_wordpress" class="col-sm-2 control-label">Link Wordpress</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="link_wordpress" placeholder="[link para wordpress]">
						</div>
					</div>

					<div class="form-group">
						<label for="link_extra" class="col-sm-2 control-label">Link Adicional</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="link_extra" placeholder="[link para fonte adicional] (opcional)">
						</div>
					</div>

					<div class="form-group">
						<label for="author_id" class="col-sm-2 control-label">Autor</label>
						<div class="col-sm-10">							
							<select class="form-control form-group-margin" name="author_id">
								@foreach ($users as $user)
	                            <option value="{{$user->id}}" {{ ($user->id == Auth::id() ? 'selected' : '')}}>{{$user->firstname . ' ' . $user->lastname}}</option>
	                            @endforeach								
							</select>
						</div>
					</div>

				</div> <!-- / .modal-body -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Criar Artigo</button>
				</div>

				{{ Form::token() }}

			</form>

		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->
<!-- / Modal -->