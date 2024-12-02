<?php

namespace App\Http\Controllers;

use App\Profesionales;
use App\Zonas_atencion;
use DB;
use Input;
use Storage;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfesionalesController extends Controller
{
    // Crear un Registro (Create)

    public function crear()
    {
        $profesionales = Profesionales::all();
        $zonasAtencion = Zonas_atencion::all();
        
        return view('profesionales.crear', ['profesionales'=>$profesionales, 'zonasAtencion'=>$zonasAtencion]);
    }

    // Proceso de Creación de un Registro

    public function store(Request $request)
    {
        \Log::info($request->all()); // Loguea todos los datos recibidos

        // Instancio al modelo profesionales que hace llamado a la tabla 'profesionales' de la Base de Datos
        $profesionales = new Profesionales; 
    
        // Recibo todos los datos del formulario de la vista 'crear.blade.php'
        $profesionales->nombre = $request->nombre;        
        $profesionales->apellido = $request->apellido;
        $profesionales->dni = $request->dni;

        $profesionales->matricula_nacional = $request->matricula_nacional;
        $profesionales->matricula_provincial = $request->matricula_provincial;
        $profesionales->email = $request->email;
        $profesionales->telefono = $request->telefono;
        $profesionales->celular = $request->celular;

        $profesionales->zona_atencion_id = $request->zona_atencion_id;
        $profesionales->especialidad = $request->especialidad; 
        $profesionales->tipo_cirugias = $request->tipo_cirugias;
        $profesionales->quirofano = $request->quirofano;
        $profesionales->lugar_operacion = $request->lugar_operacion;
        $profesionales->radio_movilidad = $request->radio_movilidad;
        $profesionales->cobertura = $request->cobertura;
        $profesionales->horario_atencion = $request->horario_atencion;

        $profesionales->archivo_1 = $request->archivo_1;
        $profesionales->archivo_2 = $request->archivo_2;
        $profesionales->archivo_3 = $request->archivo_3;
        $profesionales->archivo_4 = $request->archivo_4;
        $profesionales->archivo_5 = $request->archivo_5;
        $profesionales->archivo_6 = $request->archivo_6;
        
        // Almacenos la imagen en la carpeta publica especifica
        //$profesionales->img = $request->file('img')->store('/');

        \Log::info('12');

        // Validar el archivo
        $request->validate([
            'archivo_1' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', // Máximo 5MB
            'archivo_2' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200',  
            'archivo_3' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', 
            'archivo_4' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', 
            'archivo_5' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', 
            'archivo_6' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', 
        ]);

        \Log::info('3');

        // Almacenar el archivo
        if ($request->hasFile('archivo_1')) {
            $path = $request->file('archivo_1')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_1 = $path;


            \Log::info('$path');
            \Log::info($path);

            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_2')) {
            $path = $request->file('archivo_2')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_2 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_3')) {
            $path = $request->file('archivo_3')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_3 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_4')) {
            $path = $request->file('archivo_4')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_4 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_5')) {
            $path = $request->file('archivo_5')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_5 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_6')) {
            $path = $request->file('archivo_6')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_6 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }



        //return back()->withErrors(['archivo' => 'Error al subir el archivo.']);
    
        // Inserto todos los datos en mi tabla 'profesionales'
        
        \Log::info('4');

        $profesionales->save();
    
        // Hago una redirección a la vista principal con un mensaje 
        return redirect('profesionales')->with('message','Guardado Satisfactoriamente !');
    }


    // Leer Registros (Read) 
 
    public function index(Request $request)
    {
        // Obtener todas las zonas de atención (ajusta esto según tu modelo)
        $zonas = Zonas_atencion::all(); // Asegúrate de tener este modelo y su respectiva tabla

        // Iniciar la consulta para obtener profesionales
        $query = Profesionales::where('borrado', 0)->with('zonaAtencion');

        // Filtrar por zona de atención si se ha enviado un parámetro
        if ($request->has('zona_atencion') && $request->zona_atencion != '') {
            $query->where('zona_atencion_id', $request->zona_atencion);
        }

        // Obtener los profesionales filtrados
        $profesionales = $query->get();

        \Log::info($profesionales); // Para depuración

        // Pasar tanto los profesionales como las zonas a la vista
        return view('profesionales.index', compact('profesionales', 'zonas'));
    }

    
    //  Actualizar un registro (Update)
 
    public function actualizar(Request $request, $id)
    {

        //\Log::info($id);

        $profesionales = Profesionales::where('borrado', 0)
            ->where('id', $id)
            ->with('zonaAtencion') // Carga la relación 'zonaAtencion'
            ->get();
            
            
        \Log::info($profesionales);
        \Log::info('$profesionales');

        $zonasAtencion = Zonas_atencion::all();
        
        return view('profesionales.actualizar', ['profesionales'=>$profesionales[0], 'zonasAtencion'=>$zonasAtencion]);

        //return view('profesionales.actualizar',['profesionales'=>$profesionales[0], 'zona_atencion' => $profesionales[0]->zonaAtencion]);
    }



    public function update(Request $request, $id)
    {           
        // Recibo todos los datos desde el formulario Actualizar
        $profesionales = Profesionales::find($id);

        /*$profesionales = Profesionales::with('zonaAtencion') // Cargar las zonas atencion
            ->where('borrado', 0) // Filtrar profesionales por borrado
            ->where('id', $id)
            ->get();*/

        \Log::info($request->all()); // Loguea todos los datos recibidos

        \Log::info('paso por aca');

        \Log::info($profesionales); // Loguea todos los datos recibidos

        $profesionales->nombre = $request->nombre;        
        $profesionales->apellido = $request->apellido;
        $profesionales->dni = $request->dni;

        $profesionales->matricula_nacional = $request->matricula_nacional;
        $profesionales->matricula_provincial = $request->matricula_provincial;
        $profesionales->email = $request->email;
        $profesionales->telefono = $request->telefono;
        $profesionales->celular = $request->celular;

        $profesionales->zona_atencion_id = $request->zona_atencion_id;
        $profesionales->especialidad = $request->especialidad; 
        $profesionales->tipo_cirugias = $request->tipo_cirugias;
        $profesionales->quirofano = $request->quirofano;
        $profesionales->lugar_operacion = $request->lugar_operacion;
        $profesionales->radio_movilidad = $request->radio_movilidad;
        $profesionales->cobertura = $request->cobertura;
        $profesionales->horario_atencion = $request->horario_atencion;

        \Log::info('2 rere');
        // Validar el archivo
        $request->validate([
            'archivo_1' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', // Máximo 5MB
            'archivo_2' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200',  
            'archivo_3' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', 
            'archivo_4' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', 
            'archivo_5' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', 
            'archivo_6' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:51200', 
        ]);

        \Log::info('3 fdf');

        // Almacenar el archivo
        if ($request->hasFile('archivo_1')) {
            $path = $request->file('archivo_1')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_1 = $path;


            \Log::info('$path');
            \Log::info($path);

            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_2')) {
            $path = $request->file('archivo_2')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_2 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_3')) {
            $path = $request->file('archivo_3')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_3 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_4')) {
            $path = $request->file('archivo_4')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_4 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_5')) {
            $path = $request->file('archivo_5')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_5 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }

        if ($request->hasFile('archivo_6')) {
            $path = $request->file('archivo_6')->store('uploads', 'public'); // Almacena en storage/app/public/uploads
            $profesionales->archivo_6 = $path;
            //return back()->with('success', 'Archivo subido exitosamente.');
        }
    
        // Recibo la imagen desde el formulario Actualizar
        /*if ($request->hasFile('img')) {
            $$profesionales->img = $request->file('img')->store('/');
        }*/

        \Log::info('4 fdfd');
        
        // Actualizo los datos en la tabla '$profesionales'
        $profesionales->save();
    
        // Muestro un mensaje y redirecciono a la vista principal 
        Session::flash('message', 'Editado Satisfactoriamente !');
        return Redirect::to('profesionales');
    }


    public function eliminar($id)
    {
        // Indicamos el 'id' del registro que se va Eliminar
        $profesionales = Profesionales::find($id);
    
        // Elimino la imagen de la carpeta 'uploads', esto lo veremos más adelante
        /*$imagen = explode(",", $profesionales->img);
        Storage::delete($imagen);*/
            
        // Elimino el registro de la tabla 'profesionales' 
        //Profesionales::destroy($id);

        $profesionales->borrado = 1; // seteo el campo borrado en 1, borrado logico
        $profesionales->save();
            
        // Muestro un mensaje y redirecciono a la vista principal 
        Session::flash('message', 'Eliminado Satisfactoriamente !');
        return Redirect::to('profesionales');
    }
    
    



}
