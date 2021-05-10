@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Admin dashboard</h3>
    <div style="width: 100px"></div>
    <a href="/admin/cars"><button class="btn btn-primary btn-lg">Cars</button></a>
    <a href="/admin/users"><button class="btn btn-primary btn-lg">Users</button></a>
</div>
@endsection
