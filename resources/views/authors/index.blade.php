<!-- resources/views/authors/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Authors</title>
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
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            color: #333;
        }
        .pagination a.active {
            background-color: #4caf50;
            color: white;
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
    <h1>Authors</h1>
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Place of Birth</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author['id'] }}</td>
                    <td>{{ $author['first_name'] }}</td>
                    <td>{{ $author['last_name'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($author['birthday'])->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($author['gender']) }}</td>
                    <td>{{ $author['place_of_birth'] }}</td>
                    <td>
                        <a href="{{ route('authors.show', $author['id']) }}">View</a>
                        <form method="POST" action="{{ route('authors.destroy', $author['id']) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        @for ($i = 1; $i <= $pagination['total_pages']; $i++)
            <a href="{{ route('authors.index', ['page' => $i]) }}" class="{{ $i == $pagination['current_page'] ? 'active' : '' }}">{{ $i }}</a>
        @endfor
    </div>
    <a href="{{ route('profile') }}">Profile</a>
    <a href="{{ route('books.create') }}">Create Book</a>
</body>
</html>
