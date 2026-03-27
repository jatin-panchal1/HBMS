<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bookings;
use App\Models\web_page;
class UserController extends Controller
{
    public function index(){}
    public function add(){}
    public function save(Request $request){}
    public function update(Request $reqeust , $id){}
    public function edit($id){}
    public function viewDelete($id){}
    public function delete($id){}
    public function landing(){}
    public function WebPage(){}
    public function getProfile(){}
    public function saveProfile(){}
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
    public function userDashboard(){}
}
