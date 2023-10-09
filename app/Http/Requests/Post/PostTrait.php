<?php

namespace App\Http\Requests\Post;

trait PostTrait
{
    protected function defaultRules()
    {
        return [
            'title' => [
                'required',
                'string',
                'max:20'
            ],
            'body' => [
                'required',
                'string',
                'max:300'
            ]
        ];
    }
}
