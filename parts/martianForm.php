<?php
  require ('../db.php');
  $dbCon = new db();

  $baseId = (isset($_GET['base_id']) ? $_GET['base_id'] : 0);
  $martianId = (isset($_GET['martian_id']) ? $_GET['martian_id'] : 0);
  $getBaseResult = null;
  $editAction = false;

  if ($martianId != 0 && $baseId != 0) {
    $getBaseQue = "SELECT * FROM martian WHERE martian_id = " . $martianId . " AND base_id = " . $baseId;
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
              
            <form id="martianForm" action="" method="POST">
              <input type="hidden" name="martian_id" id="martian_id" value="<?=$martianId?>" />
              <input type="hidden" name="base_id" id="base_id" value="<?=$baseId?>" />
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?=($getBaseResult != null ? $getBaseResult['first_name'] : '')?>">
              </div>
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?=($getBaseResult != null ? $getBaseResult['last_name'] : '')?>">
              </div>
              <div class="form-group">
                <label for="super_id">Supervisor</label>
                <select name="super_id" id="super_id" class="form-control">
                  <option value="0">None</option>
                  <?php
                    $qMartians = "SELECT * FROM martian WHERE base_id = " . $baseId;
                    $rMartians = $dbCon->query($qMartians)->fetchAll();

                    if ($rMartians) {
                      foreach ($rMartians as $m) {
                        echo '<option value="'.$m['martian_id'].'"';
                        
                        if ($getBaseResult['super_id'] == $m['martian_id']) {
                          echo ' selected="selected"';
                        }
                        echo '>'.$m['first_name'].' '.$m['last_name'].'</option>';
                      }
                    }
                  ?>
                </select>
              </div>
              <div align="right">
                <br />
                <button type="submit" class="btn btn-primary" name="base_submit" value="1">Save Record</button>
              </div>
            </form>
            <script>
              $(document).ready(function() {
                $('#martianForm').submit(function(e) {
                  e.preventDefault();
                  $.ajax({
                    type: "POST",
                    url: 'saveMartian.php',
                    data: $(this).serialize(),
                    success: function(response)
                    {
                      var jsonData = JSON.parse(response);
        
                      // user is logged in successfully in the back-end
                      // let's redirect
                      if (jsonData.success == "1")
                      {
                          $('#modal-martian').hide();
                          fnLoadBaseMartians(<?=$baseId?>);
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