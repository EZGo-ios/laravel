@extends('main')

@section('title', '| animal_create')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/jeff_css/animal_css/formCSS.css') !!}
	{!! Html::style('css/jeff_css/myCSS.css') !!}
@endsection

@section('content')
	<div class="row justify-content-around">
		<div class="col-md-8">

			{!! Form::open(['route' => 'animalPosts.store', 'data-parsley-validate' => '']) !!}
			    {{ Form::label('animal_name', '動物名稱：') }}
			    {{ Form::text('animal_name', null, [
				    'class' 			=> 'form-control', 
				    'required' 			=> '', 
			    ]) }}
		
			    {{ Form::label('lng', '經度：') }}
			    {{ Form::text('lng', null, [
			    	'class' 			=> 'form-control', 
			    	'required',
			    	'data-parsley-type' => 'number'
			    ]) }}

			    {{ Form::label('lat', '緯度：') }}
				{{ Form::text('lat', null, [
			    	'class' 			=> 'form-control', 
			    	'required',
			    	'data-parsley-type' => 'number'
			    ]) }}

				{{ Form::submit('新增', ['class' => 'btn btn-success btn-lg btn-block form-spacing-top']) }}

				{{ Html::linkRoute('animalPosts.index', '<< 取消', [], array('class' => 'btn btn-secondary btn-block')) }}	
			{!! Form::close() !!}	
		</div>
	</div>         
				

@endsection

@section('scripts')
	{!! Html::script('js/parsley.js') !!}
	{!! Html::script('js/zh_tw.js') !!}
@endsection