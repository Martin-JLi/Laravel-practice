<!DOCTYPE html>
<html>
<head><title>Create Post</title></head>
<body>
    <h1>Add Photo</h1>
    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title') <p>{{ $message }}</p> @enderror
        </p>
        <p>
            <label>Image:</label>
            <input type="file" name="image">
            @error('image') <p>{{ $message }}</p> @enderror
        </p>
        <button type="submit">Save</button>
    </form>
</body>
</html>
