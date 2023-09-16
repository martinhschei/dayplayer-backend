<?php

namespace Dayplayer\BackendModels\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'to_date' => ['required', 'date'],
            'from_date' => ['required', 'date'],
            'position' => ['required', 'string'],
            'hourly_rate' => ['required', 'numeric'],
        ];
    }
}
