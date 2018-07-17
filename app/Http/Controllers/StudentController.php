<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  /**
  * search the blog
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function search(Request $request)
  {

    //$search = $request->get('keyword');

    //return view('search', compact('search'));
    $search = $request->get('keyword');

    $searchResults = Student::where('Badge', '=', $search)
    ->orWhere('NationalID', '=', $search)
    ->orWhere('Batch', 'LIKE', '%'.$search.'%')
    ->orWhere('Stream', 'LIKE', '%'.$search.'%')
    ->orWhere('Status', 'LIKE', '%'.$search.'%')
    ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
    ->orWhere('LastName', 'LIKE', '%'.$search.'%')
    ->orWhere('StudentNo', 'LIKE', '%'.$search.'%')
    ->paginate(5);

    return view('search',compact('searchResults','search'));

  }


  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $student = Student::findOrFail($id);
    return view('student.show',compact('student'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
