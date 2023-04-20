<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidImportFileExtension implements Rule
{

    public function passes($attribute, $value)
    {
        $allowedExtensions = ['pdf', 'doc', 'docx', 'xlsx'];
        $fileExtension = strtolower($value->getClientOriginalExtension());
        return in_array($fileExtension, $allowedExtensions);
    }

    public function message()
    {
        return trans('The file must be a PDF, DOC, or XLSX file.');
    }
}
