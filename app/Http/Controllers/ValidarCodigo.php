<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\codigocompu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ValidarCodigo extends Controller
{
    public function SignedRoute(Request $request)
    {
        // verificar la firma de la URL
        if (!$request->hasValidSignature()) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            // return redirect('/');

            abort(401, 'Expiro la URL');
        }

        $num = random_int(100000, 999999);

        $user = Auth::user();

        $code = codigocompu::create([
            'codigo' => Hash::make($num),
            'active' => true,
            'user_id' => $user->id,
        ]);

        $code->save();

        return view('codigocel', ['data' => $num]);
    }
}
