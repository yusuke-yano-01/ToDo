<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if (in_array($this->method(), ['POST', 'PUT', 'PATCH'])) {
            $rules['content'] = ['required', 'string', 'max:20'];
        }
        if ($this->ismethod('DELETE')) { 
            $rules['id'] = ['required', 'integer', 'exists:todos,id'];
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'id.required' => 'idを指定してください',
            'id.integer' => 'idは数字で入力してください',
            'id.exists:todos,id' => 'idがありません',
            'content.required' => 'Todoを入力してください',
            'content.string' => 'Todoを文字列で入力してください',
            'content.max' => 'Todoを20文字以下で入力してください',
        ];
    }
}
