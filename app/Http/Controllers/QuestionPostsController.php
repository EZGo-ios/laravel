<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\Question;
use App\Question_option;
use App\Question_description;
use App\Worksheet;
use Session;

class QuestionPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $questions = Question::Orderby('question_id', 'desc') -> paginate(10);
         return view('pages/data_manage/question/index') -> withQuestions($questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::all();
        $ani = [];
        foreach ($animals as $animal) {
            $ani[$animal -> animal_id] = $animal -> animal_name;
        }

        $worksheets = Worksheet::all();
        $works = [];
        foreach ($worksheets as $worksheet) {
            $works[$worksheet -> worksheet_id] = $worksheet -> worksheet_name;
        }

        $descriptions = Question_description::all();
        $descrip = [];
        foreach ($descriptions as $description) {
            $descrip[$description -> description_id] = $description -> description;
        }


        return view('pages/data_manage/question/create') -> withAni($ani) 
                                                         -> withAnimals($animals)
                                                         -> withWorks($works)
                                                         -> withDescrip($descrip);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $request->validate([
            'animal_name' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);

        // -- post --
        $questionPost = new Question;
        if($request -> worksheet == null) {
            $questionPost -> worksheet_id = $request -> worksheet_name;
        } else {
            $newWorksheet = new Worksheet;
            $newWorksheet -> worksheet_name = $request -> worksheet;
            $newWorksheet -> save();

            $worksheetId = Worksheet::where('worksheet_name', $request -> worksheet) -> first();
            $questionPost -> worksheet_id = $worksheetId -> worksheet_id;
        }

        $questionPost -> animal_id = $request -> animal_name;
        $questionPost -> question = $request -> question;
        $questionPost -> answer = $request -> answer;
        $questionPost -> question_id = $questionPost -> max('question_id') + 1;

        if($request -> description == null) {
            $questionPost -> description_id = $request -> existDesc;
        } else {
            $description = new Question_description;
            $description -> description = $request -> description;
            $description -> save();
            $descriptionId = Question_description::where('description', $request -> description) 
                                                -> first();
            $questionPost -> description_id = $descriptionId -> description_id;
        }

        $questionPost -> save();

        for ($i = 1; $i <= 4; $i++) {            
            $selection = "selection_".$i;
            if($request -> $selection == null)
                break;
            $newOption = new Question_option;
            $newOption -> question_id = Question::max('question_id');
            $newOption -> option_id = $i;
            $newOption -> qOption = $request -> $selection;
            $newOption -> save();         
        }

        Session::flash('success', 'this post was sucessfully saved');
        return redirect()->route('questionPosts.index');       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($question_id)
    {
        $questionData = Question::where('question_id', $question_id) -> first();
        $optionData = Question_option::where('question_id', $question_id) -> get();

        return view('pages/data_manage/question/show') 
            -> withQuestionData($questionData)
            -> withOptionData($optionData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question_id)
    {
        $questionData = Question::where('question_id', $question_id) -> first();
        $optionData = Question_option::where('question_id', $question_id) -> get();

        $animals = Animal::all();
        $ani = [];
        foreach ($animals as $animal) {
            $ani[$animal -> animal_id] = $animal -> animal_name;
        }

        $worksheets = Worksheet::all();
        $works = [];
        foreach ($worksheets as $worksheet) {
            $works[$worksheet -> worksheet_id] = $worksheet -> worksheet_name;
        }

        $descriptions = Question_description::all();
        $descrip = [];
        foreach ($descriptions as $description) {
            $descrip[$description -> description_id] = $description -> description;
        }

        return view('pages/data_manage/question/edit')
            -> withQuestionData($questionData)
            -> withOptionData($optionData)
            -> withAni($ani)
            -> withWorks($works)
            -> withDescrip($descrip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $question = Question::where('question_id', $request -> question_id) -> first();
        $question -> worksheet_id = $request -> worksheet_name;
        $question -> animal_id = $request -> animal_name;

        if($request -> description == null) {
            $question -> description_id = $request -> existDesc;
        } else {
            $description = new Question_description;
            $description -> description = $request -> description;
            $description -> save();
            $descriptionId = Question_description::where('description', $request -> description) 
                                                -> first();
            $question -> description_id = $descriptionId -> description_id;
        }

        $question -> question = $request -> question;
        $question -> answer = $request -> answer;
        $question -> save();

        $option = Question_option::where('question_id', $request -> question_id) -> delete();
        for ($i = 1; $i <= 4; $i++) {            
            $qOption = "qOption_".$i;
            if($request -> $qOption == null)
                break;
            $newOption = new Question_option;
            $newOption -> question_id = $request -> question_id;
            $newOption -> option_id = $i;
            $newOption -> qOption = $request -> $qOption;
            $newOption -> save();         
        }
        
        Session::flash('success', 'this post was sucessfully saved');
        return redirect()->route('questionPosts.show', $request -> question_id);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remove = Question::where('question_id', $id);
        $remove -> delete();

        $removeOption = Question_option::where('question_id', $id);
        $removeOption -> delete();

        Session::flash('success', 'this post was sucessfully deleted');
        return redirect()->route('questionPosts.index');
    }
}
