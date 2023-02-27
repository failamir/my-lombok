<?php

namespace App\Http\Requests;

use App\Models\Etalase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEtalaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('etalase_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
