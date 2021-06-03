@extends('layout.main')
@section('main')

<section class="content">
    <div class="card card-outline card-success">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('cliente.create') }}" class="btn btn-success">Nuevo Cliente</a>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="card-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Documento Identidad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($table As $row)
                            <tr>
                                <td>{{ $row->id}}</td>
                                <td>{{ $row->nombre}}</td>
                                <td>{{ $row->documento_identidad}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('cliente.edit', $row->id)}}"
                                                class="btn btn-primary btn-block">Editar
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <form action="{{ route('cliente.destroy', $row->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-block">Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection