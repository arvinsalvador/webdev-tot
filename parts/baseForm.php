<?php
  require ('../db.php');
  $dbCon = new db();

  $baseId = (isset($_GET['base_id']) ? $_GET['base_id'] : 0);
  $getBaseResult = null;
  $editAction = false;

  if ($baseId != 0) {
    $getBaseQue = "SELECT * FROM base WHERE base_id = " . $baseId;
    $getBaseResult = $dbCon->query($getBaseQue)->fetchArray();
    $editAction = true;
  } else {
    $editAction = false;
  }
?>
            
            
            <div class="span-messages-success">
              <span class="badge text-bg-success"><?=$successMessage?></span>
            </div>

            <div class="alert alert-danger span-messages-error" role="alert"></div>
              
            <form id="baseForm" action="" method="POST">
              <input type="hidden" name="base_id" id="base_id" value="<?=$baseId?>" />
              <div class="form-group">
                <label for="base_name">Base Name</label>
                <input type="text" name="base_name" id="base_name" class="form-control" value="<?=($getBaseResult != null ? $getBaseResult['base_name'] : '')?>">
              </div>
              <div class="form-group">
                <label for="base_founded">Founded</label>
                <input type="date" name="base_founded" id="base_founded" class="form-control" value="<?=($getBaseResult != null ? $getBaseResult['founded'] : '')?>" >
              </div>
              <div align="right">
                <br />
                <button type="submit" class="btn btn-primary" name="base_submit" value="1">Save Record</button>
              </div>
            </form>
            <script>
              $(document).ready(function() {
                $('#baseForm').submit(function(e) {
                  e.preventDefault();
                  $.ajax({
                    type: "POST",
                    url: 'saveBase.php',
                    data: $(this).serialize(),
                    success: function(response)
                    {
                      var jsonData = JSON.parse(response);
        
                      // user is logged in successfully in the back-end
                      // let's redirect
                      if (jsonData.success == "1")
                      {
                          $('#modal-base').hide();
                          fnLoadBaseIndex();
                          $('.modal-backdrop').remove();
                      }
                      else
                      {
                        $('.span-messages-error').css('display','block');
                        $('.span-messages-error').html(jsonData.message);
                      }
                    }
                  });
                });
              });
            </script>