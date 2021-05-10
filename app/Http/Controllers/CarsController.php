<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarsController extends Controller
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
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
    public function showAvailableCars()
    {
        $available_cars = DB::table('cars')->where('status', '=', 'available')->get();
        return view('cars.available_cars', [
            'cars' => $available_cars
        ]);
    }

    public function showAllCarsForAdmin()
    {
        if (Auth::user()->role == 2) {
            $cars = DB::table('cars')->get();
            return view('admin.cars', [
                'cars' => json_encode($cars)
            ]);
        } else {
            return redirect("/");
        }
    }

    public function addCar()
    {
        if (Auth::user()->role == 2) {
            Car::create($_POST);
            return redirect("/admin/cars");
        } else {
            return redirect("/");
        }
    }

    public function editCar($id)
    {
        if (Auth::user()->role == 2) {
            unset($_POST["_token"]);
            Car::where("id", $id)->update($_POST);
            return redirect("/admin/cars");
        } else {
            return redirect("/");
        }
    }

    public function deleteCars()
    {
        if (Auth::user()->role == 2) {
            $ids = explode(",", $_POST["ids"]);

            foreach ($ids as $id) {
                Car::where("id", intval($id))->delete();
            }

            return redirect("/admin/cars");
        } else {
            return redirect("/");
        }
    }

    public function showAddCar()
    {
        if (Auth::user()->role == 2) {
            return view("admin.car_form");
        } else {
            return redirect("/admin/cars");
        }
    }

    public function showEditCar($id)
    {
        if (Auth::user()->role == 2) {
            $car = DB::table("cars")->where("id", "=", $id)->first();
            return view("admin.car_form", [
                "car" => $car,
                "id" => $id
            ]);
        } else {
            return redirect("/admin/cars");
        }
    }
}
