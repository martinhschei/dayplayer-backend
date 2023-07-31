<?php

namespace Dayplayer\BackendModels\FormRequests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;
use Dayplayer\BackendModels\Helpers\HelperFunctions;

class StoreDepartmentJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'location' => ['nullable'],
            'to_date' => ['required', 'date'],
            'from_date' => ['required', 'date'],
            'position' => ['required', 'string'],
            'hourly_rate' => ['required', 'numeric'],
        ];
    }
}
