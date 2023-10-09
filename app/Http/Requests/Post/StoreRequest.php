<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    use PostTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = $this->defaultRules();

        $rules = array_merge($rules, [
            'user_id' => [
                'required',
                'numeric',
                'exists:users,id'
            ]
        ]);

        return $rules;

        // return [
        //     'title' => [
        //         'required',
        //         'string',
        //         'max:20'
        //     ],
        //     'body' => [
        //         'required',
        //         'string',
        //         'max:300'
        //     ],
        //     'user_id' => [
        //         'required',
        //         'numeric',
        //         'exists:users,id',
        //         // Rule::exists('users', function () {
        //         // })
        //     ]
        // ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id // auth()->user()->id
        ]);
    }
}
