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
            'jobs.*.id' => ['nullable'],
            'jobs.*.location' => ['nullable'],
            'jobs.*.to_date' => ['required', 'date'],
            'jobs.*.from_date' => ['required', 'date'],
            'jobs.*.position' => ['required', 'string'],
            'jobs.*.hourly_rate' => ['required', 'numeric'],
        ];
    }
}
