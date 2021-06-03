@extends('layout.main')
@section('main')
<section class="content">
    <div class="card card-outline card-success">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-success firtsave">
                    <i class="fas fa-save"></i> Guardar</button>
                <a href="{{ route('cliente.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo</a>
                <a href="{{ route('cliente.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Salir</a>
            </div>
        </div>
        <form id="store_send">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{ $nombre }}">
                                    <span for="nombre" class="error invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documento_identidad">Documento de Identidad</label>
                                    <input type="text" class="form-control" name="documento_identidad"
                                        value="{{ $documento }}">
                                    <span for="documento_identidad" class="error invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <textarea class="form-control" name="direccion" rows="4" cols="50"></textarea>
                                    <span for="direccion" class="error invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn_add"
                                        style="margin-top:16%">Agregar</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-8">
                                <table class="table table-responsive table_direccion">
                                    <thead>
                                        <tr>
                                            <th>Dirección</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($table))
                                        @foreach($table As $row)
                                        <tr>
                                            <td>{{ $row->direccion }}</td>
                                            <td>
                                                <button type='button' class='btn btn-danger drop_row'>Eliminar</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success firtsave">
                            <i class="fas fa-save"></i> Guardar</button>
                        <a href="{{ route('cliente.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo</a>
                        <a href="{{ route('cliente.index') }}" class="btn btn-danger">
                            <i class="fas fa-times"></i> Salir</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('jquery')
<script>
$(".firtsave").click(function() {
    var id = $("input[name='id']").val();

    $.ajax({
        type: "POST",
        url: "{{ route('cliente.store') }}",
        data: {
            nombre: $("input[name='nombre']").val(),
            documento_identidad: $("input[name='documento_identidad']").val(),
            table: TablaJSON(),
            id: id
        },
        beforeSend: function() {},
        error: function(data) {
            console.log(data.responseJSON.message)
        },
        success: function(data) {
            alert("Registro Ingresado");
            window.location.href = "{{ route('cliente.index') }}"
        },
        complete: function(data) {
            //console.log(data)
        }
    })
});
$(".table_direccion").on("click", ".drop_row", function() {
    $(this).closest("tr").remove();
});

$(".btn_add").click(function() {
    var direccion = $("textarea[name='direccion']").val();
    if (direccion != "") {
        add_row(direccion);
        $("textarea[name='direccion']").val('');
    } else {
        alert("Favor ingresar una dirección para registrar");
    }
})

function add_row(direccion) {
    var button = "<button type='button' class='btn btn-danger drop_row'>Eliminar</button>";
    var html = "<tr><td>" + direccion + "</td>" +
        "<td>" + button + "</td></tr>";
    $('.table_direccion > tbody:last-child').append(html);
}

function TablaJSON() {
    jsonObj = [];
    $('.table_direccion tbody tr').each(function() {
        item = {}
        item["direccion"] = $(this).find('td').eq(0).html();
        jsonObj.push(item);
    });
    return jsonObj;
}
</script>
@endsection