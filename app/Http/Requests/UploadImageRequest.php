<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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

    public function rules()
    {
        return [
            'images.*' => 'image|mimes:png,jpg,jpeg,gif,svg',
            'images' => 'max:5',
        ];
    }

    public function messages() {
        return [
            'images.*.mimes' => 'Only jpeg, png, bmp,tiff files are allowed.',
            'images.max' => 'Only 5 images are allowed'
        ];
    }
}
