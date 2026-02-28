## $${\color{red}WordPress \ Sage \ Cheat \ Sheet}$$

*(Theme framework by Roots)*

Sage is a modern WordPress starter theme built with Laravel-like architecture, Blade templating, and modern frontend tooling.

---

### 1️⃣ Install Sage

### Requirements

* PHP (latest stable)
* Composer
* Node.js (LTS)
* WordPress

### Create Project (Sage 10)

```bash
composer create-project roots/sage my-theme
cd my-theme
npm install
npm run dev
```

Activate theme in **WP Admin → Appearance → Themes**

---

### 2️⃣ Project Structure (Sage 10)

```
my-theme/
├── app/                # PHP logic
│   ├── setup.php
│   ├── filters.php
│   ├── helpers.php
│   └── View/
├── resources/
│   ├── views/          # Blade templates
│   ├── scripts/        # JS
│   ├── styles/         # CSS / SCSS
│   └── images/
├── public/             # Compiled assets
├── config/             # Theme config
├── functions.php
├── vite.config.js
```

---

### 3️⃣ Blade Templating (Laravel-style)

### Layout

`resources/views/layouts/app.blade.php`

```blade
<!doctype html>
<html {!! get_language_attributes() !!}>
  <head>
    @include('partials.head')
  </head>
  <body @php(body_class())>
    @yield('content')
    @include('partials.footer')
  </body>
</html>
```

### Template Example

`resources/views/index.blade.php`

```blade
@extends('layouts.app')

@section('content')
  <h1>{{ get_the_title() }}</h1>
  {!! the_content() !!}
@endsection
```

### Include Partial

```blade
@include('partials.header')
```

---

### 4️⃣ Asset Management (Vite)

### Dev

```bash
npm run dev
```

### Build Production

```bash
npm run build
```

### Load Assets

In `app/setup.php`:

```php
add_action('wp_enqueue_scripts', function () {
    \Roots\bundle('app')->enqueue();
}, 100);
```

---

### 5️⃣ App Container & Service Providers

Sage uses Laravel-style container.

### Register Custom Service Provider

Create:

```
app/Providers/ThemeServiceProvider.php
```

Register in:

```
config/app.php
```

---

### 6️⃣ View Composers (Pass Data to Views)

Create:

```
app/View/Composers/Post.php
```

Example:

```php
namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
    protected static $views = ['partials.content'];

    public function with()
    {
        return [
            'author' => get_the_author(),
        ];
    }
}
```

Use in Blade:

```blade
{{ $author }}
```

---

### 7️⃣ WordPress Hooks in Sage

### Setup (app/setup.php)

```php
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    register_nav_menus([
        'primary' => __('Primary Navigation'),
    ]);
});
```

### Filters

`app/filters.php`

```php
add_filter('excerpt_length', fn() => 20);
```

---

### 8️⃣ Config Files (config/)

### Example: config/theme.php

```php
return [
    'assets' => [
        'version' => null,
    ],
];
```

Access:

```php
config('theme.assets.version');
```

---

### 9️⃣ Acorn (Laravel Integration)

Sage 10 runs on **Acorn**

Features:

* Service container
* Blade
* Service providers
* View composers
* Laravel helpers

CLI:

```bash
wp acorn
```

---

### 🔟 Tailwind (Optional but Common)

Install:

```bash
npm install -D tailwindcss
npx tailwindcss init
```

Import in:

```
resources/styles/app.css
```

---

### 1️⃣1️⃣ Custom Post Types (CPT)

Inside `app/setup.php`:

```php
add_action('init', function () {
    register_post_type('project', [
        'label' => 'Projects',
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
    ]);
});
```

---

### 1️⃣2️⃣ Sage Template Hierarchy

Blade versions:

```
single.blade.php
page.blade.php
archive.blade.php
front-page.blade.php
404.blade.php
```

WP hierarchy still applies.

---

### 1️⃣3️⃣ Useful Commands

| Command                  | Purpose              |
| ------------------------ | -------------------- |
| `npm run dev`            | Start dev server     |
| `npm run build`          | Production build     |
| `composer install`       | Install PHP deps     |
| `wp acorn`               | Run Acorn CLI        |
| `wp acorn make:composer` | Create view composer |

---

### 1️⃣4️⃣ Production Tips

* Use `.env` for environment variables
* Enable caching
* Run `npm run build`
* Optimize images
* Disable dev server in production

---

### 1️⃣5️⃣ Sage vs Classic WP Theme

| Classic Theme            | Sage                      |
| ------------------------ | ------------------------- |
| PHP templates            | Blade templates           |
| functions.php heavy      | App container             |
| No dependency management | Composer                  |
| Manual asset enqueue     | Vite bundling             |
| Basic structure          | Laravel-like architecture |

---

# 🧠 Quick Mental Model

Sage =
**WordPress + Laravel structure + Blade + Vite**
