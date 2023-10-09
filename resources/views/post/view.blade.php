<x-app-layout>
    <x-slot name="header">
        <x-header title="View Post" />
    </x-slot>

    @if (Auth::user()->id === $post->user_id)
        <a href="{{ route('posts.edit', $post->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            Edit Post
        </a>

        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <x-danger-button type="submit">Delete Post</x-danger-button>
        </form>
    @endif

    <h1>
        <strong>
            {{ $post->title }}
        </strong>
    </h1>

    <small style="float: right">
        <p>Authored by: {{ $post->user->name }}</p>
        <p>Published at: {{ $post->created_at->format('F d, Y') }}</p>
    </small>

    <br>

    <h2>Body:</h2>
    <p style="border: 1px solid blue">{{ $post->body }}</p>

    <br>

    <h2>Comments:</h2>
    <form action="{{ route('comments.store') }}" method="post">
        @csrf

        <input type="hidden" value="{{ $post->id }}" name="post_id">
        <x-text-input name="comment" value="{{ old('comment') }}" required/>
        @error('comment')
            <p>{{ $message }}</p>
        @enderror

        <x-primary-button type="submit">Add comment</x-primary-button>
    </form>

    <ul style="border: 1px solid green">
        @foreach ($comments as $comment)
            <li style="margin: 1%">
                <strong>{{ $comment->user->name }}:</strong>
                {{ $comment->comment }}
                <span style="float: right">
                    {{ $comment->created_at->diffForHumans() }}
                </span>

                @can('delete', $comment)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <x-danger-button type="submit">Delete</x-danger-button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>

    {{ $comments->links() }}
</x-app-layout>