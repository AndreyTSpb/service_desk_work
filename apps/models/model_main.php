<?php


class Model_Main extends Model
{
    function get_user_data(){
        /**
         * Все заявки пользователя
         */
        $header = array(
            '#',
            'Пользователь',
            'Класс',
            'Тип',
            'Описание',
            'Ответственный',
            'Дата создания',
            'Дата завершения'
        );
        $body = $this->get_body_user_order();
        return Class_Create_Simple_Table::html($header, $body);
    }

    /**
     * Данные по заявкам созданым пользователем
     * @return array
     */
    function get_body_user_order(){
        $obj = new Model_Orders(
            ['where' => 'users_id = '.(int)$this->id_user,
                "order" => 'dt DESC'
            ]);
        if(!$obj->num_row){
            return array(
                array(
                    '1',
                    'Нет данных',
                    'Нет данных',
                    'Нет данных',
                    'Нет данных',
                    'Нет данных',
                    'Нет данных',
                    'Нет данных'
                )
            );
        }
        $arr = array();
        $rows = $obj->getAllRows();
        foreach ($rows as $row){
            $arr[$row['id']] = array(
                $row['id'],
                'Пользователь',
                'Класс',
                'Тип',
                'Описание',
                'Ответственный',
                'Дата создания',
                'Дата завершения'
            );
        }

        return array(
            '1',
            'Нет данных',
            'Нет данных',
            'Нет данных',
            'Нет данных',
            'Нет данных',
            'Нет данных',
            'Нет данных'
        );
    }

    /**
     * Кнопка новая заявка
     */
    function btn_new_order(){
        return '<a href="'. DOCUMENT_ROOT.'/order/new" class="btn btn-sm btn-outline-secondary">Новая</a>';
    }

    /**
     * Кнопка выбора дня для сортировки в таблице
     */
    function btn_select_date(){
        return "<div class='input-group date' id='datetimepicker3'>
            <input id='select_date' type='date' class='form-control' />
        </div>";
    }
    /**
     * Выбор сотрудника службы тех.поддержки
     */
    function btn_select_admin(){
        return "<div class=\"input-group\">
            <select id=\"select_id_admin\" name=\"id_admin\" class=\"form-select form-select-sm\" aria-label=\".form-select-sm example\">
                <option value=\"0\" selected>Все</option>
                <option value=\"1\">Иванов Николай</option>
                <option value=\"2\">Осипова Наталья</option>
                <option value=\"3\">Никитин Сергей</option>
            </select>
        </div>";
    }
}