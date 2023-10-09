<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => [
                'required',
                'string',
                'max:100'
            ],
            'user_id' => [
                'required',
                'numeric',
                'exists:users,id'
            ],
            'post_id' => [
                'required',
                'numeric',
                'exists:posts,id',
                // Rule::exists('posts', 'id')
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // $this->user()->id
            'user_id' => Auth::user()->id // auth()->user()->id
        ]);
    }
}
