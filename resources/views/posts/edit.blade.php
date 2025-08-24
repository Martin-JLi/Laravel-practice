<!DOCTYPE html>
<html>
<head><title>Edit Post</title></head>
<body>
    <h1>Edit Post</h1>
    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')
        <p>
            <label>Title:</label><br>
            <input type="text" name="title" value="{{ $post->title }}">
        </p>
        <p>
            <label>Content:</label><br>
            <textarea name="content">{{ $post->content }}</textarea>
        </p>
        <button type="submit">Update</button>
    </form>
</body>
</html>