@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{isset($car) ? 'Edit car' : 'Add car'}}</h2>
    <form action="{{isset($car) ? '/editCar/'.$id : '/addCar'}}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-6">
                <label for="model">Model</label>
                <input required type="text" value="{{isset($car) ? $car->model : ''}}" name="model" class="form-control" id="model">
            </div>
            <div class="form-group col-6">
                <label for="year">Year</label>
                <input type="number" value="{{isset($car) ? $car->year : ''}}" name="year" class="form-control" id="year">
            </div>
            <input type="hidden" name="status" value="ok">
            <input type="hidden" name="registration_date" value='{{date("Y-m-d")}}'>

        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="pay_per_minute">Pay per minute</label>
                <input required type="number" value="{{isset($car) ? $car->pay_per_minute : ''}}" name="pay_per_minute" class="form-control" id="pay_per_minute">
            </div>
            <div class="form-group col-6">
                <label for="number_plate">Number plate</label>
                <input required type="number" name="number_plate" value="{{isset($car) ? $car->number_plate : ''}}" class="form-control" id="number_plate">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="main-end">Maintainance end</label>
                <input required type="date" name="maintenance_end" value="{{isset($car) ? $car->maintenance_end : ''}}" class="form-control" id="main-end">
            </div>
            <div class="form-group col-6">
                <label for="insur-end">Insurance end</label>
                <input required type="date" name="insurance_end" value="{{isset($car) ? $car->insurance_end : ''}}" class="form-control" id="insur-end">
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col-6">
                <label for="reg-nr">Registration certificate number</label>
                <input required type="number" name="registration_certificate_number" value="{{isset($car) ? $car->registration_certificate_number : ''}}" class="form-control" id="reg-nr">
            </div>
        </div>


        <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary btn-lg" style="width: 200px;">Submit</button></div>

    </form>
</div>
@endsection
