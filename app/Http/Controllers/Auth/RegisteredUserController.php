<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'sesso' => ['nullable', 'string', 'in:M,F'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'data_di_nascita' => ['nullable', 'date'],
            'luogo_di_nascita' => ['nullable', 'string', 'max:255'],
            'codice_fiscale' => ['nullable', 'string', 'max:16', 'min:16', 'unique:'.User::class],
            'contatto_emergenza' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'cognome' => $request->cognome,
            'sesso' => $request->sesso,
            'telefono' => $request->telefono,
            'data_di_nascita' => $request->data_di_nascita,
            'luogo_di_nascita' => $request->luogo_di_nascita,
            'codice_fiscale' => $request->codice_fiscale,
            'contatto_emergenza' => $request->contatto_emergenza,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
