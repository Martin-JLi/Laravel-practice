<!DOCTYPE html>
<html>
<head>
    <title>Photos</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <h1>All Photos</h1>
   
    @foreach($photos as $photo)
        {{$photo}}
    @endforeach
    
</body>
</html>
