<?php
/**
 * Create a form with a managed file field for the background image.
 * 
 * @return
 *   A form with managed file fields.
 */
function adno_backgrounds_form($form, &$form_state) {
  $form['#attributes'] = array('enctype' => "multipart/form-data");

  $backgrounds = variable_get('adno_backgrounds', array());
  $background_slots = variable_get('adno_background_slots', '1');

  $form['intro'] = array(
    '#type' => 'item',
    '#markup' => t('Here you can upload background images that will be randomly shown to the site visitor. After uploading an image, please press Save. A new image upload slot will be made available.')
  );

  for($i=0; $i < $background_slots; $i++) {
    $form['background_image_' . $i] = array(
      '#title' => t('Background image'),
      '#type' => 'managed_file',
      '#description' => t('Allowed file types: gif, png, jpg, jpeg. Max filesize: ' . ADNO_CUSTOM_BACKGROUND_IMAGE_MAX_FILE_SIZE . 'MB'),
      '#default_value' => isset($backgrounds[$i]['file_id']) ? $backgrounds[$i]['file_id'] : 0,
      '#upload_location' => ADNO_CUSTOM_BACKGROUND_IMAGE_FOLDER,
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
        'file_validate_size' => array(ADNO_CUSTOM_BACKGROUND_IMAGE_MAX_FILE_SIZE*1024*1024),
      ),
    );
  }

  $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save'),
  );

  return $form;
}

/**
 * Submit handler for the background form.
 * 
 * @param $form
 * @param $form_state 
 */
function adno_backgrounds_form_submit($form, &$form_state) {
  // Load the current available slots to loop through the background form
  // results and regenerate the backgrounds array.
  $background_slots = variable_get('adno_background_slots', '0');
  $backgrounds = array();
  for($i=0; $i < $background_slots; $i++) {
    if (isset($form_state['values']['background_image_' . $i]) && $form_state['values']['background_image_' . $i]) {
      $backgrounds[] = array('file_id' => $form_state['values']['background_image_' . $i]);
    }
  }

  // Add an extra slot based on the use amount of background images.
  $background_slots = count($backgrounds) + 1;
  variable_set('adno_background_slots', $background_slots);

  // Save the new backgrounds and update the file status.
  variable_set('adno_backgrounds', $backgrounds);
  if (!empty($backgrounds)) {
    foreach ($backgrounds as $background) {
      _adno_custom_background_image_update_file_status($background['file_id']);
    }
  }

  drupal_set_message(t('The background settings have been saved'), 'status');
}

/**
 * Updates a file's status to permanent.
 *
 * @param $file_id
 *   The file id.
 */
function _adno_custom_background_image_update_file_status($file_id) {
  // Load the file via file id.
  if ($file = file_load($file_id)) {
    if ($file->status != FILE_STATUS_PERMANENT) {
      // Change status to permanent.
      $file->status = FILE_STATUS_PERMANENT;
      // Save the modified file.
      file_save($file);
      // Add a reference.
      file_usage_add($file, 'adno_custom', 'background_image', $file_id);
    }
  }
}

/**
 * System settings form builder for the adno admin page.
 * 
 * @return 
 *   A system settings form for configuring the footer text.
 */
function adno_custom_settings() {

  $digipolis_custom_footer = variable_get('digipolis_custom_footer', array('value' => '', 'format' => filter_default_format()));

  $form['digipolis_custom_footer'] = array(
    '#type' => 'text_format',
    '#title' => t('Footer content'),
    '#default_value' => $digipolis_custom_footer['value'],
    '#description' => t('The text that is shown in the footer.'),
    '#format' => $digipolis_custom_footer['format'],
  );

  return system_settings_form($form);
}