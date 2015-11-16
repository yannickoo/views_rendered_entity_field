<?php

/**
 * @file
 * Contains views_rendered_entity_field\views_rendered_entity_field.views.inc..
 * Provide a custom views field data that isn't tied to any other module. */

/**
* Implements hook_views_data_alter().
*/
function views_rendered_entity_field_views_data_alter(array &$data) {
  foreach (\Drupal::entityManager()->getDefinitions() as $entity_type => $definition) {
    if ($definition->hasViewBuilderClass()) {
      $label = $definition->getLabel();
      $table = $definition->getBaseTable();

      $data[$table]['entity_rendered'] = [
        'title' => t('Rendered @entity-type', ['@entity-type' => $label]),
        'help' => t('The @entity-type of the current relationship rendered using a view mode.', ['@entity-type' => $label]),
        'field' => [
          'id' => 'entity_rendered',
        ],
      ];
    }
  }
}
