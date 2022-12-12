<?php


class Controller_Order extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Model_Order();
        $this->model->id_user = $this->id_user;
        $this->model->url = 'order';
    }

    public function action_new(){
        $data['nameCompany'] = $this->model->nameCompany;
        $data['labelCompany'] = $this->model->labelCompany;
        $data['title']      = "Новая заявка в службу технической поддержки";
        if($this->model->role == 1){
            
            $data['view_menu_file'] = 'admin_menu.php';
            $data['buttons']     = array(
            );
        }elseif ($this->model->role == 2){
            $data['view_menu_file'] = 'super_admin_menu.php';
            $data['buttons']     = array(
            );
            $data['content']    = $this->model->get_super_admin_data();
        }else{
            $data['content']    = $this->model->form_new_order();
            $data['buttons']     = array(
            );
            $data['view_menu_file'] = 'user_menu.php';
        }
        $view_file = 'order_view.php';

        $this->view->generate($view_file, 'page.php', $data);
    }

    public function action_ajax_get_list_type_truble(){
        if(isset($_POST['selectType'])){
            echo $this->model->selectTypeTruble($_POST['id'],'');
            exit;
        }
    }

    public function action_add()
    {
        if(!$this->model->saveOrder($_POST)){
            header('Location: '.DOCUMENT_ROOT.DS.$this->model->url.DS.'new');
            exit();
        }
        header('Location: '.DOCUMENT_ROOT.DS);
        exit();
    }

    public function action_work_order($params){

        if(isset($params['id']) AND !empty($params['id'])){
            $data['content'] = $this->model->workOrderForm((int)$params['id']);
            if(!$data['content']){
                header('Location: '.DOCUMENT_ROOT);
                exit;
            }
            $data['nameCompany'] = $this->model->nameCompany;
            $data['labelCompany'] = $this->model->labelCompany;
            $data['title']      = "Новая заявка в службу технической поддержки";
            if($this->model->role == 1){
                
                $data['view_menu_file'] = 'admin_menu.php';
                $data['buttons']     = array(
                );
            }elseif ($this->model->role == 2){
                $data['view_menu_file'] = 'super_admin_menu.php';
                $data['buttons']     = array(
                );
            }else{
                $data['buttons']     = array(
                );
                $data['view_menu_file'] = 'user_menu.php';
            }
            $view_file = 'order_view.php';
    
            $this->view->generate($view_file, 'page.php', $data);
            exit;
        }
        header('Location: '.DOCUMENT_ROOT);
        exit;
    }
}