<?php
  require('db.php');
  $dbCon = new db();

  if (isset($_POST['base_id']) && $_POST['base_id']) {
    $baseId = $_POST['base_id'];
    $getBaseQuery = "SELECT * FROM base WHERE base_id=" . $baseId;
    $getBaseCount = $dbCon->query($getBaseQuery)->numRows();

    if ($getBaseCount < 1) {
      echo 'We cannot find base. Please try again.';
      exit;
    } else {
      $getBaseData = $dbCon->query($getBaseQuery)->fetchArray();
      $getBaseMartiansQuery = "SELECT * FROM martian WHERE base_id=" . $baseId;
      $getBaseMartiansCount = $dbCon->query($getBaseMartiansQuery)->numRows();

      if ($getBaseMartiansCount > 0) {
        echo 'Base has inhabitants and cannot be deleted.';
        exit;
      } else {
        $deleteBaseQuery = "DELETE FROM base WHERE base_id = " . $baseId;
        $deleteBaseResult= $dbCon->query($deleteBaseQuery);

        if ($deleteBaseResult) {
          echo 'success';
        } else {
          echo 'We were not able to delete base. Please try again!';
        }
      }
    }
  } else {
    echo 'We were not able to get base information.';
  }
?>