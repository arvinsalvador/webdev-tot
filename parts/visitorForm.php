<?php
  require ('../db.php');
  $dbCon = new db();

  $baseId = (isset($_GET['base_id']) ? $_GET['base_id'] : 0);
  $martianId = (isset($_GET['martian_id']) ? $_GET['martian_id'] : 0);
?>
            
            
            <div class="span-messages-success">
              <span class="badge text-bg-success"><?=$successMessage?></span>
            </div>

            <div class="alert alert-danger span-messages-error" role="alert"></div>
              
            <form id="martianForm" action="" method="POST">
              <input type="hidden" name="martian_id" id="martian_id" value="<?=$martianId?>" />
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="">
              </div>
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="">
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
                    url: 'saveVisitor.php',
                    data: $(this).serialize(),
                    success: function(response)
                    {
                      console.log(response);
                      var jsonData = JSON.parse(response);
        
                      // user is logged in successfully in the back-end
                      // let's redirect
                      if (jsonData.success == "1")
                      {
                          $('#modal-visitor-add').hide();
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