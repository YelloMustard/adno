<?php

/**
* Implements template_preprocess_page().
*
* Fetches the available background images and sets the background_image variable
* to contain a random background image.
*/
function adno_preprocess_page(&$vars) {
  // Fetch available backgrounds.
  $backgrounds = variable_get('adno_backgrounds', array());

  // Generate a random background ID.
  $random_background_id = rand(0, count($backgrounds) - 1);

  $vars['background_image'] = '';
  // Set the background_image variable if the random background has a file_id.
  if (isset($backgrounds[$random_background_id]['file_id']) && $backgrounds[$random_background_id]['file_id']) {
    $background_image = file_load($backgrounds[$random_background_id]['file_id']);
    $vars['background_image'] = theme('image', array('path' => file_create_url($background_image->uri)));
  }
}

/**
 * Add specific classes to language links.
 */
function adno_links__locale_block(&$vars) {
  $output = '<ul class="menu">';
  $output .= '<li class="leaf">' . t('Choose your language:') . '</li>';
  foreach ($vars['links'] as $language => $link) {
    $output .= '<li class="leaf">' . l($language, isset($link['href']) ? $link['href'] : '<front>', array(
      'attributes' => array(
        'class' => array('link-' . $language)
      ),
      'language' => $link['language']
    )) . '</li>';
  }
  $output .= '</ul>';
  return $output;
}


function adno_preprocess_html(&$vars) {
  if (!empty($vars['page']['submenu'])) { 
    $vars['classes_array'][] = 'submenu'; 
  } 
}