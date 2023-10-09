<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\DestroyRequest;
use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(StoreRequest $request)
    {
        $validatedRequest = $request->validated();

        DB::beginTransaction();

        try {
            $comment = Comment::create($validatedRequest);
            // $comment = Comment::create($validatedRequest);
            // $comment = Comment::create($validatedRequest);
            // $comment = Comment::create($validatedRequest);
            // $comment = Comment::create($validatedRequest);

            // send email notification to post author
            $comment->post->user->notify(new CommentNotification($comment->user, $comment->post_id));

            DB::commit();

            return redirect()->route('posts.show', Arr::get($validatedRequest, 'post_id')); // $validatedRequest['post_id']
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    public function destroy(DestroyRequest $request, Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
