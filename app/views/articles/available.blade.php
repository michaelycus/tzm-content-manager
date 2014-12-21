@extends('layouts.default')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos / </span></h1>
</div> <!-- / .page-header -->



<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Hover row tables</span>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Jacob</td>
					<td>Thornton</td>
					<td>@fat</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Larry</td>
					<td>the Bird</td>
					<td>@twitter</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>




@stop

@section('script')

<script type="text/javascript">	

</script>
			
@stop