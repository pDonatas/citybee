<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $cars = DB::table('cars')->get();
        return view('admin.cars', [
            'cars' => json_encode($cars)
        ]);
    }

    public function addCar()
    {
        Car::create($_POST);
        return redirect("/admin/cars");
    }

    public function editCar($id)
    {
        unset($_POST["_token"]);
        Car::where("id", $id)->update($_POST);
        return redirect("/admin/cars");
    }

    public function deleteCars()
    {
        $ids = explode(",", $_POST["ids"]);

        foreach ($ids as $id) {
            Car::where("id", intval($id))->delete();
        }

        return redirect("/admin/cars");
    }

    public function showAddCar()
    {
        return view("admin.car_form");
    }

    public function showEditCar($id)
    {
        $car = DB::table("cars")->where("id", "=", $id)->first();
        return view("admin.car_form", [
            "car" => $car,
            "id" => $id
        ]);
    }
}
