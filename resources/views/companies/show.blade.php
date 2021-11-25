@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="container">
            <h1 class="display-4">{{ $company->name}}
                <a href="{{ route('users.index') }}" class="btn btn-dark btn-sm">
                    Volver
                </a>
            </h1>
            <div class="card" >
                <table class="table">
                    <tr>
                        <th>Email</th>
                        <td>{{ $company->email }}</td>
                    </tr>
                    <tr>
                        <th>Actualizado</th>
                        <td>{{ $company->updated_at }}</strong></td>
                    </tr>
                    <tr>
                        <th>Creado</th>
                        <td>{{ $company->created_at }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
