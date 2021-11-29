@extends('layouts.app')

@section('content')
    <div class="container mt-4 text-center">
        <a class="btn btn-primary" href="{{ route('employees.index')}}">Employees</a>
        <a class="btn btn-danger" href="{{ url('/')}}">Crear</a>
    </div>

    <form-employee-show-component>
@endsection
