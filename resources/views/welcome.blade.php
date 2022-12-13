<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>
    <select name="country_name">
        @foreach ($countries as $country)

            <option value="{{ $country->code }}">{{ $country->name }}</option>

        @endforeach
    </select>
</center>
</body>
</html>
