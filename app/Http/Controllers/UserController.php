<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bookings;
use App\Models\web_page;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index(){
        $data = User::get();
        return view('AdminDashboard.Users.index',['data'=>$data]);
    }
    public function add(){
        return view('AdminDashboard.Users.addEdit');
    }
    public function save(Request $request){
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone_no' => $request->get('phone_no'),
            'password' => \Illuminate\Support\Facades\Hash::make($request->get('password')),
            'user_type' => $request->get('user_type')
        ]);
        $user->save();
        return redirect()->route('login');
    }
    public function update(Request $request , $id){
        $user = User::find($id);    
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone_no = $request->get('phone_no');
        $user->user_type = $request->get('user_type');
        $user->save();
        return redirect()->route('User.my');
    }
    public function edit($id){
        $data = User::find($id);
        return view('AdminDashboard.User.addEdit' , ['data' => $data]);
    }
    public function viewDelete($id){
        return view('AdminDashboard.User.delete');
    }
    public function delete($id){
        User::where('id', $id)->delete();
        return redirect()->route('User.my');
    }
    public function landing(){}
    public function WebPage(){}
    public function getProfile(){
        $data = User::find(Auth::user()->id);
        if(Auth::user()->user_type == 1){
            $view = 'AdminDashboard.profile.index';
        }else{
            $view = 'UserDashboard.profile.index';
        }
        return view($view , ['data' => $data]);
    }
    public function saveProfile(Request $request){
        $user = User::find(Auth::user()->id);    
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone_no = $request->get('phone_no');
        $user->save();
        return redirect()->route('user.profile.get');
    }
    public function adminDashboard(){
        $data['totalUsers'] = 0;
        $data['adminUsers'] = 0;
        $data['clientUsers'] = 0;
        $data['totalBookings'] = 0;
        $data['completedBookings'] = 0;
        $data['totalWebpages'] = 0;
        $data['activeWebpages'] = 0;

        $data['totalUsers'] = User::count();
        $data['adminUsers'] = User::where('user_type' , 1)->count();
        $data['clientUsers'] = User::where('user_type' , 2)->count();
        $data['totalBookings'] = bookings::count();
        $data['completedBookings'] = bookings::where('status' , 3)->count();
        $data['totalWebpages'] = web_page::count();
        $data['activeWebpages'] = web_page::where('status' , 1)->count();
        return view('AdminDashboard.index' , ['data' => $data]);
    }
    public function userDashboard(){
        $data['totalBookings'] = bookings::where('user_id' , Auth::user()->id)->count();
        $data['completedBookings'] = bookings::where('user_id' , Auth::user()->id)->where('status' , 3)->count();
        $data['pendingBookings'] = bookings::where('user_id' , Auth::user()->id)->where('status' , 1)->count();
        $data['cancelledBookings'] = bookings::where('user_id' , Auth::user()->id)->where('status' , 4)->count();
        return view('UserDashboard.index' , ['data' => $data]); 
    }
}
