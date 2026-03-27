<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bookings;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class BookingController extends Controller
{
    public function index(){
        $query = bookings::select('booking.*','users.name as user_name');
        $query->leftJoin('users','booking.user_id','=','users.id');
        $data = $query->get();
        return view('AdminDashboard.bookings.index',['data'=>$data]);
    }
    public function getBookingsById($id){
        $data = User::get();
        $booking = bookings::find($id);
        if(Auth::user()->user_type == 1){
            $view = 'AdminDashboard.bookings.addEdit';
        } else {
            $view = 'UserDashboard.bookings.addEdit';
        }
        return view($view,['data'=>$data,'booking'=>$booking]);
    }
    public function userBookings(){
        $query = bookings::select('booking.*','users.name as user_name');
        $query->where('booking.user_id' , Auth::user()->id);    
        $query->leftJoin('users','booking.user_id','=','users.id');
        $data = $query->get();
        return view('UserDashboard.bookings.index',['data'=>$data]);
    }
    public function add(){
        $data = User::get();
        if(Auth::user()->user_type == 1){
            $view = 'AdminDashboard.bookings.addEdit';
        } else {
            $view = 'UserDashboard.bookings.addEdit';
        }
        return view($view,['data'=>$data]);
    }
    public function save(Request $request){
        $booking = new \App\Models\bookings([
            'name' => $request->get('booking_name'),
            'Date_time' => $request->get('booking_on'),
            'status' => $request->get('booking_status'),
            'user_id' => Auth::user()->user_type == 1 ? $request->get('user_name') : Auth::id()
        ]);
        $booking->save();
        if(Auth::user()->user_type == 1){
            $route = 'booking.all';
        }else{
            $route = 'booking.my';
        }
        return redirect()->route($route);
    }
    public function updateBookingsById(Request $request , $id){
        $booking = bookings::find($id);
        $booking->name = $request->get('booking_name');
        $booking->Date_time = $request->get('booking_on');
        $booking->status = $request->get('booking_status');
        $booking->user_id = Auth::user()->user_type == 1 ? $request->get('user_name') : Auth::id();
        $booking->save();
        if(Auth::user()->user_type ==1){
            $route = 'booking.all';
        }else{
            $route = 'booking.my';
        }
        return redirect()->route($route);
    }
    public function viewDelete($id){
        $booking = bookings::find($id);
        if(Auth::user()->user_type ==1){
            $view = 'AdminDashboard.bookings.delete';
        }else{
            $view = 'UserDashboard.bookings.delete';
        }
        return view($view, compact('booking'));
    }
    public function delete($id){
        $status = bookings::where('id',$id)->delete();
        if(Auth::user()->user_type ==1){
            $route = 'booking.all';
        }else{
            $route = 'booking.my';
        }
        return redirect()->route($route);
    }

}