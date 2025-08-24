# Laravel CRUD Cheat Sheet

## 1️⃣ Routes & Controllers

-   Create resource controller: `php artisan make:controller PostController --resource`
-   Register resource routes: `Route::resource('posts', PostController::class);`

**Resource routes generated:**

| Verb      | URI              | Action           | Controller Method |
| --------- | ---------------- | ---------------- | ----------------- |
| GET       | /posts           | List all posts   | index()           |
| GET       | /posts/create    | Show form        | create()          |
| POST      | /posts           | Save new post    | store()           |
| GET       | /posts/{id}      | Show single post | show()            |
| GET       | /posts/{id}/edit | Edit form        | edit()            |
| PUT/PATCH | /posts/{id}      | Update post      | update()          |
| DELETE    | /posts/{id}      | Delete post      | destroy()         |

---

## 2️⃣ Eloquent Model Basics

```php
class Post extends Model
{
    protected $fillable = ['title', 'content'];
}
```

-   `$fillable` allows mass assignment.
-   `Post::query()` starts a query builder.
-   `Post::all()` fetches all records.
-   `Post::find($id)` fetches a single record by primary key.

### Common Eloquent Queries

```php
// Get all posts
$posts = Post::all();

// Get posts with condition
$posts = Post::where('title', 'like', '%Laravel%')->get();

// Order posts
$posts = Post::orderBy('created_at', 'desc')->get();

// Limit
$posts = Post::limit(10)->get();

// Paginate
$posts = Post::paginate(5);

// Select specific columns
$posts = Post::select('id', 'title')->get();
```

### Create / Update / Delete

```php
// Create new post
Post::create(['title' => 'New', 'content' => 'Body']);

// Update
$post->update(['title' => 'Updated']);

// Delete
$post->delete();
```

---

## 3️⃣ Blade Syntax

```blade
<!-- Display variable -->
{{ $post->title }}

<!-- Loop -->
@foreach($posts as $post)
    {{ $post->title }}
@endforeach

<!-- Validation error for a field -->
@error('title')
    <div style="color:red;">{{ $message }}</div>
@enderror
```

-   `{{ old('field') }}` repopulates form input on validation failure.

---

## 4️⃣ Forms

```blade
<form action="/posts" method="POST">
    @csrf
    <input type="text" name="title" value="{{ old('title') }}">
    <textarea name="content">{{ old('content') }}</textarea>
    <button type="submit">Save</button>
</form>
```

-   `@csrf` protects against Cross-Site Request Forgery.
-   Form `action` + `method="POST"` maps to `store()`.

---

## 5️⃣ Validation (Controller)

```php
$validated = $request->validate([
    'title' => 'required|string|max:255',
    'content' => 'required|string',
]);
```

-   Use `required` for mandatory fields.
-   Use `nullable` for optional fields.

---

## 6️⃣ Debugging Tools

-   `dd($var)` → Dump and die.
-   `dump($var)` → Dump without stopping.
-   `Log::info('message', [...])` → Write to storage/logs/laravel.log.
-   Optional: Debugbar or Telescope packages.

### Common Error Tip

-   `Attempt to read property "title" on array` → you have an array instead of an Eloquent model. Use `$photo['title']` or fetch model correctly.

---

## 7️⃣ Quick Tips

-   `::` → static method / constant (e.g., `Post::all()`).
-   `->` → instance method or property (e.g., `$post->title`).
-   Use `compact('variable')` to pass variables to Blade: `view('photos.index', compact('photos'))`.
-   Always check if query returns Collection (loop) or single Model (access properties).
-   Run `php artisan route:list` to see all routes and methods.

---

**This cheat sheet covers the essential Laravel CRUD workflow for your skills evaluation.**
