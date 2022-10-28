<?php
  require('db.php');
  $dbCon = new db();

  if (isset($_POST['martian_id']) && $_POST['martian_id']) {
    $martianId = $_POST['martian_id'];

    $qMartian = "SELECT * FROM martian WHERE martian_id = " . $martianId;
    $rCMartian = $dbCon->query($qMartian)->numRows();

    if ($rCMartian < 1) {
      echo 'We cannot find Martian. Please try again.';
      exit;
    } else {

      $qMartianSuper = "SELECT * FROM martian WHERE super_id = " . $martianId;
      $rMartianSuper = $dbCon->query($qMartianSuper)->numRows();

      if ($rMartianSuper < 1) {
        $qDeleteMartian = "DELETE FROM martian WHERE martian_id = " . $martianId;
        $rDeleteMartian = $dbCon->query($qDeleteMartian);
  
        if ($rDeleteMartian) {
          echo 'success';
        } else {
          echo 'We were not able to delete martian. Please try again!';
        }
      } else {
        echo 'Martian is a supervisor, it cannot be deleted.';
      }
      
    }
  } else {
    echo 'We were not able to get martian information.';
  }
?>