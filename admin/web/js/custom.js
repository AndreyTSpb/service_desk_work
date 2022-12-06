$(document).ready(function () {

    /**
     * new_model_view.php
     */

    if($("div.new_model").length > 0){
        console.log(window.location.href);
        /**
         * авто-запонение названия таблицы при клике по ее названию в  new_model
         */
        $(".name_table").on("click", function () {
            $("input[name=name_model]").val("model_" + $(this).text());
        });

        /**
         * Предварительный просмотр результата
         */
        $("button[name=test_model]").on("click", function () {
            var table_name = $("input[name=name_model]").val().substr(6);
            var model_path = $("input[name=model_path]").val();

            $.ajax({
                url: window.location.href + "/ajax_preview",
                type: "POST",
                data: {
                    preview: true,
                    table_name: table_name,
                },
                success: function (html) {
                    $("div.black_squar").html(html);
                    $("#path").val(model_path);
                    $("#name").val(table_name);
                }
            });
        });
    }
    /**
     * new_mvc_view.php
     */
    if($("div.new_mvc").length > 0){

        /**
         * Проверяем существует ли уже такой файл
         * чтобы не перезатереть
         * @param url
         * @param file
         */
        test_create_files = function(url, file){
            $.ajax({
                url: window.location.href + '/ajax_file_exist',
                type:'post',
                data: {url: url, name: file},
                error: function()
                {
                    alert("error");
                },
                success: function(text)
                {
                    if(text === '1'){
                        $("button[name=btn_create]").hide();
                        alert("Файл уже существует " + file);
                    }
                }
            });
        };

        /**
         * показаваем имена новых файлов перед созданием
         */

        file_name = function(){
            var file = $("input[name=name_files]").val();
            if(file){
                var url = "../" + $("input[name=path_files]").val();

                var files = "";
                test_create_files(url + "controllers", "controller_" + file + ".php");
                files = "controller_" + file + ".php";

                if($("input[name=view_chk]").prop("checked")){
                    test_create_files(url + "views", file + "_view.php");
                    files  = files + "<br>" + file + "_view.php";
                }
                if($("input[name=model_chk]").prop("checked")) {
                    test_create_files(url + "models", "model_" + file + ".php");
                    files  = files + "<br>" + "model_" + file + ".php";
                }
                $("div.black_squar").html(files);
            }
        };


        $("input[name=name_files]").keydown(function (e) {
            if(e.keyCode === 13){
                file_name();
                e.preventDefault();
            }
        });

        $("input[name=name_files]").blur(function () {
             file_name();
        });

    }
});