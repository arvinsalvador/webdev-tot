<?php
  require('db.php');
  $dbCon = new db();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $baseId = $_POST['base_id'];
    $martianId = $_POST['martian_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $superId = $_POST['super_id'];

    $queryString = '';
    $error = false;

    $returnMessage = array(
      'success' => 0,
      'message' => ''
    );

    if (empty($firstName) || empty($lastName)) {
      $returnMessage['message'] = 'First and Last Name should not be empty!';
      $error = true;
    }

    if (!$error) {
      if ($martianId == 0) {
        $queryString = "INSERT INTO martian(first_name, last_name, base_id, super_id) VALUES('".$firstName."','".$lastName."', ".$baseId.", ".$superId.")";
      } else {
        $queryString = "UPDATE martian SET first_name = '".$firstName."', last_name = '".$lastName."', base_id = ".$baseId.", super_id = ".$superId." WHERE martian_id = ".$martianId." AND base_id = ".$baseId;
      }

      $queryResult = $dbCon->query($queryString);

      if ($queryResult) {
        $returnMessage['success'] = 1;
        $returnMessage['message'] = 'Successfully Saved!';
      } else {
        $returnMessage['success'] = 0;
        $returnMessage['message'] = 'Failed to Save!';
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