<?php
  require('../db.php');
  $dbCon = new db();
?>
      <div class="col-12">
        <div class="row">
        <?php
          $baseRecords = "SELECT * FROM base";
          $baseResults = $dbCon->query($baseRecords)->fetchAll();

          $count = 1;

          foreach ($baseResults as $b) {
            $cMartianQuery = "SELECT * FROM martian WHERE base_id = " . $b['base_id'];
            $cMartianCount = $dbCon->query($cMartianQuery)->numRows();
            echo '<div class="col col-lg-4 col-md-6 col-sm-12">';
            
            echo '<div class="card base-cards">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h6>'.$b['base_name'].'</h6>
                      <a href="#" class="btn btn-sm btn-default" onclick="fnEditBase('.$b['base_id'].')">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                    </div>
                    <div class="card-body text-center align-middle" align="center">
                      <div id="profileImage">'.strtoupper(substr($b['base_name'], 0, 1)).'</div>
                      <p>Total Population: <b>'.($cMartianCount ? $cMartianCount : 0).'</b></p>
                      <button class="btn btn-dark" onclick="fnLoadBaseMartians('.$b['base_id'].')"><i class="bi bi-person-bounding-box"></i>&nbsp;&nbsp;View Martians</button>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                      <span>Founded: <b>'.($b['founded'] == null ? 'Unknown' : $b['founded']).'</b></span>
                      <a href="#" class="btn btn-sm btn-default" onclick="fnDeleteBase('.$b['base_id'].')">
                        <i class="bi bi-trash"></i>
                      </a>
                    </div>
                  </div>';

            echo '</div>';
            
          }
        ?>
          <div class="col col-lg-4 col-md-6 col-sm-12">
            <div class="card base-cards-new">
              <div class="card-body">
                <a href="#" class="plus" onclick="fnEditBase(0)"></a>
              </div>
            </div>
          </div>
        </div>
      </div>