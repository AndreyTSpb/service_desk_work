<?php


class Model_Order extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function form_new_order(){

        $objUser = new Model_Users(['where'=>'id = '.$this->id_user]);
        $objUser->fetchOne();

        $data['userName']         = $objUser->name;
        $data['userPC']           = $objUser->pc_name;
        $data['userEmail']        = $objUser->email;
        $data['userPhone']        = $objUser->phone;
        $data['selecKlassTruble'] = $this->selectKlassTruble();
        $data['returnUrl']        = DOCUMENT_ROOT.DS;
        $data['action']           = DOCUMENT_ROOT.DS.$this->url.DS.'add';
        return Class_Get_Buffer::returnBuffer($data,'forms/add_order.php');

    }

    private function selectKlassTruble($idKlass = false){
        $option = '';

        $obj = new Model_Klass_Truble(['where'=>'del = 0']);
        if(!$obj->fetchOne()) return $option;
        $rows = $obj->getAllRows();
        foreach($rows as $row){
            $sel = ($row['id'] == $idKlass)?'selected':'';
            $option .= '<option value="'.$row['id'].'" '.$sel.'>'.$row['name'].'</option>';
        }
        return $option;
    }

    public function selectTypeTruble($idKlass, $idType = false){
        
        $obj = new Model_Type_Truble(['where'=>'del = 0 AND klass_truble_id = '.(int)$idKlass, 'order'=>'name ASC']);
        $option = '<option value="">Выбрать...</option>';
        if(!$obj->num_row) return $option;
        $rows = $obj->getAllRows();
        foreach($rows as $row){
            $sel = ($row['id'] == $idType)?'selected':'';
            $option .= '<option value="'.$row['id'].'" '.$sel.'>'.$row['name'].'</option>';
        }
        return $option;
    }

    public function saveOrder($posts){
        /**
         * Array ( 
         *  [userName] => user1 
         *  [pcName] => test-pc-1 
         *  [email] => test1@gmail.com 
         *  [phone] => 111 
         *  [klass] => 1 
         *  [type] => 3 
         *  [conectMethod] => on 
         *  [text] => test test test test 
         * )
         */
        $obj = new Model_Orders();
        //2022-12-11 12:56:33
        $dt = date('Y-m-d H:i:s');
        $obj -> dt = $dt;
        $obj -> text = htmlspecialchars($posts['text']);
        $obj -> name_comp = htmlspecialchars($posts['pcName']);
        $obj -> klass_truble_id = (int)$posts['klass'];
        $obj -> type_truble_id  = (int)$posts['type'];
        $obj -> connect_method  = $posts['conectMethod'];
        $obj -> users_id         = $this->id_user;
        if(!$obj->save()) return false;
        return true;
    }

    /**
     * Получение данных по заевке.
     * @param int $orderId - идентификатор заявки
     * @param boole $getJob  - если true принимает в работу 
     */
    public function workOrderForm($orderId, $getJob = false)
    {
        $data['orderInfo']        = $this->getOrderInfo($orderId);
        $job = false;
        if($data['orderInfo']['status'] == 0 AND $getJob == true) {
            /**
             * Если заявка еще не принята никем, отметить что ее приняли 
             * и сделать запись, что ее приняли
             */
            if(!$this->chekWorkOrder($orderId)){
                Class_Alert_Message::error("Статус заявки не изменился");
                return false;
            }
            if(!$this->createRecordAnswer($orderId)){
                Class_Alert_Message::error('Запись не создана');
                return false;
            }
            $job = true;
        } 
        $orderAnswers = $this->getOrderAnswer($orderId);
        if($orderAnswers){
            $job = true;
        }
        $data['userInfo']         = $this->getUserInfo($data['orderInfo']['userId']);
        $data['returnUrl']        = DOCUMENT_ROOT.DS;
        $data['action']           = DOCUMENT_ROOT;
        $data['job']              = $job;
        $data['orderAnswers']     = $orderAnswers;
        $data['userId']           = $this->id_user;
        return Class_Get_Buffer::returnBuffer($data,'forms/work_order.php');
    }

    private function getUserInfo($userId)
    {
        /**
         * Информация о пользователе
         */
        $objUser = new Model_Users(['where'=>'id = '.$userId]);
        $objUser->fetchOne();
        
        $data['userName']         = $objUser->name;
        $data['userEmail']        = $objUser->email;
        $data['userPhone']        = $objUser->phone;
        return $data;
    }

    private function getOrderInfo($orderId)
    {
        $obj = new Model_Orders(['where'=>'id = '.(int)$orderId]);
        if(!$obj->fetchOne()) return false;
        return array(
            'orderId'           => $orderId, 
            'userId'            => $obj->users_id,
            'pcName'            => $obj->name_comp,
            'klass_truble_id'   => Class_Get_Name_Klass_Truble::name($obj->klass_truble_id),
            'type_truble_id'    => Class_Get_Name_Type_Truble::name($obj->type_truble_id),
            'connect_method'    => $obj->connect_method,
            'text'              => $obj->text,
            'img'               => $obj->file_name,
            'status'            => $obj->status
        );
    }

    private function chekWorkOrder($orderId){
        $obj = new Model_Orders(['where'=>'id = '.(int)$orderId]);
        if(!$obj->fetchOne()) return false;
        $obj->status = 1;
        if(!$obj->update()) return false;
        return true;
    }

    private function createRecordAnswer($orderId)
    {
        $obj = new Model_Order_Answers();
        $obj->orders_id = $orderId;
        $obj->users_id = $this->id_user;
        if(!$obj->save()) return false;
        return true;
    }

    /**
     * Получаем все решения по заявке
     * @param int $orderId - айди заявки
     */
    private function getOrderAnswer(int $orderId){
        $obj = new Model_Order_Answers(['where'=>'orders_id = '.(int)$orderId, 'order'=>'dt ASC']);
        if(!$obj->num_row) return false;
        $rows = $obj->getAllRows();
        $arr = array();
        foreach($rows AS $row){
            $arr[$row['id']] = array(
                'userId'    => $row['users_id'],
                'userName'  => Class_Get_Name_User::shortName($row['users_id']),
                'dt'        => $row['dt'],
                'text'      => $row['text']
            );
        }
        return $arr;
    }
}