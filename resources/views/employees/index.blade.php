@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <div class="col-md-12">
                    <h2>
                        <a href="employees/create">
                            <button type="button" class="btn btn-success btn-sm btn-block float-right">
                                Registrar
                            </button>
                        </a>
                    </h2>
                </div>
            </div>
            <div class="card-header">
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar"  name="search" type="search" placeholder=Search
                               aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <h6>
                    @if($search)
                        <div class="alert-default-primary" role="alert">
                            Los resultados para tu busqueda '{{$search}}' son:
                        </div>
                    @endif
                </h6>
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Compañia</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <th scope="row">{{$employee->id}}</th>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->lastName}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->company->name}}</td>
                            <td>{{$employee->phone}}</td>
                            <td>
                                <form action= "{{ route('employees.destroy',  $employee->id)}}" method = "POST">
                                    <a href="{{route('employees.show', $employee->id) }}">
                                        <button type="button" class="btn btn-dark btn-sm">
                                            Ver
                                        </button>
                                    </a>
                                    <a href="{{ route('employees.edit', $employee->id) }}">
                                        <button type="button" class="btn btn-primary btn-sm">
                                            Editar
                                        </button>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" btn-sm btn btn-danger" role="button" >Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="mx-auto">
                        {{ $employees->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
