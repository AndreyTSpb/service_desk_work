<?php


class Controller_Directory extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->model = new Model_Directory();
        $this->model->url = 'directory';
    }

    public function action_index()
    {
        if($this->model->role == 2){
            $data['nameCompany']    = $this->model->nameCompany;
            $data['labelCompany']   = $this->model->labelCompany;
            $data['title']          = "Пользователи";
            $data['view_menu_file'] = 'super_admin_menu.php';
            $data['left_menu']      = $this->model->leftMenu();
            $data['buttons']        = array(
                Class_Create_Btn_Link::smallBtn(DOCUMENT_ROOT.DS.$this->model->url.'/new_user', 'btn btn-outline-primary', 'Добавить'),

            );
            $data['content']        = $this->model->getAllUsers();
            $this->view->generate('directory_view.php', 'page.php', $data);
            exit();
        }else{
            Class_Alert_Error::warning('Отказано в доступе');
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit();
        }
    }

    public function action_new_user(){
        if($this->model->role == 2){
            //var_dump($_POST);
            //exit;
            /**
             * array(10) { 
             *  ["id"]=> string(0) "" 
             *  ["userName"]=> string(5) "user1" 
             *  ["pcName"]=> string(9) "test-pc-1" 
             *  ["email"]=> string(18) "atynyany@gmail.com" 
             *  ["phone"]=> string(9) "666666666" 
             *  ["role"]=> string(1) "1" 
             *  ["type"]=> string(0) "" 
             *  ["pass"]=> string(1) "1" 
             *  ["pass1"]=> string(1) "1" 
             *  ["save"]=> string(0) "" 
             * }
             */
            if(isset($_POST['save'])){
                if($this->model->saveUser($_POST)){
                    header('Location: '.DOCUMENT_ROOT.DS.$this->model->url);
                    exit();
                }
            }

            $data['nameCompany']    = $this->model->nameCompany;
            $data['labelCompany']   = $this->model->labelCompany;
            $data['title']          = "Добавить нвого пользователя";
            $data['view_menu_file'] = 'super_admin_menu.php';
            $data['left_menu']      = $this->model->leftMenu();
            $data['buttons']        = array(
                Class_Create_Btn_Link::smallBtn(DOCUMENT_ROOT.DS.$this->model->url, 'btn btn-outline-primary', 'Назад'),

            );
            $data['content']        = $this->model->formAddUser();
            $this->view->generate('directory_view.php', 'page.php', $data);
            exit();
        }else{
            Class_Alert_Error::warning('Отказано в доступе');
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit();
        }
    }

    public function action_edit_user($params){
        if($this->model->role == 2){
            if(isset($_POST['save'])){
                $params['id'] = $_POST['id'];
                if($this->model->updateUser($_POST)){
                    header('Location: '.DOCUMENT_ROOT.DS.$this->model->url);
                    exit();
                }
            }
            if(isset($_POST['updatePass'])){
                $params['id'] = $_POST['id'];
                if($this->model->updateUserPsw($_POST)){
                    header('Location: '.DOCUMENT_ROOT.DS.$this->model->url);
                    exit();
                }
            }
            $data['nameCompany']    = $this->model->nameCompany;
            $data['labelCompany']   = $this->model->labelCompany;
            $data['title']          = "Редактируем пользователя";
            $data['view_menu_file'] = 'super_admin_menu.php';
            $data['left_menu']      = $this->model->leftMenu();
            $data['buttons']        = array(
                Class_Create_Btn_Link::smallBtn(DOCUMENT_ROOT.DS.$this->model->url, 'btn btn-outline-primary', 'Назад'),

            );
            $data['content']        = $this->model->formEditUser($params['id']);

            $this->view->generate('directory_view.php', 'page.php', $data);
            exit();
        }else{
            Class_Alert_Error::warning('Отказано в доступе');
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit();
        }

    }

    public function action_klass()
    {
        if($this->model->role == 2){
            $data['nameCompany']    = $this->model->nameCompany;
            $data['labelCompany']   = $this->model->labelCompany;
            $data['title']          = "Справочник классов проблем";
            $data['view_menu_file'] = 'super_admin_menu.php';
            $data['left_menu']      = $this->model->leftMenu('klass');
            $data['content']        = $this->model->getAllKlass();
            $data['buttons']        = array(
                $this->model->getModalBtn(
                    'new_klass', 
                    'forms/add_klass.php', 
                    array(
                        'nameBtn'    => 'Добавить',
                        'titleModal' => 'Новый класс проблемы',
                        'data_template' => array(
                            'actionUrl' =>  'new_klass_truble',
                            'formId'    =>  'addNewKlassTruble',
                            'methodForm' => 'post'
                        )
                    )
                )
            );
            $this->view->generate('directory_view.php', 'page.php', $data);
            exit();
        }else{
            Class_Alert_Error::warning('Отказано в доступе');
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit();
        }
    }

    public function action_new_klass_truble(){
        if($this->model->role == 2){
            if(!isset($_POST['save'])){
                header('Location: '.DOCUMENT_ROOT.DS.$this->model->url.'/klass');
                exit();
            }
            if($this->model->saveKlassTruble($_POST)){
                Class_Alert_Message::succes('Добавлен новый класс проблемы '.$_POST['name']);
            }else{
                Class_Alert_Message::error($_POST['name'].'не добавлен');
            }
            header('Location: '.DOCUMENT_ROOT.DS.$this->model->url.'/klass');
            exit();
        }else{
            Class_Alert_Error::warning('Отказано в доступе');
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit();
        }
    }

    public function action_edit_klass_truble(){
        if($this->model->role == 2){
            if(!isset($_POST['save'])){
                header('Location: '.DOCUMENT_ROOT.DS.$this->model->url.'/klass');
                exit();
            }
            if($this->model->updateKlassTruble($_POST)){
                Class_Alert_Message::succes('Обновлен класс проблемы '.$_POST['name']);
            }else{
                Class_Alert_Message::error($_POST['name'].'не обновлен');
            }
            header('Location: '.DOCUMENT_ROOT.DS.$this->model->url.'/klass');
            exit();
        }else{
            Class_Alert_Error::warning('Отказано в доступе');
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit();
        }
    }

    public function action_type()
    {
        if($this->model->role == 2){
            $data['nameCompany']    = $this->model->nameCompany;
            $data['labelCompany']   = $this->model->labelCompany;
            $data['title']          = "Справочник типов проблем";
            $data['view_menu_file'] = 'super_admin_menu.php';
            $data['left_menu']      = $this->model->leftMenu('type');
            $data['content']        = $this->model->getAllTypeTrable();
            $data['buttons']        = array(
                $this->model->getModalBtn(
                    'new_klass', 
                    'forms/add_type.php', 
                    array(
                        'nameBtn'    => 'Добавить',
                        'titleModal' => 'Новый тип проблемы',
                        'data_template' => array(
                            'actionUrl' =>  'new_type_truble',
                            'formId'    =>  'addNewTypeTruble',
                            'methodForm' => 'post'
                        )
                    )
                )
            );
            $this->view->generate('directory_view.php', 'page.php', $data);
            exit();
        }else{
            Class_Alert_Error::warning('Отказано в доступе');
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit();
        }
    }

    public function action_new_type_truble(){
        if($this->model->role == 2){
            if(!isset($_POST['save'])){
                header('Location: '.DOCUMENT_ROOT.DS.$this->model->url.'/type');
                exit();
            }
            if($this->model->saveTypeTruble($_POST)){
                Class_Alert_Message::succes('Добавлен новый тип проблемы '.$_POST['name']);
            }else{
                Class_Alert_Message::error($_POST['name'].'не добавлен');
            }
            header('Location: '.DOCUMENT_ROOT.DS.$this->model->url.'/type');
            exit();
        }else{
            Class_Alert_Error::warning('Отказано в доступе');
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit();
        }
    }
}