<form id="<?=$formId?>" action="<?=$actionUrl;?>" method="<?=$methodForm?>">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Имя класса проблемы</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Укажите имя для нового класса проблемы</div>
  </div>
  <div class="mb-3">
    <select class="form-select" name="klassTrableId" aria-label="Default select example">
        <option selected>Выбрать класс проблемы</option>
        <?php 
            $obj = new Model_Klass_Truble(['where'=>'del = 0', 'order'=>'name ASC']);
            $rows = $obj->getAllRows();
            foreach($rows as $row){
                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
            }
        ?>
    </select>
  </div>
  <?=(isset($idRow) AND !empty($idRow))?'<input type="hidden" name="idRow" value="'.$idRow.'">':''?>
  
</form>