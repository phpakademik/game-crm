<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilialUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'description'=>'required|string',
            'logo'=>'file|image',
            'location'=>'required|string',
            'status'=>'required|string',
        ];
    }
}