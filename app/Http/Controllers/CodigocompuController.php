<?php

namespace App\Http\Controllers;

use App\Models\codigocompu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CodigocompuController extends Controller
{

    /*public function crearcodigo($usuario)
    {
        $codigo_1 = rand(100000, 999999);
        $codigo_2 = null;
        $codigo = new codigocompu();
        $codigo->user_id = intval($usuario);
        $codigo->codigo_cel = $codigo_1;
        $codigo->codigo_compu = $codigo_2;
        $codigo->save();
        
    }*/

    public function GenCoMovil(Request $request)
    {
        $code_mobil = $request->codigo;

        $codes = codigocompu::where('active', true)->get();

        foreach ($codes as $code) {
            if (Hash::check($code_mobil, $code->codigo)) {

                $code->active = false;

                $code->save();

                $num = random_int(100000, 999999);

                codigocompu::create([
                    'codigo' => Hash::make($num),
                    'active' => true,
                    'user_id' => $code->user_id,
                ]);

                return response()->json($num, 200);
            }
        }
        return response()->json('EL CODIGO NO ES VALIDO', 400);
        
    }
    public function GenCoCompu(Request $request)
    {
        $code_web = $request->code;

        $codes = codigocompu::where('active', true)->get();

        foreach ($codes as $code) {
            if (Hash::check($code_web, $code->codigo)) {

                $code->active = false;

                $code->save();

                Cookie::queue('codigo', $code_web);

                return redirect('dashboard');
            }
        }
        Session::flash('alert-danger', 'CODIGO NO VALIDO');
        return redirect()->back();
    }
    
}
