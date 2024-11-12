<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <div class="max-w-md mx-auto mt-10">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" class="w-full p-2 border" required>
            </div>

            <div class="mt-4">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="w-full p-2 border" required>
            </div>

            <div class="mt-4">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="w-full p-2 border" required>
            </div>

            <div class="mt-4">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="w-full p-2 border" required>
            </div>

            <div class="mt-4">
                <label for="role">Role</label>
                <select id="role" name="role" class="w-full p-2 border" required>
                    <option value="user">User</option>
                    <option value="professional">Professional (Doctor)</option>
                </select>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>
