@extends('main')

@section('title', '| animal_edit')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/jeff_css/animal_css/formCSS.css') !!}
	{!! Html::style('css/jeff_css/myCSS.css') !!}
@endsection

@section('content')
	<div class="row justify-content-around">
		<div class="col-md-8">

			{!! Form::open(['route' => 'animalPosts.update', 'method' => 'put']) !!}

				{{ Form::hidden('animal_id', $animalData -> animal_id) }}
			    {{ Form::hidden('location_id', $animalData -> location_id) }}	
			    
				{{ Form::label('animal_name', '動物名稱：') }}
				{{ Form::text('animal_name', $animalData -> animal_name, ['class' => 'form-control']) }}

				{{ Form::label('lng', '經度：') }}
				{{ Form::text('lng', $animalData -> location -> lng, ['class' => 'form-control']) }}

				{{ Form::label('lat', '緯度：') }}
				{{ Form::text('lat', $animalData -> location -> lat, ['class' => 'form-control']) }}
				
                <br>
                    
				<div class="row">
					<div class="col-md-6">
						{{ Html::linkRoute('animalPosts.index', '<< 取消', array(), array('class' => 'btn btn-secondary btn-block')) }}	
					</div>

					<div class="col-md-6">
						{{ Form::submit('修改', ['class' => 'btn btn-block btn-success'])}}
					</div>
				</div>
				
			{!! Form::close() !!}
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/pagesCreate.js') !!}
	{!! Html::script('js/parsley.js') !!}
	{!! Html::script('js/zh_tw.js') !!}
@endsection

