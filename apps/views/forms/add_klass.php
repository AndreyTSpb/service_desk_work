<?php
?>
<form id="<?=$formId?>" action="<?=$actionUrl;?>" method="<?=$methodForm?>">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Имя класса проблемы</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Укажите имя для нового класса проблемы</div>
  </div>
  <?=(isset($idRow) AND !empty($idRow))?'<input type="hidden" name="idRow" value="'.$idRow.'">':''?>
  
</form>