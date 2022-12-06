<?php
?>
<!doctype html>
<html lang="ru">
    <head>
        <!-- Обязательные метатеги -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="<?=DOCUMENT_ROOT?>/web/css/customs.css" rel="stylesheet">

        <title><?=$title;?></title>
    </head>
    <body class="d-flex flex-column h-100">

        <header>
            <!-- Fixed navbar -->
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><?=$nameCompany?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <?php include ('./apps/views/menu/'.$view_menu_file);?>
                        <form class="d-flex">
                            <input id="search-page" class="form-control me-2" type="search" placeholder="Поиск" aria-label="Search">
                            <button id="btn-search" class="btn btn-outline-success" type="submit">Поиск</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Begin page content -->
        <main class="col-12 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?=$title;?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                <?php
                    if(isset($buttons) AND !empty($buttons)){
                        foreach ($buttons as $button){
                            echo $button;
                        }
                    }
                ?>
                </div>
            </div>
            <div class="container">
                <?=$content;?>
            </div>
        </main>

        <footer class="footer mt-auto py-3 bg-light">
            <div class="container">
                <span class="text-muted">Place sticky footer content here.</span>
            </div>
        </footer>

        <!-- Дополнительный JavaScript; выберите один из двух! -->

        <!-- Вариант 1: Bootstrap в связке с Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Вариант 2: Bootstrap JS отдельно от Popper
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->

        <!-- Custom Scripts-->
        <script src="<?=DOCUMENT_ROOT?>/web/js/scripts.js"></script>
    </body>
</html>
