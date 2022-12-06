<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 26/12/2019
 * Time: 21:37
 */
?>
<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--link rel="icon" href="../../../../favicon.ico"-->

        <title>Signin Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="<?=DOCUMENT_STATIC?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?=DOCUMENT_STATIC?>/css/signin.css" rel="stylesheet">
    </head>

    <body class="text-center">
            <form class="form-signin" method="post">
                <!-- Alert -->
                <?php if(!empty($_SESSION['success'])){
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }?>

                <?php if(!empty($_SESSION['danger'])){
                    echo $_SESSION['danger'];
                    unset($_SESSION['danger']);
                }?>

                <?php if(!empty($_SESSION['warning'])){
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);
                }?>
                <!--/End -->
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" name="signin" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2017-<?=date("Y", time())?></p>
            </form>
    </body>
</html>
