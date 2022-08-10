<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title:en'      =>      'required|string|max:100',
            'content:en'    =>      'required|string|max:100',
            'title:ar'      =>      'required|string|max:100',
            'content:ar'    =>      'required|string|max:100',
            'image'         =>      'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent'        =>      'required',

        ];
    }
}
