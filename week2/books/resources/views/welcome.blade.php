<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Books</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

       
    </head>
    <body>
        Welcome, {{ $name }}. You are {{ $age }} years old.

        <ul>
            @foreach($books as $book)
                <li><a href="{{ route('single-book', ['id' => $book->id])  }}">{{ $book->title }}</a></li>
            @endforeach
        </ul>

    </body>
</html>
