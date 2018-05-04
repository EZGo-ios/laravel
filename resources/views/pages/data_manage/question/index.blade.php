@extends('main')

@section('title', '| question_index')

@section('stylesheets')
    {!! Html::style('css/jeff_css/question_css/style.css') !!}
    {!! Html::style('css/jeff_css/myCSS.css') !!}
@endsection

@section('content')
    <div class="row form-spacing-top">
        <div class="col-md-2">
            <a href="/" class="btn btn-lg btn-block btn-primary btn-margin">返回</a>  
        </div>

        <div class="col-md-8">
            <h1>題目資料</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('questionPosts.create') }}" class="btn btn-lg btn-block btn-primary btn-margin">新增</a>
        </div>
    </div><!-- end of .row -->

    <table>
        <thead class = "tbl-header">
            <tr>
                <th scope="col">主題</th>
                <th scope="col">動物</th>
                <th scope="col">題目</th>
                <th></th>
            </tr>
        </thead>
        <tbody class = "tbl-content">
            @foreach ($questions as $question)
                <tr>
                    <td scope="row">{{ $question -> worksheet -> worksheet_name }}</td>
                    <td scope="row">{{ $question -> animal -> animal_name }}</td>
                    <td scope="row">
                        <!-- 中文字佔3byte -->
                        {{ substr($question -> question, 0, 30) }}
                        {{ strlen($question -> question) > 30 ? "..." : "" }}

                    </td>
                    <td scope="row">
                        <a href="{{ Route('questionPosts.show', $question -> question_id) }}" class="btn btn-primary">查看</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row justify-content-md-center">
        {{ $questions -> links() }}
    </div>
@endsection