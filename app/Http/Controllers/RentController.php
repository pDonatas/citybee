<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\RentSession;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    public function showRentWindow($id){
        DB::table('cars')
            ->where('id', $id)
            ->update(['status' => 'Reserved']);
        $reserved_car = Car::find($id);
        return view('rent.rent_window',[
            'car' => $reserved_car
        ]);
    }
    public function startRent($id){
        $time = Carbon::now();
        $start_time = $time->toDateTimeString();
        $car = Car::find($id);
        $location = $car->current_location;
        $userId = Auth::user();
        $rent_session = new RentSession( ['start_time' => $start_time, 'start_address' => $location]);
        $rent_session->car()->associate($car);
        $rent_session->user()->associate($userId);
        $rent_session->save();
        DB::table('cars')
            ->where('id', $id)
            ->update(['status' => 'Rented']);
        $rented_car = Car::find($id);
        return view('rent.rent_window',[
            'car' => $rented_car,
            'start_time' => $start_time
        ]);

    }
    public function endRent($id){
        $time = Carbon::now();
        $end_time = $time->toDateTimeString();
        $car = Car::find($id);
        $location = $car->current_location;
        $userId = Auth::id();
        DB::table('rent_sessions')
            ->where('user_id',$userId)
            ->where('car_id' ,$id)
            ->whereNull('end_time')
            ->update(['end_time' => $end_time, 'end_address' => $location]);
        DB::table('cars')
            ->where('id', $id)
            ->update(['status' => 'Available']);
        $rented_car = Car::find($id);
        $rent_session = RentSession::firstWhere('end_time', $end_time);
        $start_time = $rent_session->start_time;

        Carbon::parse($start_time);
        $diff_in_minutes = $time->diffInMinutes($start_time);
        $price = $diff_in_minutes*$rented_car->pay_per_minute;
        DB::table('rent_sessions')
            ->where('user_id',$userId)
            ->where('car_id' ,$id)
            ->where('end_time', $end_time)
            ->update(['price' => $price]);

        $wallet = Wallet::where("userId", $userId)->first();
        $currentAmount = $wallet->amount;
        $wallet->amount =  $currentAmount - $price;
        $wallet->save();

        return view('rent.rent_window',[
            'car' => $rented_car,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'minutes' => $diff_in_minutes,
            'price' => $price
        ]);
    }
    public function showTripsHistory()
    {
        $user_trips = DB::table('rent_sessions')
            ->where('user_id', Auth::id())
            ->get();
        $cars = DB::table('cars')->get();
        return view('trips_history.my_trips',[
            'trips' => $user_trips,
            'cars' => $cars
        ]);
    }
}
