<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>

<body>
<div class="app">
    <header class="header">
        <p class="header-heading">mogitate</p>
    </header>

    <div class="content">
        @yield('content')
    </div>
</div>    

</body>

</html>