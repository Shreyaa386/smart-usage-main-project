<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Redirecting...</title>
        <meta http-equiv="refresh" content="0;url={{ route('login') }}">

    </head>
    <body>
        <p>Redirecting to login page...</p>
        <script>window.location.href = "{{ route('login') }}";</script>
    </body>
</html>
