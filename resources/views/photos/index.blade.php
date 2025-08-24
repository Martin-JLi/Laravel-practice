<!DOCTYPE html>
<html>
<head>
    <title>Photos</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
   <h1>Photos</h1>
    <a href="{{ route('photos.create') }}">Add New Photo</a>

    @foreach ($photos as $photo)
        <div>
            <h2>{{ $photo->title }}</h2>
            <img src="{{ asset('storage/' . $photo->image) }}" width="150">
            <a href="{{ route('photos.edit', $photo) }}">Edit</a>
            <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach

    {{ $photos->links() }}

    
</body>
</html>
