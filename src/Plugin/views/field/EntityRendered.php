<?php

/**
 * @file
 * Contains \Drupal\views_rendered_entity_field\Plugin\views\field\EntityRendered.
 */

namespace Drupal\views_rendered_entity_field\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * A handler to provide a field for rendered entity.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("entity_rendered")
 */
 class EntityRendered extends FieldPluginBase {
   /**
    * {@inheritdoc}
    */
   public function query() {}

  /**
   * {@inheritdoc}
   */
   protected function defineOptions() {
     $options = parent::defineOptions();
     $options['view_mode'] = ['default' => 'default'];

     return $options;
   }

  /**
   * {@inheritdoc}
   */
   public function buildOptionsForm(&$form, FormStateInterface $form_state) {
     parent::buildOptionsForm($form, $form_state);

     $view_modes = \Drupal::entityManager()->getViewModeOptions($this->definition['entity_type']);

     $form['view_mode'] = array(
       '#type' => 'select',
       '#title' => $this->t('View mode'),
       '#required' => TRUE,
       '#options' => $view_modes,
       '#default_value' => isset($this->options['view_mode']) ? $this->options['view_mode'] : '',
     );
   }

  /**
   * {@inheritdoc}
   */
   public function render(ResultRow $row) {
     $entity = $this->getEntity($row);
     $entity_type = $entity->getEntityTypeId();
     $view_mode = $this->options['view_mode'];
     $render_controller = \Drupal::entityManager()->getViewBuilder($entity_type);
     $build = $render_controller->view($entity, $view_mode);

     return $build;
   }

}
