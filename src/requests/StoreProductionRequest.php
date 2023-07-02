<?php

namespace Dayplayer\BackendModels;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'end_date' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'departments'=> ['required', 'min:1'],
            'payment_method' => ['required', 'string'],
            'production_type' => ['required', 'string'],
            'name' => ['required', 'string',  'max:150'],
            'departments.*.name' => ['required', 'string'],
            'departments.*.manager_name' => ['required', 'string'],
            'departments.*.manager_email' => ['required', 'email'],
        ];
    }
}