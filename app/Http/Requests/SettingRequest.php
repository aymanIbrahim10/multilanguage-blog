<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                'title:en'          =>      'required|string|max:100',
                'describtion:en'    =>      'required|string|max:100',
                'title:ar'          =>      'required|string|max:100',
                'describtion:ar'    =>      'required|string|max:100',
                'favicon'           =>      'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'logo'              =>      'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'facebook'          =>      'required|string|max:100',
                'instagram'         =>      'required|string|max:100',
                'email'             =>      'required|email|unique:settings,email,'.$this -> id,
                'phone'             =>      'required|string',
        ];
    }
}
