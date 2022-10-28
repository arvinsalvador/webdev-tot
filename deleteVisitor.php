<?php
  require('db.php');
  $dbCon = new db();

  if (isset($_POST['visitor_id']) && $_POST['visitor_id']) {
    $visitorId = $_POST['visitor_id'];

    $qVisitor = "SELECT * FROM visitor WHERE visitor_id = " . $visitorId;
    $rCVisitor = $dbCon->query($qVisitor)->numRows();

    if ($rCVisitor < 1) {
      echo 'We cannot find Visitor. Please try again.';
      exit;
    } else {
      $qDeleteVisitor = "DELETE FROM visitor WHERE visitor_id = " . $visitorId;
      $rDeleteVisitor = $dbCon->query($qDeleteVisitor);

      if ($rDeleteVisitor) {
        echo 'success';
      } else {
        echo 'We were not able to delete martian. Please try again!';
      }
    }
  } else {
    echo 'We were not able to get visitor information.';
  }
?>