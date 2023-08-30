<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }

    /**
     * Update the user's profile information.
     */

     public function update(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255', 'min: 4'],
            'email' => ['required', 'email', 'max:255', 'unique:'.User::class],
            'contrasenaactual' => ['required', 'string'],
            'nuevacontrasena' => ['required', 'string', Rules\Password::defaults()],
            'confirmarcontrasena' => ['required', 'string']
        ]);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator, 'profile')->withInput();
        }

        //Comprobación de las contraseñas
        //Nueva contraseña y confirmacion de contraseña
        if ($request->nuevacontrasena != $request->confirmarcontrasena)
        {
            return Redirect::back()->withErrors(['confirmarcontrasena' => 'La nueva contraseña no coincide con la confirmación'], 'profile')->withInput();
        }
        //Contraseña actual coincide con la contraseña del usuario
        if (!Hash::check($request->contrasenaactual, Auth::user()->password))
        {
            return Redirect::back()->withErrors(['nuevacontrasena' => 'La contraseña no coindice con su contraseña actual'], 'profile')->withInput();
        }
        //Contraseña actual no es igual a la nueva contraseña
        if (Hash::check($request->nuevacontrasena, Auth::user()->password))
        {
            return Redirect::back()->withErrors(['nuevacontrasena' => 'La nueva contraseña no puede ser igual a la contraseña actual'], 'profile')->withInput();
        }
        $user = Auth::user();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->nuevacontrasena);
        $user->save();
        return redirect('/');
     }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user == null)
        {
            return response('Unauthorized', 401);
        }
        $user->delete();
        return response('Deleted', 200);
    }
}
