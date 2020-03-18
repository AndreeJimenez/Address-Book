<?php

function getContacts()
{
  include 'db.php';
  try {
    return $conn->query("SELECT id, name, business, phone FROM contacts");
  } catch (Exception $e) {
    echo "Error!" . $e->getMessage() . "<br>";
    return false;
  }
}

// Obtiene un contacto toma un id.

function obtenerContacto($id)
{
  include 'db.php';
  try {
    return $conn->query("SELECT id, name, business, phone FROM contacts WHERE id = $id");
  } catch (Exception $e) {
    echo "Error!" . $e->getMessage() . "<br>";
    return false;
  }
}
