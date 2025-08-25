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


# 🚀 Laravel Query Optimization

A quick reference guide for writing **efficient and optimized queries** in Laravel.

---

## 📖 Table of Contents
1. [Select Only What You Need](#1️⃣-select-only-what-you-need)  
2. [Use Where Conditions](#2️⃣-use-where-conditions)  
3. [Eager Loading Relationships](#3️⃣-eager-loading-relationships)  
4. [Pagination](#4️⃣-pagination)  
5. [Chunking for Large Datasets](#5️⃣-chunking-for-large-datasets)  
6. [Avoid Unnecessary get()](#6️⃣-avoid-unnecessary-get)  
7. [Use Database Indexes](#7️⃣-use-database-indexes)  
8. [Caching Results](#8️⃣-caching-results)  
9. [Debug Queries](#9️⃣-debug-queries)  
10. [Summary of Best Practices](#🔟-summary-of-best-practices)  

---

## 1️⃣ Select Only What You Need

```php
// Only fetch specific columns instead of all (*)
$photos = Photo::select('id', 'title', 'path')->get();
```

✅ Reduces memory usage and query size.

---

## 2️⃣ Use Where Conditions

```php
$photos = Photo::where('user_id', 5)
               ->where('status', 'published')
               ->get();
```

⚡ Filter data at the database level.

---

## 3️⃣ Eager Loading Relationships

### ❌ N+1 Problem:
```php
$photos = Photo::all();
foreach ($photos as $photo) {
    echo $photo->user->name; // triggers extra query per photo
}
```

### ✅ Solution:
```php
$photos = Photo::with('user')->get();
foreach ($photos as $photo) {
    echo $photo->user->name; // only 2 queries
}
```

- Use nested eager loading: `with('user.address')`.

---

## 4️⃣ Pagination

```php
$photos = Photo::paginate(10); // only 10 per page
```

🔹 Avoid `all()` for large datasets.

---

## 5️⃣ Chunking for Large Datasets

```php
Photo::chunk(100, function($photos) {
    foreach ($photos as $photo) {
        // process 100 rows at a time
    }
});
```

🔹 Keeps memory usage low.

---

## 6️⃣ Avoid Unnecessary `get()`

```php
// ❌ Inefficient
$count = count(Photo::where('user_id', 5)->get());

// ✅ Efficient
$count = Photo::where('user_id', 5)->count();
```

---

## 7️⃣ Use Database Indexes

```php
$table->index('user_id');
```

🔹 Add indexes on columns used in `where`, `orderBy`, or `join`.

---

## 8️⃣ Caching Results

```php
$photos = Cache::remember('photos_all', 60, function() {
    return Photo::all();
});
```

🔹 Avoid repeated database hits for common queries.

---

## 9️⃣ Debug Queries

```php
// Get SQL query
$query = Photo::where('user_id', 5);
dd($query->toSql());

// Listen to queries
DB::listen(function ($query) {
    logger($query->sql, $query->bindings, $query->time);
});
```

---

## 🔟 Summary of Best Practices

| Technique                  | When to Use                                   |
|-----------------------------|-----------------------------------------------|
| `select()`                  | Fetch only necessary columns                  |
| `where()` / `whereIn()`     | Filter at DB level                            |
| `with()` (eager loading)    | When accessing relationships in loops         |
| Pagination / chunking       | Large datasets                                |
| Aggregates (`count`, `sum`) | Avoid unnecessary `get()`                     |
| Indexes                     | Frequently filtered or joined columns         |
| Caching                     | Repeated heavy queries                        |
| Debugging                   | Detect slow or N+1 queries                    |

---

### ⭐ Pro Tips
- Always **profile your queries** with `DB::listen` or tools like **Laravel Telescope**.  
- Use **queues + chunking** for batch jobs.  
- Index smartly — don’t over-index (slows inserts/updates).  

---

📌 Keep this cheat sheet handy while building apps in Laravel to avoid slow queries and memory issues.
