@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="container">
            <h1 class="display-4">{{ $employee->name}}
                <a href="{{ route('employees.index') }}" class="btn btn-dark btn-sm">
                    Volver
                </a>
            </h1>
            <div class="card" >
                <table class="table">
                    <tr>
                        <th>Email</th>
                        <td>{{ $employee->email }}</td>
                    </tr>
                    <tr>
                        <th>Compañia</th>
                        <td>{{$employee->company->name}}</td>
                    </tr>
                    <tr>
                        <th>Actualizado</th>
                        <td>{{ $employee->updated_at }}</strong></td>
                    </tr>
                    <tr>
                        <th>Creado</th>
                        <td>{{ $employee->created_at }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
