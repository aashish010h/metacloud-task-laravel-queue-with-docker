<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
           'excelFile'=>['required','file','mimes:csv,txt,xlsx,xls']
        ];
    }
}
