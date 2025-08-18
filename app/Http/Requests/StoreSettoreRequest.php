<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Solo gli admin possono fare questa richiesta
        return $this->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Qui mettiamo le nostre regole, una sola volta!
        return [
            'nome' => 'required|string|max:255',
            'numero_file' => 'required|integer|min:1',
            'posti_per_fila' => 'required|integer|min:1',
        ];
    }
}
