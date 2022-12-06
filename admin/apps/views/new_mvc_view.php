<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18/06/2019
 * Time: 09:58
 */

?>
<div class="container new_mvc">
    <div class="row">
        <div class="col">
            <form method="post" action="new_mvc/create_files">
                <div class="form-row m-1">
                    <div class="col"><label for="inputPassword2" class="ol-sm-2 col-form-label">Путь для размещения MVC</label></div>
                    <div class="col-8"><input type="text" class="form-control" name = "path_files" id="inputPassword1" value="apps/" placeholder="../apps/"></div>
                </div>
                <div class="form-row m-1 mt-2">
                    <div class="col"><label for="inputPassword2" class="ol-sm-2 col-form-label">Названия группы файлов MVC</label></div>
                    <div class="col-8"><input type="text" class="form-control" name = "name_files" id="inputPassword2" placeholder="Exemple"></div>
                </div>
                <div class="form-check m-1">
                    <input class="form-check-input" name = "view_chk" type="checkbox" value="1" id="defaultCheck1" checked>
                    <label class="form-check-label" for="defaultCheck1">
                        Добавить фаил View
                    </label>
                </div>
                <div class="form-check m-1">
                    <input class="form-check-input" name = "model_chk" type="checkbox" value="1" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                        Добавить файл Model
                    </label>
                </div>
                <button type="submit" name="btn_create" class="btn btn-primary mb-2">Создать файлы</button>
            </form>
        </div>
    </div>
    <div class="row preview">
        <div class="col-6">
            <div class="black_squar">

            </div>
        </div>
    </div>
</div>
