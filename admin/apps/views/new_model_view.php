<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 17/06/2019
 * Time: 12:50
 */
?>
<div class="new_model">
    <h4>Список возможных таблиц</h4>
    <div class="row">
        <div class="col p-4">
            <?php if($tables):?>
            <?php foreach ($tables as $table):?>
                <?php if(Class_Test_Model::test_name($table)):?>
                    <button type="button" class="btn btn-danger name_table"><?=$table?></button>
                <?php else:?>
                    <button type="button" class="btn btn-success name_table"><?=$table?></button>
                <?php endif;?>
            <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
    <div class="row">
        <div class="col p-4">
            <h4>Создаем новую модель</h4>
            <form method="post" onsubmit="return false">
                <div class="form-group">
                    <label for="exampleInputEmail1">Путь для сохранения модели</label>
                    <input type="text" name="model_path" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="../apps/models/">
                    <small id="emailHelp" class="form-text text-muted">Путь где нужно создать модель таблицы базы данных.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Имя модели</label>
                    <input type="text" name="name_model" class="form-control" id="exampleInputPassword1" value="" placeholder="Model">
                </div>
                <button type="submit" name="test_model" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="row preview">
            <div class="col-6">
                <div class="black_squar">

                </div>
            </div>
            <div class="col-4 m-1">
                <form method="post" action="new_model/create_model">
                    <input type="hidden" id="path" name="model_path" value="">
                    <input type="hidden" id="name" name="name_model" value="">
                    <button type="submit" name="submit_model" class="btn btn-primary">Submit</button>
                </form>
            </div>
    </div>
</div>
