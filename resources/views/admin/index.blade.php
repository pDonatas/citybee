@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Admin dashboard</h3>
    <a href="/admin/cars"><button class="btn btn-primary btn-lg">Cars</button></a>
    <a href="/admin/users"><button class="btn btn-primary btn-lg">Users</button></a>
    <a href="/admin/incidents"><button class="btn btn-primary btn-lg">Incidents</button></a>
</div>
@endsection
