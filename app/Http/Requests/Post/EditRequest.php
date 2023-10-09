<?php

namespace App\Http\Requests\Post;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // option 3: authorize
        // $post = Post::find($this->post);
        // return  auth()->user()->id === $post->user_id;

        // option 4: authorize
        return Auth::user()->can('author', $this->post);
    }
}
