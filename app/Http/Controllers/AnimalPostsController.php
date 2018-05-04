<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Animal;
use App\Location;
use Session;

class AnimalPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::Orderby('animal_id', 'desc') -> paginate(10);
        
        return view('pages/data_manage/animal/index') -> withAnimals($animals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/data_manage/animal/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'animal_name' => 'required|max:255',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);


        $location = new Location;
        $location -> lng =  $request -> lng;
        $location -> lat =  $request -> lat;
        $location -> save();

        $animal = new Animal;
        $animal -> animal_name = $request -> animal_name;
        $animal -> location_id = Location::select('location_id')->max('location_id');
        $animal -> save();

        Session::flash('success', '新增成功！！');
        return redirect()->route('animalPosts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($animal_id, $location_id)
    {
        $animalData = Animal::where('animal_id', $animal_id) -> where('location_id', $location_id) -> first();
        return view('pages/data_manage/animal/show') -> withAnimalData($animalData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $animalData = Animal::where('animal_id', $request -> animal_id) -> where('location_id', $request -> location_id) -> first();
        return view('pages/data_manage/animal/edit') -> withAnimalData($animalData);
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
        // validate the data
        $request->validate([
            'animal_name' => 'required|max:255',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $location = Location::where('location_id', $request -> location_id)->first();
        $location -> lng =  $request -> lng;
        $location -> lat =  $request -> lat;
        $location -> save();

        $animal = Animal::where('animal_id', $request -> animal_id) -> where('location_id', $request -> location_id) -> first();
        $animal -> animal_name = $request -> animal_name;
        $animal -> save();

        Session::flash('success', 'this post was sucessfully saved');
        return redirect()->route('animalPosts.show', [$request -> animal_id, $request -> location_id]);

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $animal = Animal::where('animal_id', $request -> animal_id) -> where('location_id', $request -> location_id) -> first();
        $animal -> delete();
        $location = Location::where('location_id', $request -> location_id) -> first();
        $location -> delete();
        
        Session::flash('success', 'this post was sucessfully deleted');
        return redirect()->route('animalPosts.index');
    }
}
