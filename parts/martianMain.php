<?php
  require('../db.php');
  $dbCon = new db();

  $baseId = (isset($_GET['base_id']) ? $_GET['base_id'] : '');

  $qBase = "SELECT * FROM base WHERE base_id = " . $baseId;
  $rBase = $dbCon->query($qBase)->fetchArray();
?>
      <div class="col-12">
        <div class="row">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h2><?=$rBase['base_name']?></h2>
              <h6>Founded: <b><?=$rBase['founded']?></b></h6>
            </div>
            <a href="#" onclick="fnEditMartian(0,<?=$baseId?>)" style="width: auto" class="btn btn-primary"><i class="bi bi-plus-circle-dotted"></i>&nbsp; Add Martian</a>
          </div>
          
          <hr />
          <table id="martiansList" class="table table-striped table-bordered">
            <thead>
              <th style="text-align:center">ID</th>
              <th style="text-align:center">First Name</th>
              <th style="text-align:center">Last Name</th>
              <th style="text-align:center">Supervisor</th>
              <th style="text-align:center">Visitors</th>
              <th style="text-align:center">Action</th>
            </thead>
            <tbody>
              <?php
                if (!empty($baseId)) {
                  $qMartians = "SELECT * FROM martian WHERE base_id = " . $baseId;
                  $rMartians = $dbCon->query($qMartians)->fetchAll();

                  foreach($rMartians as $m) {
                    echo '<tr>';
                    echo '<td align="center">'.$m['martian_id'].'</td>';
                    echo '<td>'.$m['first_name'].'</td>';
                    echo '<td>'.$m['last_name'].'</td>';

                    if (!empty($m['super_id'])) {
                      $qSuper = "SELECT * FROM martian WHERE martian_id = " . $m['super_id'];
                      $rSuper = $dbCon->query($qSuper)->fetchArray();
                    }
                    
                    echo '<td>'.(empty($m['super_id']) ? '' : $rSuper['first_name'].' '.$rSuper['last_name']).'</td>';
                    
                    $qVisitors = "SELECT * FROM visitor WHERE host_id = " . $m['martian_id'];
                    $rVisitors = $dbCon->query($qVisitors)->numRows();
                    
                    echo '<td align="center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-outline-dark" onclick="fnViewVisitors('.$m['martian_id'].', '.$m['base_id'].')">'.$rVisitors.'</button>
                              <button type="button" class="btn btn-primary" onclick="fnAddVisitors('.$m['martian_id'].', '.$m['base_id'].')"><i class="bi bi-plus"></i></button>
                            </div>
                          </td>';
                    echo '<td align="center">
                            <a href="#" onclick="fnEditMartian('.$m['martian_id'].', '.$m['base_id'].')" class="btn btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <a href="#" onclick="fnDeleteMartian('.$m['martian_id'].', '.$m['base_id'].')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                          </td>';
                    echo '</tr>';
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <a href="#" onclick="fnLoadBaseIndex()" style="width: auto" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i>&nbsp; Go Back</a>

      <script type="text/javascript">
        $(document).ready( function () {
          $('#martiansList').DataTable();
        });
      </script>