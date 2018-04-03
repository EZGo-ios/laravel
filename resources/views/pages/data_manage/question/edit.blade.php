@extends('main')

@section('title', '| question_edit')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}  
	{!! Html::style('css/jeff_css/question_css/formCSS_Questions.css') !!}
    {!! Html::style('css/jeff_css/myCSS.css') !!}
@endsection

@section('content')
	<div class="row justify-content-around">
		<div class="col-md-8">
			{!! Form::open(['route' => 'questionPosts.update', 'method' => 'put', 'data-parsley-validate' => '']) !!}

				{{ Form::hidden('question_id', $questionData -> question_id) }}
				
			    {{ Form::label('worksheet_name', '主題：') }}
				{{ Form::Select('worksheet_name', $works, $questionData -> worksheet_id, ['class' => 'form-control']) }}
				<div class="border"></div>

				{{ Form::label('animal_name', '動物名稱：') }}
				{{ Form::Select('animal_name', $ani, $questionData -> animal_id, ['class' => 'form-control']) }}
				<div class="border"></div>
				
				{{ Form::label('question', '題目：') }}
				{{ Form::text('question', $questionData -> question, ['class' => 'form-control', 'required', 'maxlength' => '255']) }}
				<div class="border"></div>
				
				<div class="select" id="select">
					@php ($items = 0)
					@foreach ($optionData as $option)
						
						@php ($items ++)
						<div class="item_{{ $items }}" id="item_{{ $items }}">
							{{ Form::label('qOption_'.$items, '選項'.$items.'：', ['id' => 'lblOption_'.$items] ) }} 
							
							{{ Form::text('qOption_'.$items, $option -> qOption, ['class' => 'form-control', 'required', 'maxlength' => '255']) }}

							{{ Form::button('刪除', ['class' => 'form-control btn btn-primary', 
													'onclick' => 'deleteElement(item_'.$items.', '.$items.')', 
													'id' => 'btnDelete_'.$items]) }}
							<p>
						</div>
					@endforeach
				</div>
				<br>
				{{ Form::button('新增選項', ['class' => 'btn btn-primary', 'onclick' => 'addSelect_item()'] ) }}
				<br>
				<div class="border"></div>

				{{ Form::label('answer', '答案：', ['class' => ''] ) }}
			
				<div class="col-md-2">
					選項
				</div>

				<div class="col-md-10">
					{{ Form::text('answer', $questionData -> answer, 
										['class' 			 => 'form-control', 
										 'required' 	 	 => '', 
										 'data-parsley-type' => "integer", 
										 'min' 		 		 => '1', 
										 'max' 		 		 => $items]) }}
				</div>
					
				<div class="border"></div>

				<br>
				{{ Form::label('description', '答案解釋：') }}
				
				{{ Form::checkbox('exist', 1, true, ['onChange' => 'enableObject(exist, existDesc, description)', 'id' => 'exist']) }}
				{{ Form::label('exist', '從已有的解釋清單選取')}}
				{{ Form::Select('existDesc', $descrip, $questionData -> description_id, ['class' => 'form-control']) }}

				{{ Form::text('description', null, ['class' => 'form-control', 
													'disabled' => 'disabled', 
													'maxlength' => '255']) }}

				<div class="row">
					<div class="col-md-6">
						{{ Html::linkRoute('questionPosts.index', '<< 取消', array(), array('class' => 'btn btn-secondary btn-block ')) }}	
					</div>

					<div class="col-md-6">
						{{ Form::submit('修改', ['class' => 'btn btn-block btn-success ']) }}
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

