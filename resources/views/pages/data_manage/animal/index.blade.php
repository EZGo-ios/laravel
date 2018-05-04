@extends('main')

@section('title', '| animal_index')

@section('stylesheets')
	{!! Html::style('css/jeff_css/animal_css/style.css') !!}
	{!! Html::style('css/jeff_css/myCSS.css') !!}
@endsection
 	
@section('content')
	<div class="row form-spacing-top">
	 	<div class="col-md-2">
			<a href="{{ route('page.index') }}" class="btn btn-lg btn-block btn-primary btn-margin">返回</a>	
		</div>
        
		<div class="col-md-8">
			<h1>動物資料</h1>
		</div>

		<div class="col-md-2">
			<a href="{{ route('animalPosts.create') }}" class="btn btn-lg btn-block btn-primary btn-margin">新增</a>	
		</div>
	</div><!-- end of .row -->
	
	<table>
	  	<thead>
	    	<tr class="tbl-header">
	      		<th>動物名稱</th>
	      		<th>經度</th>
	      		<th>緯度</th>
	      		<th></th>
	    	</tr>
	  	</thead>
  		<tbody>
	  		@foreach ($animals as $animalData)
				<tr class="tbl-content">
			      	<td scope="row">{{ $animalData -> animal_name }}</td>
			      	<td>{{ $animalData -> location -> lng }}</td>
			      	<td>{{ $animalData -> location -> lat }}</td>

			      	<td>
			      		<a href="{{ Route('animalPosts.show', [$animalData->animal_id, $animalData->location->location_id]) }}" class="btn btn-primary">查看</a>
			      	</td>
	    		</tr>
	    	@endforeach	  			
  		</tbody>
	</table>
  	
  	<div class="row justify-content-md-center">
  		{{ $animals -> links() }}
  	</div>
@endsection

