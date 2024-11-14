<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TodoListRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'list.text' => 'required|string|max:4000',
            'list.expired_at' => 'nullable|date'
        ];
    }
}
