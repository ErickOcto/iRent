<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|string',
            'brand_id' => 'required',
            'type_id' => 'required',
            'features' => 'max:255|required',
            'price' => 'numeric|required',
            'star' => 'numeric|required',
            'review' => 'numeric|required',
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:png,jpg,webp,jpeg',
        ];
    }
}
