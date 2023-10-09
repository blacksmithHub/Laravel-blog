@props(['posts'])

<ul>
    @foreach ($posts as $post)
        <li style="border: 1px solid red; margin: 1%">
            <h1>
                <a href="{{ route('posts.show', $post->id) }}">
                    {{ $post->title }}
                </a>
            </h1>
            <p>{{ optional($post->user)->name }}</p>
            <p>{{ $post->created_at->diffForHumans() }}</p>
        </li>
    @endforeach
</ul>

{{ $posts->links() }}