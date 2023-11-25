<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    /* INICIALIZA UNA INSTANCIA CON VARAIBLE PRIVADA Y STATICA */
    private static $pruebaInstancia = NULL;

    /* CONSTRUCTOR PARA INICIALIZAR VARAIBLES */
    private function __construct() { 
    }

    /* METODO SINGLETON */
    public static function getInstance(){
        if (is_null(self::$pruebaInstancia)) {
            self::$pruebaInstancia = new self();
        }
        return self::$pruebaInstancia;
    }

    
    /* MUESTRA LOS DATOS DE LA TABLA */
    public function get(){
        try {
            $data = Person::get();
            return response()->json(['Resultados' => $data ],200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage(),500 ]);
        }
    }

    /* CREACION DE LOS DATOS */
    public function create(Request $req ){
        try {
            $data['name'] = $req['name'];
            $data['email'] = $req['email'];
            $data['address'] = $req['address'];
            $data['cellphone'] = $req['cellphone'];
            $resp = Person::create($data);
            return response()->json(['Se ha creado exitosamente' => $resp ] ,200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage(),500 ]);
        }
    }

    /* MODIFICACION DE LOS DATOS RECIBE EL ID  */
    public function update(Request $req, $id ){
        try {
            $data['name'] = $req['name'];
            $data['email'] = $req['email'];
            $data['address'] = $req['address'];
            $data['cellphone'] = $req['cellphone'];
            Person::find($id)->update($data);
            $resp = Person::find($id);
            return response()->json(['Se ha modificado exitosamente' => $resp ],200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage(),500 ]);
        }
    }

    /* ELIMINACION DEL REGISTRO POR ID */
    public function destroy($id){
        try {
            $resp = Person::find($id)->delete();
            return response()->json([ "Se ha eliminado exitosamente" => $resp ],200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage(),500 ]);
        }
    }
}

/* EJEMPLO, LA IDEA ES QUE EL PATRO SIGLENTON SOLO EXISTA UNA INSTANCIA DEL OBJETO EN 
TODO EL PROYECTO EN DONDE PODAMOS UTILIZAR DATOS Y FUNCIONALIDADES GLOBALES DE LA CLASE
MUY PARECIDO A UN HELPER */
//PersonController::getInstance()->get();