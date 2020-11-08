<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            $slug = 'unique:posts,slug,' . $id;
            $image = 'image|mimes:jpeg,png,jpg,gif|max:4096';
        } else {
            $slug = 'unique:posts,slug';
            $image = 'required|image|mimes:jpeg,png,jpg,gif|max:4096';
        }
        $title = 'required';
        $content = 'required';

        return [
            'title' => $title,
            'slug' => $slug,
            'image' => $image,
            'content' => $content,
            'category_id' => 'required',
            'tag_id' => 'required',
            'status' => 'required',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required',
            'tag_id.required' => 'The tag field is required'
        ];
    }
}
