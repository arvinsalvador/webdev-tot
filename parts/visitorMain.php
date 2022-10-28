<?php
  require('../db.php');
  $dbCon = new db();

  $baseId = (isset($_GET['base_id']) ? $_GET['base_id'] : 0);
  $martianId = (isset($_GET['martian_id']) ? $_GET['martian_id'] : '');
?>
      <div class="col-12">
        <div class="row">
          <table id="visitorsList" class="table table-striped table-bordered">
            <thead>
              <th>Visitor</th>
            </thead>
            <tbody>
              <?php
                if (!empty($martianId)) {
                  $qVisitors = "SELECT * FROM visitor WHERE host_id = " . $martianId;
                  $rVisitors = $dbCon->query($qVisitors)->fetchAll();

                  foreach($rVisitors as $v) {
                    echo '<tr>';
                    echo '<td class="d-flex justify-content-between align-items-center">
                            <div>'.$v['first_name'].' '.$v['last_name'].'</div>
                            <a href="#" class="btn btn-sm btn-danger" onclick="fnDeleteVisitor('.$v['visitor_id'].', '.$baseId.')">
                              <i class="bi bi-trash"></i>
                            </a>
                          </td>';
                    
                    echo '</tr>';
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready( function () {
          $('#visitorsList').DataTable();
        });
      </script>