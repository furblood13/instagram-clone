<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white border-b">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="text-2xl font-bold">Instagram Clone</a>
                    </div>
                </div>
                <div class="flex items-center">
                    @auth
                        <a href="{{ route('surveys.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2">Surveys</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-gray-900 px-3 py-2">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto py-6 px-4">
        @yield('content')
    </main>
</body>
</html> 