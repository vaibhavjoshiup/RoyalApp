<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d32f2f;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        a:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profile</h1>
        <p><strong>First Name:</strong> {{ $user['first_name'] }}</p>
        <p><strong>Last Name:</strong> {{ $user['last_name'] }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
        <a href="{{ route('authors.index') }}">View Authors</a>
        <a href="{{ route('books.create') }}">Create Book</a>
    </div>
</body>
</html>
