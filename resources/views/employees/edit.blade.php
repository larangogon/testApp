@extends('layouts.app')

@section('content')
    <div class="container mt-4 text-center">
        <a class="btn btn-primary" href="{{ route('employees.index')}}">Employees</a>
        <a class="btn btn-danger" href="{{ url('/')}}">Crear</a>
    </div>
    <div class="row ">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <form-employee-update-component>
@endsection
