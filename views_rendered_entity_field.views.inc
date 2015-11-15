<?php

/**
 * @file
 * Contains views_rendered_entity_field\views_rendered_entity_field.views.inc..
 * Provide a custom views field data that isn't tied to any other module. */

/**
* Implements hook_views_data().
*/
function views_rendered_entity_field_views_data() {
  $data = [];

  $data['views']['entity_rendered'] = [
    'title' => t('Rendered entity'),
    'help' => t('Provides rendered entity in a specific view mode.'),
    'field' => [
      'id' => 'entity_rendered',
    ],
  ];

  return $data;
}
