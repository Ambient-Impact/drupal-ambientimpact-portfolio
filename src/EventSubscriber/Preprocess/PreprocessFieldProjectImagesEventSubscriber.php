<?php

namespace Drupal\ambientimpact_portfolio\EventSubscriber\Preprocess;

use Drupal\ambientimpact_core\ComponentPluginManager;
use Drupal\hook_event_dispatcher\Event\Preprocess\FieldPreprocessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Project images template_preprocess_field() event subscriber service class.
 *
 * @see \Drupal\hook_event_dispatcher\Event\Preprocess\FieldPreprocessEvent
 */
class PreprocessFieldProjectImagesEventSubscriber
implements EventSubscriberInterface {
  /**
   * The Ambient.Impact Component plugin manager service.
   *
   * @var \Drupal\ambientimpact_core\ComponentPluginManager
   */
  protected $componentManager;

  /**
   * Event subscriber constructor; saves dependencies.
   *
   * @param \Drupal\ambientimpact_core\ComponentPluginManager $componentManager
   *   The Ambient.Impact Component plugin manager service.
   */
  public function __construct(
    ComponentPluginManager $componentManager
  ) {
    $this->componentManager = $componentManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      FieldPreprocessEvent::name() => 'preprocessField',
    ];
  }

  /**
   * Prepares variables for field_project_images templates.
   *
   * This replaces the image style on odd numbered last items from
   * 'project_image_small' to 'project_image_large' so that the image is high
   * resolution enough to look good when spanning the full width of the field.
   *
   * @param \Drupal\hook_event_dispatcher\Event\Preprocess\FieldPreprocessEvent $event
   *   The template_preprocess_field event.
   *
   * @see \Drupal\ambientimpact_media\Plugin\AmbientImpact\Component\Image::preprocessFieldSetImageFieldMaxWidth()
   *   This adds a max-width on each field item.
   */
  public function preprocessField(FieldPreprocessEvent $event) {
    /* @var \Drupal\hook_event_dispatcher\Event\Preprocess\Variables\FieldEventVariables $variables */
    $variables  = $event->getVariables();
    $items      = &$variables->getItems();

    if (
      $variables->get('field_name') !== 'field_project_images' ||
      empty($items) ||
      // Skip fields that don't have an odd number of items.
      count($items) % 2 === 0
    ) {
      return;
    }

    end($items);

    $lastItem = &$items[key($items)];

    if (
      empty($lastItem['content']['#image_style']) ||
      $lastItem['content']['#image_style'] !== 'project_image_small'
    ) {
      return;
    }

    $lastItem['content']['#image_style'] = 'project_image_large';

    // Now we just need to get the 'image' component to set the field max-width
    // with the new value.
    $imageComponent = $this->componentManager->getComponentInstance('image');

    $items = [&$lastItem];

    $imageComponent->preprocessFieldSetImageFieldMaxWidth($items);
  }
}