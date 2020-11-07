<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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

        $id = (int) $this->get('id');

        if ($this->method() == 'PUT') {
            $name = 'required|unique:tags,name,' . $id;
            $slug = 'unique:tags,slug,' . $id;
        } else {
            $name = 'required|unique:tags,name,NULL,id';
            $slug = 'unique:tags,slug';
        }

        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
