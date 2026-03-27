<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebPageController extends Controller
{
    public function index(){
        return view('index');
    }
    public function add(){}
    public function save(Request $request){}
    public function update(Request $reqeust , $id){}
    public function edit($id){}
    public function viewDelete($id){}
    public function delete($id){}
    public function landing(){
        return view('index');
    }
    public function viewPage($page){
        $data = \App\Models\web_page::where('slug' , $page)->first();
        return view('dynamic', ['data' => $data]);
    }
}
