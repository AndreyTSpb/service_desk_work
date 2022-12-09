<?php
/**
 * Быстрое создание кнопки вызывающей модалку
 */
Class Class_Widget_Modal{

    public $btn;
    public $modal;
    private $id_modal;
    private $data;
    private $template;

    public function __construct($id_modal, $template, $data)
    {
        $this->data = $data;
        $this->id_modal = $id_modal;
        $this->template = $template;
        $this->btn = $this->btn();
        $this->modal = $this->modal();
    }

    private function btn(){
        return '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#'.$this->id_modal.'">
                    '.$this->data['nameBtn'].'
                </button>';
    }

    private function modal(){
        if(isset($this->data['data_template']['formId']) AND !empty($this->data['data_template']['formId'])){
            $formId = 'form = '.$this->data['data_template']['formId'];
        }else{
            $formId = '';
        }
        return '<div class="modal fade" id="'.$this->id_modal.'" tabindex="-1" aria-labelledby="'.$this->id_modal.'Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="'.$this->id_modal.'Label">'.$this->data['titleModal'].'</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        '.$this->html().'
                        </div>
                        <div class="modal-footer">
                        <button '.$formId.' type="submit" name="save" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                    </div>
                </div>';
    }

    private function html(){
        return Class_Get_Buffer::returnBuffer($this->data['data_template'], $this->template);
    }

}