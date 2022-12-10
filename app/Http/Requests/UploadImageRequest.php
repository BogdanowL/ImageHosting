<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{

    public function data($picture)
    {
        return new UploadImageData($picture);
    }

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
