<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pet Adoption') · Pet Adoption</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 960px; margin: 0 auto; padding: 0 16px 40px; color: #2d2a26; background: #fffaf5; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 18px 0; border-bottom: 1px solid #eadfd3; margin-bottom: 24px; }
        header nav a { margin-left: 16px; }
        a { color: #b4541a; }
        .logo { font-weight: 800; font-size: 20px; text-decoration: none; color: #2d2a26; }
        .button { display: inline-block; background: #b4541a; color: #fff; border: 0; border-radius: 8px; padding: 8px 14px; text-decoration: none; cursor: pointer; font-size: 15px; }
        .button.light { background: #f1e4d8; color: #2d2a26; }
        .flash { background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 8px; padding: 10px 14px; }
        .error { color: #b91c1c; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; }
        .card { background: #fff; border: 1px solid #eadfd3; border-radius: 12px; padding: 14px 16px; }
        .card img { width: 100%; height: 180px; object-fit: cover; border-radius: 8px; }
        .badge { display: inline-block; border-radius: 99px; padding: 2px 10px; font-size: 13px; background: #f1e4d8; }
        .badge.available { background: #dcfce7; }
        .badge.reserved { background: #fef3c7; }
        .badge.adopted { background: #e5e7eb; }
        .filters a { margin-right: 10px; }
        form p { margin: 0 0 14px; }
        input, select, textarea { font: inherit; padding: 6px 8px; border: 1px solid #d6c7b8; border-radius: 6px; }
        .pagination { display: flex; gap: 6px; list-style: none; padding: 0; }
        .pagination li > * { display: block; padding: 4px 10px; border: 1px solid #eadfd3; border-radius: 6px; }
    </style>
</head>
<body>
    <header>
        <a class="logo" href="{{ route('animals.index') }}">Pet Adoption</a>
        <nav>
            <a href="{{ route('animals.index') }}">Animals</a>
            <a href="{{ route('shelters.index') }}">Shelters</a>
            <a class="button" href="{{ route('animals.create') }}">+ Add an animal</a>
        </nav>
    </header>

    @if (session('message'))
        <p class="flash">{{ session('message') }}</p>
    @endif

    <main>
        @yield('content')
    </main>
</body>
</html>
