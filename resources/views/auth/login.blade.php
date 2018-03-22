@extends('main')

@section('title', '| login')

@section('content')
	<!-- need to make sure that you have CSRF protection laravel will check that -->
	<div class="row justify-content-md-center">
		<div class="col-md-6">
			{!! Form::open() !!}
				{{ Form::label('email', 'Email:') }}
				{{ Form::email('email', null, ['class' => 'form-control']) }}

				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password', ['class' => 'form-control']) }}
				
				<br>
				{{ Form::checkbox('remember') }}{{ Form::label('remember', 'Remember Me') }}

				<br>
				{{ Form::submit('Login', ['class' => 'btn btn-primary btn-block']) }}
				
				{{ Html::linkRoute('register', 'register') }}
				<p><a href="{{ url('password/reset') }}">Forgot My Password</a>
			{!! Form::close() !!}
		</div>
	</div>
@stop