<?php
// Checks if id exists in model's table
function existsInTable($id, $model) {
  $model->id = $id;
  if ($model->read_single()) {
      return true;
  }
  return false;
}