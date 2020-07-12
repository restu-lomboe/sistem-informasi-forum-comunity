<?php

namespace App\Http\Requests\Pertanyaan;

use Illuminate\Foundation\Http\FormRequest;

class PertanyaanUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul' => 'required',
            'isi' => 'required',
            'user_id' => 'required'
        ];
    }

    public function attributes() {
        return [
            'user_id' => Auth::user()->id
        ];
    }
}
