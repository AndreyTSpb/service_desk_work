<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 05/09/2019
 * Time: 13:51
 */

class Class_Alert_Error
{
    static function danger($text, $text_2 = false, $text_3 = false){
        $_SESSION['danger'] = "<div class=\"col-12 alert alert-danger alert-dismissible\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						<h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
						$text </br> $text_2 <br> $text_3
					  </div>";
    }

    static function succeed($text, $text_2 = false, $text_3 = false){
        $_SESSION['success'] = "<div class=\"col-12 alert alert-success alert-dismissible\">
						<h4><i class=\"icon fa fa-check\"></i> Alert!</h4>
						Результат: $text  </br> Транзакция: $text_2  </br> Номер счета: $text_3
					  </div>";
    }

    static function warning($text, $text_2 = false, $text_3 = false){
        $_SESSION['warning'] = "<div class=\"col-12 alert alert-warning alert-dismissible\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
						$text <br> $text_2 <br> $text_3
					  </div>";
    }
}