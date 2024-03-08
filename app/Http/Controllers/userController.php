<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class userController extends Controller
{
    //
    // use PasswordValidationRules;

    /**
     * Validate and create a newly user.
     *
     * @param  array<string, string>  $input
     */

    public function home() {
        $user = User::all();
        return view('home', compact('user'));
    }

    public function createClient(Request $request)
    {
        $dataValid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'max:255'],
            'birthday' => ['required', 'date', 'max:10'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => 'required|min:8',
        ]);

          // Hasher le mot de passe
          $dataValid['password'] = bcrypt($dataValid['password']);

        // return User::create([
        //     'name' => $input['name'],
        //     'firstname' => $input['firstname'],
        //     'age' => $input['age'],
        //     'birthday' => $input['birthday'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        // ]);

        // Créer un nouvel utilisateur
        User::create($dataValid);

        return back()->with( 'success', 'Client Ajouté');
    }
}
