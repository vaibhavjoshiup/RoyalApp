<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .footer-links {
            margin-top: 20px;
        }

        .footer-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #333;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Book</h1>
        <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="release_date">Release Date</label>
                <input type="date" id="release_date" name="release_date" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div>
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div>
                <label for="format">Format</label>
                <input type="text" id="format" name="format" required>
            </div>
            <div>
                <label for="number_of_pages">Number of Pages</label>
                <input type="number" id="number_of_pages" name="number_of_pages" required>
            </div>
            <div>
                <label for="author_id">Author</label>
                <select id="author_id" name="author_id" required>
                    @foreach ($authors as $author)
                        <option value="{{ $author['id'] }}">{{ $author['first_name'] }} {{ $author['last_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Add Book</button>
        </form>

        <div class="footer-links">
            <a href="{{ route('profile') }}">Profile</a>
            <a href="{{ route('authors.index') }}">Authors</a>
        </div>
    </div>
</body>
</html>
