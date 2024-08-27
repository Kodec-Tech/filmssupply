<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >
        <title>Error!</title>

        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        >
        <link
            href="../assets/img/favicon-32x32.ico"
            rel="icon"
        >

        
        <link
            href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap"
            rel="stylesheet"
        >
    </head>

    <body>

        <div class="container-fluid vh-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col  text-center">
            <img src="../assets/img/error.svg" class="img-fluid" alt="">

                    <h2 class='mb-4 fs-2'><?php if (isset($_GET['error'])) {
                        echo $_GET['error'];
                    } else {
                        echo "An Unknown error occured ";
                    } ?></h2>
                    <a style="background:#1877f2" class="mt-5 px-4 py-2 text-white rounded text-decoration-none" href="login.php">
                        Go back home
                    </a>
                </div>
            </div>
        </div>
    </body>

</html>