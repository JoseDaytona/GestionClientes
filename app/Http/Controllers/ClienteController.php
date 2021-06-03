<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cliente;
use App\Model\ClienteDireccion;

class ClienteController extends Controller
{
    public function index()
    {
        $table = Cliente::all();
        return view("cliente.consulta", compact("table"));
    }

    public function create()
    {
        $id = null;
        $nombre = null;
        $documento = null;
        $table = null;
        return view("cliente.registrar", compact("id", "nombre", "documento", "table"));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $nombre = $cliente->nombre;
        $documento = $cliente->documento_identidad;
        $table = ClienteDireccion::where("id_cliente", $id)->get();
        return view("cliente.registrar", compact("id", "nombre", "documento", "table"));
    }

    public function store(Request $request)
    {
        $id = !empty($request->get('id')) ? $request->get('id') : 0;

        $cliente = Cliente::updateOrCreate([
            'id' => $id
            ], [
            'nombre' => $request->get('nombre'),
            'documento_identidad' => $request->get('documento_identidad'),
        ]);

        $id = $cliente->id;

        ClienteDireccion::where('id_cliente', $id)->delete();

        if(!empty($request->table))
        {
            foreach ($request->table as $obj) {

                $direccion = $obj['direccion'];

                ClienteDireccion::create([
                    'id_cliente' => $id,
                    'direccion' => $direccion
                ]);
            }     
        }
    }

    public function destroy($id)
    {
        Cliente::where("id", $id)->delete();
        ClienteDireccion::where("id_cliente", $id)->delete();
        return redirect("cliente/");
    }
}
