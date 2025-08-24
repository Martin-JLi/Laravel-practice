<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <h1>All Posts</h1>
    <div class="top-search">
        <a href="/posts/create">Create New Post</a>

        <form action="{{ url('/posts') }}" method="GET" class="search">
            <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}"
                class="border p-2 rounded">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="post-container">
        @foreach($posts as $post)
        <div class="post-inner">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <div class="buttons">
                <a href="/posts/{{ $post->id }}/edit" class="text-green-600 hover:underline mr-2">Edit</a>
                <form action="/posts/{{ $post->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</body>
</html>
