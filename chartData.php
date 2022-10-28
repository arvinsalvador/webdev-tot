<?php
  require('db.php');
  $dbCon = new db();

  $jsonArray = array();

  $qBase = "SELECT * FROM base";
  $rBase = $dbCon->query($qBase)->fetchAll();
  $rCBase = $dbCon->query($qBase)->numRows();

  if ($rCBase > 0) {
    foreach($rBase as $b) {
      $baseData = array();
      $baseData['label'] = $b['base_name'];

      $qMartian = "SELECT * FROM martian WHERE base_id = " . $b['base_id'];
      $rMartian = $dbCon->query($qMartian)->numRows();
      $baseData['value'] = $rMartian;

      array_push($jsonArray, $baseData);
    }
  }

  header('Content-type: application/json');
    //output the return value of json encode using the echo function.
  echo json_encode($jsonArray);
?>