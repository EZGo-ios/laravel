@extends('main')

@section('title', '| question_index')

@section('content')
  <div class="row form-spacing-top">
    <div class="col-md-10">
      <h1>題目資料</h1>
    </div>

    <a href="{{ route('logout') }}">Logout</a>
    
    <div class="col-md-2">
      <a href="{{ route('questionPosts.create') }}" class="btn btn-lg btn-block btn-primary btn-margin">新增</a>  
    </div>
  </div><!-- end of .row -->

  <table class="table form-spacing-top">
      <thead>
        <tr>
            <th scope="col">主題</th>
            <th scope="col">動物</th>
            <th scope="col">題目</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
        <tr>
          <td scope="row">{{ $question -> worksheet -> worksheet_name }}</td>
          <td scope="row">{{ $question -> animal -> animal_name }}</td>
          <td scope="row">{{ $question -> question }}</td>
          <td scope="row">
            {!! Form::open(['route' => 'questionPosts.show', 'method' => 'get']) !!}
                    {{ Form::hidden('question_id', $question -> question_id) }}
                    {{ Form::submit('查看', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
          </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="row justify-content-md-center">
      {{ $questions -> links() }}
    </div>

  

@endsection