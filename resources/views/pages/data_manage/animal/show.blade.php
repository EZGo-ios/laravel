@extends('main')

@section('title', '| animal_show')

@section('stylesheets')
	{!! Html::style('css/jeff_css/showCSS.css') !!}
	{!! Html::style('css/jeff_css/myCSS.css') !!}
@endsection

@section('content')

		<div class="row">
			<div class="col-md-7">
				<h1>動物名稱：{{ $animalData -> animal_name }}</h1>
				<p class='lead'>經度：{{ $animalData -> location -> lng }}</p>
				<p class='lead'>緯度：{{ $animalData -> location -> lat }}</p>
			</div>

			<div class="col-md-5">
				<div class="card border-secondary mb-3">
					<div class="card-header">	
						<div class="title">
							資料處理
						</div>		

					</div>

					<div class="card-body">	

						<br>

						<div class="row">
							<div class="col-sm-6">
								{!! Form::open(['route' => 'animalPosts.edit', 'method' => 'get']) !!}
					      			{{ Form::hidden('animal_id', $animalData -> animal_id) }}
					      			{{ Form::hidden('location_id', $animalData -> location_id) }}
					      			{{ Form::submit('更新', ['class' => 'btn btn-primary btn-block']) }}
				      			{!! Form::close() !!}
																			
							</div>
							<div class="col-sm-6">
								{!! Form::open(['route' => 'animalPosts.destroy', 'method' => 'DELETE']) !!}
									{{ Form::hidden('animal_id', $animalData -> animal_id) }}
					      			{{ Form::hidden('location_id', $animalData -> location_id) }}
									{{ Form::submit('刪除', ['class' => 'btn btn-danger btn-block']) }}
								{!! Form::close() !!}
							</div>
						</div>

						<br>

						<div class="row">
							<div class="col-md-12">
								{{ Html::linkRoute('animalPosts.index', '<< 取消', [], array('class' => 'btn btn-secondary btn-block')) }}	
							</div>
						</div>
					</div> <!-- end of .card-body -->
				</div> <!-- end of .card -->
			</div> <!-- end of .col-md-5 -->
		</div> <!-- end of .row -->

@endsection

