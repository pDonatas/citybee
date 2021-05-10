@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        .admin-card {
            width: 340px;
            height: 150px;
            background-size: cover;
            background-position: center;
            border-radius: 7px;
            transition: all 0.2s;
            position: relative;
            border: none;
            box-shadow: 0px 4px 11px rgba(0, 0, 0, 0.1);
        }

        .admin-card:hover {
            transform: scale(1.05);
        }

        .card-label {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 18px;
            font-weight: 600;
        }
    </style>
    <h3 class="mb-3">Admin dashboard</h3>
    <div style="width: 100px"></div>
    <a href="/admin/cars"><button class="admin-card mr-2" style="background-image: url(https://i.ibb.co/3mB9h4j/cars.png)">
            <div class="card-label">Cars</div>
        </button></a>
    <a href="/admin/users"><button class="admin-card" style="background-image: url(https://i.ibb.co/GvkVhXJ/users.png)">
            <div class="card-label">Users</div>
        </button></a>
</div>
@endsection
