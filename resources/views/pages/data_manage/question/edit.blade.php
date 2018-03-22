@extends('main')

@section('title', '| animal_edit')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	<div class="row justify-content-around">
		<div class="col-md-8">
			{!! Form::open(['route' => 'questionPosts.update', 'method' => 'put', 'data-parsley-validate' => '']) !!}

				{{ Form::hidden('question_id', $questionData -> question_id) }}
				
			    {{ Form::label('worksheet_name', '主題：', ['class' => 'form-spacing-top']) }}
				{{ Form::Select('worksheet_name', $works, $questionData -> worksheet_id, ['class' => 'form-control']) }}

				{{ Form::label('animal_name', '動物名稱：', ['class' => 'form-spacing-top']) }}
				{{ Form::Select('animal_name', $ani, $questionData -> animal_id, ['class' => 'form-control']) }}
				
				{{ Form::label('question', '題目：', ['class' => 'form-spacing-top']) }}
				{{ Form::text('question', $questionData -> question, ['class' => 'form-control', 'required', 'maxlength' => '255']) }}
				
				<div class="select" id="select">
					@php ($items = 0)
					@foreach ($optionData as $option)
						
						@php ($items ++)
						<div class="item_{{ $items }}" id="item_{{ $items }}">
							{{ Form::label('qOption_'.$items, '選項'.$items.'：', ['class' => 'form-spacing-top', 'id' => 'lblOption_'.$items] ) }} 
							
							{{ Form::text('qOption_'.$items, $option -> qOption, ['class' => 'form-control', 'required', 'maxlength' => '255']) }}

							{{ Form::button('刪除', ['class' => 'form-control btn btn-primary', 
													'onclick' => 'deleteElement(item_'.$items.', '.$items.')', 
													'id' => 'btnDelete_'.$items]) }}
						</div>
					@endforeach
				</div>

				{{ Form::button('新增：', ['class' => 'form-spacing-top btn btn-primary', 'onclick' => 'addSelect_item()'] ) }}
				<br>

				{{ Form::label('answer', '答案：', ['class' => 'form-spacing-top'] ) }}
				<div class="answer">
					<div class="row">
						<div class="col-md-1">
							選項
						</div>

						<div class="col-md-11">
							{{ Form::text('answer', $questionData -> answer, 
												['class' 			 => 'form-control', 
												 'required' 	 	 => '', 
												 'data-parsley-type' => "integer", 
												 'min' 		 		 => '1', 
												 'max' 		 		 => $items]) }}
						</div>
					</div>
				</div>

				<br>
				{{ Form::label('description', '答案解釋：', ['class' => 'form-spacing-top']) }}
				
				{{ Form::checkbox('exist', 1, true, ['onChange' => 'enableObject(exist, existDesc, description)', 'id' => 'exist']) }}
				{{ Form::label('exist', '從已有的解釋清單選取')}}
				{{ Form::Select('existDesc', $descrip, $questionData -> description_id, ['class' => 'form-control']) }}

				{{ Form::text('description', null, ['class' => 'form-control', 
													'disabled' => 'disabled', 
													'maxlength' => '255']) }}

				<div class="row">
					<div class="col-md-6">
						{{ Html::linkRoute('questionPosts.index', 'Cancel', array(), array('class' => 'btn btn-secondary btn-block form-spacing-top')) }}	
					</div>

					<div class="col-md-6">
						{{ Form::submit('更新', ['class' => 'btn btn-block btn-success form-spacing-top']) }}
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

