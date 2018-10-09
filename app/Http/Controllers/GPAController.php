<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GPAController extends Controller {

  public function show($id){
    $gpa = \DB::table('gpa')->find($id);

    return view('gpa.show', compact('gpa'));
  }

  public function index(){
    $gpa = \DB::table('gpa')->latest()->get();

    return view('gpa.index', compact('gpa'));
  }

  public function register(){
    return view('gpa.register');
  }

  public function calculate(){
    $gpa = \DB::table('gpa')->latest()->get();

    return view('gpa.calculate', compact('gpa'));
  }

  public function admin(){
    $gpa = \DB::table('gpa')->latest()->get();

    return view('gpa.admin', compact('gpa'));
  }

  public function adminStudent(){
    $gpa = \DB::table('gpa')->latest()->get();

    return view('gpa.adminStudent', compact('gpa'));
  }


  public function crudStudent(){
    $gpa = \DB::table('gpa')->latest()->get();

    return view('gpa.crudStudent', compact('gpa'));
  }

  public function crudCollege(){
    $gpa = \DB::table('gpa')->latest()->get();

    return view('gpa.crudCollege', compact('gpa'));
  }

  public function edit(){
    $gpa = \DB::table('gpa')->latest()->get();
    $checkEdit = 1;
    return view('gpa.adminStudent', compact('gpa'));
  }

}
