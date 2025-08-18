<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'sesso' => ['nullable', 'string', 'in:M,F'],
            'data_di_nascita' => ['nullable', 'date'],
            'luogo_di_nascita' => ['nullable', 'string', 'max:255'],
            'codice_fiscale' => ['nullable', 'string', 'max:16', 'min:16'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'contatto_emergenza' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}
