# Common Laravel + PHP Error Messages

This document provides a quick reference for frequent **PHP** and **Laravel** error messages, their causes, and how to fix them.

---

## 🐘 Common PHP Errors

### 1. Undefined Variable
```
ErrorException: Undefined variable: user
```
**Cause:** Using a variable that was never defined or passed to the view.  
**Fix:** Pass the variable correctly:
```php
return view('profile', ['user' => $user]);
```

---

### 2. Undefined Index / Offset
```
Notice: Undefined index: name
```
**Cause:** Accessing an array key that doesn’t exist.  
**Fix:** Use null coalescing or `isset`:
```php
$name = $data['name'] ?? 'Guest';
```

---

### 3. Call to Undefined Function
```
Error: Call to undefined function someFunction()
```
**Cause:** Typo or missing import.  
**Fix:** Double-check spelling and include the correct file/namespace.

---

### 4. Class Not Found
```
Error: Class 'App\Http\Controllers\User' not found
```
**Cause:** Wrong namespace or missing `use`.  
**Fix:** Add the correct import:
```php
use App\Models\User;
```

---

### 5. Trying to Get Property of Non-Object
```
ErrorException: Trying to get property 'name' of non-object
```
**Cause:** `$user` is `null`.  
**Fix:** Add a null check:
```blade
{{ $user->name ?? 'No name' }}
```

---

## 🐇 Common Laravel Errors

### 1. Route Not Defined
```
Route [profile] not defined.
```
**Cause:** Calling a route that doesn’t exist.  
**Fix:** Define route with a name:
```php
Route::get('/profile', [UserController::class, 'show'])->name('profile');
```

---

### 2. SQL / Database Column Not Found
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'username'
```
**Cause:** Missing or misspelled DB column.  
**Fix:** Update migration and run:
```bash
php artisan migrate
```

---

### 3. MassAssignmentException
```
Add [name] to fillable property to allow mass assignment.
```
**Cause:** Model fields not listed in `$fillable`.  
**Fix:**
```php
protected $fillable = ['name', 'email', 'password'];
```

---

### 4. CSRF Token Mismatch
```
419 Page Expired
```
**Cause:** Missing CSRF token in form.  
**Fix:** Add in Blade:
```blade
<form method="POST" action="/submit">
    @csrf
</form>
```

---

### 5. View Not Found
```
InvalidArgumentException: View [profile] not found.
```
**Cause:** Blade template missing.  
**Fix:** Ensure file exists at:
```
resources/views/profile.blade.php
```

---

### 6. Target Class Does Not Exist
```
Target class [UserController] does not exist.
```
**Cause:** Typo or namespace mismatch.  
**Fix:** Check controller namespace and imports.

---

## 📖 References
- [Laravel Docs](https://laravel.com/docs)
- [PHP Manual](https://www.php.net/manual/en/)
- [StackOverflow: Laravel Errors](https://stackoverflow.com/questions/tagged/laravel)

---


---

## 🛠️ Common Debugging Tips & Commands

### Clear Config Cache
```bash
php artisan config:clear
```

### Clear Route Cache
```bash
php artisan route:clear
```

### Clear View Cache
```bash
php artisan view:clear
```

### Clear All Caches
```bash
php artisan optimize:clear
```

### Regenerate Autoload Files
```bash
composer dump-autoload
```

### Check Environment Variables
```bash
php artisan tinker
>>> env('APP_ENV')
```

### Run Database Migrations
```bash
php artisan migrate
```

### Rollback Last Migration
```bash
php artisan migrate:rollback
```

### Check Routes
```bash
php artisan route:list
```

---
