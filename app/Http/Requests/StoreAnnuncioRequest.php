<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnnuncioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Solo gli admin possono creare/modificare annunci
        return $this->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Mettiamo qui le regole che prima erano nel controller
        return [
            'titolo' => 'required|string|max:255',
            'contenuto' => 'required|string',
            'in_evidenza' => 'nullable', // Il checkbox non ha bisogno di regole complesse
        ];
    }
}
