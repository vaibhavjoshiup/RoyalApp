<!-- resources/views/authors/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>{{ $author['first_name'] }} {{ $author['last_name'] }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f2f2f2;
        }
        .alert {
            padding: 15px;
            background-color: #f44336;
            color: white;
            margin-bottom: 20px;
        }
        .success {
            padding: 15px;
            background-color: #4caf50;
            color: white;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>{{ $author['first_name'] }} {{ $author['last_name'] }}</h1>
    <p><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($author['birthday'])->format('Y-m-d') }}</p>
    <p><strong>Gender:</strong> {{ ucfirst($author['gender']) }}</p>
    <p><strong>Place of Birth:</strong> {{ $author['place_of_birth'] }}</p>

    <h2>Books</h2>
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Description</th>
                <th>ISBN</th>
                <th>Format</th>
                <th>Number of Pages</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($author['books'] as $book)
                <tr>
                    <td>{{ $book['title'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($book['release_date'])->format('Y-m-d') }}</td>
                    <td>{{ $book['description'] }}</td>
                    <td>{{ $book['isbn'] }}</td>
                    <td>{{ $book['format'] }}</td>
                    <td>{{ $book['number_of_pages'] }}</td>
                    <td>
                        <form method="POST" action="{{ route('books.destroy', $book['id']) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('authors.index') }}">Authors</a>
</body>
</html>
