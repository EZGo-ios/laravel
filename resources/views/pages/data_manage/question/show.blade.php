@extends('main')

@section('title', '| question_show')

@section('content')
	<div class="row">
		<div class="col-md-7">
			<h1>主題：{{ $questionData -> worksheet -> worksheet_name }}</h1>
			<p class='lead'>動物：{{ $questionData -> animal -> animal_name }}</p>
			<p class='lead'>題目：{{ $questionData -> question }}</p>
			
			@php ($items = 0)
			@foreach ($optionData as $option)
				@php ($items++)
				<p class='lead'>選項{{ $items }}：{{ $option -> qOption }}</p>
			@endforeach

			<p class='lead'>答案：選項{{ $questionData -> answer }}</p>
			<p class='lead'>答案解釋：{{ $questionData -> description -> description }}</p>
		</div>
	

		<div class="col-md-5">
		    <div class="card border-secondary mb-3">
		        <div class="card-header">	
		            <div class="row justify-content-md-center">
		                資料處理
		            </div>		
		        </div>

		        <div class="card-body">	
		            <div class="row">
		                <div class="col-sm-6">
		                    {!! Form::open(['route' => 'questionPosts.edit', 'method' => 'get']) !!}
		                        {{ Form::hidden('question_id', $questionData -> question_id) }}
		                        {{ Form::submit('更新', ['class' => 'btn btn-primary btn-block']) }}
		                    {!! Form::close() !!}
		                                                                
		                </div>
		                <div class="col-sm-6">
		                    {!! Form::open(['route' => ['questionPosts.destroy', $questionData -> question_id], 'method' => 'DELETE']) !!}
		                        {{ Form::submit('刪除', ['class' => 'btn btn-danger btn-block']) }}
		                    {!! Form::close() !!}
		                </div>               
		            </div>

		            <div class="row">
		                <div class="col-md-12">
		                    {{ Html::linkRoute('questionPosts.index', '<< 取消', [], array('class' => 'btn btn-secondary btn-block')) }}	
		                </div>
		            </div>
		        </div> <!-- end of .card-body -->
		    </div> <!-- end of .card -->
		</div> <!-- end of .col-md-5 -->
	</div> <!-- end of .row -->
@endsection

