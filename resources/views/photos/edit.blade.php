<!DOCTYPE html>
<html>
<head><title>Edit Post</title></head>
<body>
   <h1>Edit Photo</h1>
    <form action="{{ route('photos.update', $photo) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <p>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title', $photo->title) }}">
        </p>
        <p>
            <label>Image:</label>
            <input type="file" name="image">
            <img src="{{ asset('storage/' . $photo->image) }}" width="100">
        </p>
        <button type="submit">Update</button>
    </form>
</body>
</html>