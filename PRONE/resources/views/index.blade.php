<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>PRONE!</title>
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" >
        <div class="container-fluid">
            <a class="navbar-brand" href="/">PRONE!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main>
        <div class="container py-5 px-5">
            <div class="container py-2"></div>
            <div id="app"></div>
        </div>


        <footer>
            <div class="container text-secondary text-center">
                <hr>
                <p>PRONE!2023. Все права защищены.</p>
            </div>
        </footer>
    </main>

</body>
</html>
