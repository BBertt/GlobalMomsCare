<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div class="max-w-md mx-auto mt-10">
        @if ($errors->has('login_error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>{{ $errors->first('login_error') }}</strong>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="w-full p-2 border" required>
            </div>

            <div class="mt-4">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="w-full p-2 border" required>
            </div>

            <div class="mt-4">
                <label>
                    <input type="checkbox" name="remember" value="1">
                    Remember Me
                </label>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>
