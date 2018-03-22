@extends('main')

@section('title', '| question_create')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row justify-content-around">
		<div class="col-md-8">
			{!! Form::open(['route' => 'questionPosts.store', 'id' => 'create', 'data-parsley-validate' => '']) !!}

				{{ Form::checkbox('existTheme', 1, true, ['onChange' => 'enableObject(existTheme, worksheet_name, worksheet)', 'id' => 'existTheme']) }}
				{{ Form::label('existTheme', '從已有的主題清單選取')}}
				{{ Form::Select('worksheet_name', $works, 1, ['class' => 'form-control']) }}
				{{ Form::text('worksheet', null, ['class' => 'form-control', 'disabled' => 'disabled', 'maxlength' => '255']) }}

			    {{ Form::label('animal_name', '動物名稱：') }}
			    {{ Form::select('animal_name', $ani, null, ['class' => 'form-control', 'required']) }}
		
			    {{ Form::label('question', '題目：') }}
			    {{ Form::text('question', null, array('class' => 'form-control', 'required', 'maxlength' => '255')) }}

			    {{ Form::label('quantity', '欲加入的選項數量：') }}
				{{ Form::select('quantity',[
				    '2' => '2',  
				    '3' => '3',
				    '4' => '4',
				], '4', array('onchange' => 'addSelect()', 'id' => 'quantity') ) }}  
				<!-- 第三個參數為預設值 -->
				<br/>
				
				<div class="select" id="select">
					@for ($i = 1; $i <= 4; $i++)
    					{{ Form::label('selection_'.$i, '選項'.$i.'：', ['class' => 'form-spacing-top']) }}
    					{{ Form::text('selection_'.$i, null, array('class' => 'form-control', 'required', 'maxlength' => '255')) }}
					@endfor
				</div>

				{{ Form::label('description', '答案解釋：', ['class' => 'form-spacing-top']) }}	
				{{ Form::checkbox('exist', 1, true, ['onChange' => 'enableObject(exist, existDesc, description)', 'id' => 'exist']) }}

				{{ Form::label('exist', '從已有的解釋清單選取')}}
				{{ Form::Select('existDesc', $descrip, 1, ['class' => 'form-control']) }}	
				{{ Form::text('description', null, ['class' => 'form-control', 
													'disabled' => 'disabled', 
													'maxlength' => '255']) }}

				<br/>

			    {{ Form::label('answer', '答案：') }}
				{{ Form::text('answer', null, ['class' => 'form-control', 
											   'required' 	 	 	 => '', 
											   'data-parsley-type' 	 => "integer", 
											   'min' 		 		 => '1', 	
											   'max' 		 		 => '4']) }}
				
				<div class="row">
					<div class="col-md-6">
						{{ Html::linkRoute('questionPosts.index', 'Cancel', array(), array('class' => 'btn btn-secondary btn-block form-spacing-top')) }}	
					</div>

					<div class="col-md-6">
						{{ Form::submit('新增', ['class' => 'btn btn-block btn-success form-spacing-top']) }}
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