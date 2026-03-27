<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\web_page;
use Illuminate\Support\Facades\Auth;

class WebPageController extends Controller
{
    public function index(){
        $data = web_page::where('status',1)->get();
        return view('AdminDashboard.WebPage.index',['data'=>$data]);
    }
    public function add(){
        return view('AdminDashboard.WebPage.addEdit');
    }
    public function save(Request $request){
        $page = new web_page([
            'name' => $request->get('page_name'),
            'slug' => $request->get('page_slug'),
            'html' => $request->get('page_content') ,
            'status' => $request->get('status'),
            'created_by' => Auth::user()->user_type ,
        ]);
        $page->save();
        return redirect()->route('WebPage.my');
        
    }
    public function update(Request $request , $id){
        $page = web_page::find($id);
        $page->name = $request->get('page_name');
        $page->slug = $request->get('page_slug');
        $page->html = $request->get('page_content');
        $page->status = $request->get('status');
        $page->created_by = Auth::user()->id;
        $page->save();
        return redirect()->route('WebPage.my');
    }
    public function edit($id){}
    public function viewDelete($id){
        return view('AdminDashboard.WebPage.delete');
    }
    public function delete($id){
        web_page::where('id',$id)->delete();
    }
    public function landing(){
        return view('index');
    }
    public function viewPage($page){
        $data = \App\Models\web_page::where('slug' , $page)->first();
        return view('dynamic', ['data' => $data]);
    }
}
