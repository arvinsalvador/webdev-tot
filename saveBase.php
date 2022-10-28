<?php
  require('db.php');
  $dbCon = new db();

  if (isset($_POST['base_name']) && $_POST['base_name'] 
      && isset($_POST['base_founded']) && $_POST['base_founded']) {
    
    $baseId = $_POST['base_id'];
    $baseName = $_POST['base_name'];
    $baseFounded = $_POST['base_founded'];

    $queryString = '';
    $error = false;

    $returnMessage = array(
      'success' => 0,
      'message' => ''
    );

    if (empty($baseName)) {
      $returnMessage['message'] = 'Base name should not be empty!';
      $error = true;
    }

    if (empty($baseFounded)) {
      $returnMessage['message'] = 'Base founded should not be empty!';
      $error = true;
    }

    if (!$error) {
      if ($baseId == 0) {
        $queryString = "INSERT INTO base(base_name, founded) VALUES('" . $baseName . "', '" . $baseFounded . "')";
      } else {
        $queryString = "UPDATE base SET base_name = '".$baseName."', founded = '".$baseFounded."' WHERE base_id = " . $baseId;
      }

      $queryResult = $dbCon->query($queryString);

      if ($queryResult) {
        $returnMessage['success'] = 1;
        $returnMessage['message'] = 'Successfully Saved!';
      } else {
        $returnMessage['success'] = 0;
        $returnMessage['message'] = 'Failed to save!';
      }
    }
    echo json_encode($returnMessage);
  } else {
    echo json_encode(
      array(
        'success' => 0,
        'message' => 'Please make sure not to leave any fields blank.'
      )
    );
  }
?>