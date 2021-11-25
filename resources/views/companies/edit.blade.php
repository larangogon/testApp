@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Editar compañia: {{ $company->name }}</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('users.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">
                                    Nombre
                                </label>
                                <input type="text" class="form-control" name="name" value="{{ $company->name}}" placeholder ="escribe tu nombre">
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="email" class="form-control"
                                       name="email" value="{{ $company->email}}" placeholder ="escribe tu email">
                            </div>

                            <div class="form-group">
                                <label for="name">
                                    Logo
                                </label>
                                <input type="text" class="form-control" name="name" value="{{ $company->logo}}" placeholder ="escribe tu nombre">
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    website
                                </label>
                                <input type="email" class="form-control"
                                       name="email" value="{{ $company->email}}"
                                       placeholder ="escribe tu email">
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">
                                Guardar
                            </button>

                            <button type="reset" class="btn btn-danger btn-sm">
                                Cancelar
                            </button>

                            <a href="{{ route('companies.index') }}" class="btn btn-dark btn-sm">
                                Volver
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
