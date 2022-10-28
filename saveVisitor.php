<?php
  require('db.php');
  $dbCon = new db();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $martianId = $_POST['martian_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];

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
      $queryString = "INSERT INTO visitor(host_id, first_name, last_name) VALUES(".$martianId.", '".$firstName."','".$lastName."')";
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