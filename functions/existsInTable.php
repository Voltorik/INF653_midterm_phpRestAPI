<?php
// Checks if id exists in model's table
function existsInTable($id, $model) {
  $model->id = $id;
  $model->read_single();
  if ($model->id != null) {
      return true;
  }
  return false;
}