<?php

if ($_POST['action'] == 'create') {
  // create a new record in the data base

  require_once('../functions/db.php');

  // Validate entries
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $business = filter_var($_POST['business'], FILTER_SANITIZE_STRING);
  $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);

  try {
    $stmt = $conn->prepare("INSERT INTO contacts (name, business, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $business, $phone);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
      $response = array(
        'response' => 'correct',
        'data' => array(
          'name' => $name,
          'business' => $business,
          'phone' => $phone,
          'insert_id' => $stmt->insert_id
        )
      );
    }
    $stmt->close();
    $conn->close();
  } catch (Exception $e) {
    $response = array(
      'error' => $e->getMessage()
    );
  }
  echo json_encode($response);
}

if ($_GET['action'] == 'delete') {
  require_once('../functions/db.php');

  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  try {
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ? ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
      $response = array(
        'response' => 'correct'
      );
    }
    $stmt->close();
    $conn->close();
  } catch (Exception $e) {
    $response = array(
      'error' => $e->getMessage()
    );
  }
  echo json_encode($response);
}

if ($_POST['action'] == 'update') {
  // echo json_encode($_POST);

  require_once('../functions/db.php');

  // Validate entries
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $business = filter_var($_POST['business'], FILTER_SANITIZE_STRING);
  $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

  try {
    $stmt = $conn->prepare("UPDATE contacts SET name = ?, phone = ?, business = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name,  $phone,  $business, $id);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
      $response = array(
        'response' => 'correct'
      );
    } else {
      $response = array(
        'response' => 'error'
      );
    }
    $stmt->close();
    $conn->close();
  } catch (Exception $e) {
    $response = array(
      'error' => $e->getMessage()
    );
  }
  echo json_encode($response);
}
