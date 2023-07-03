<?php

namespace Dayplayer\BackendModels\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'end_date' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'departments'=> ['required', 'min:1'],
            'production_type' => ['required', 'string'],
            'name' => ['required', 'string',  'max:150'],
            'departments.*.name' => ['required', 'string'],
            'departments.*.manager_name' => ['required', 'string'],
            'departments.*.manager_email' => ['required', 'email'],
        ];
    }
}
