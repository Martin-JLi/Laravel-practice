<!DOCTYPE html>
<html>
<head><title>Create Post</title></head>
<body>
    <h1>Create a Post</h1>
    <form action="/posts" method="POST">
        @csrf
        <p>
            <label>Title:</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </p>

        <p>
            <label>Content:</label><br>
            <textarea name="content">{{ old('content') }}</textarea>
            @error('content')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </p>
        <button type="submit">Save</button>
    </form>
</body>
</html>
