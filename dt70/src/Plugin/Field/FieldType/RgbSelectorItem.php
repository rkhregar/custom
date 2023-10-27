<?php

declare(strict_types = 1);

namespace Drupal\dt70\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'dt70_rgb_selector' field type.
 *
 * @FieldType(
 *   id = "dt70_rgb_selector",
 *   label = @Translation("RGB Selector"),
 *   category = @Translation("General"),
 *   default_widget = "dt70_rgb_selector_default",
 *   default_formatter = "dt70_rgb_selector_default",
 * )
 */
final class RgbSelectorItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public function isEmpty(): bool {
    $red = $this->get('rgb_red')->getValue();
    $green = $this->get('rgb_green')->getValue();
    $blue = $this->get('rgb_blue')->getValue();
    $result = NULL;
    if (!empty($red) && !empty($green) && !empty($blue)) {
      $result = $red . $green . $blue;
    }
    return match ($result) {
      NULL, '' => TRUE,
      default => FALSE,
    };
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition): array {

    // @DCG
    // See /core/lib/Drupal/Core/TypedData/Plugin/DataType directory for
    // available data types.
    $properties['color_picker'] = DataDefinition::create('string')
      ->setLabel(t('Color Picker'));

    $properties['rgb_red'] = DataDefinition::create('string')
      ->setLabel(t('Red color'));

    $properties['rgb_green'] = DataDefinition::create('string')
      ->setLabel(t('Green color'));

    $properties['rgb_blue'] = DataDefinition::create('string')
      ->setLabel(t('Blue color'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition): array {

    $columns = [
      'color_picker' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Column description.',
        'length' => 255,
      ],
      'rgb_red' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Column description.',
        'length' => 255,
      ],
      'rgb_green' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Column description.',
        'length' => 255,
      ],
      'rgb_blue' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Column description.',
        'length' => 255,
      ],
    ];

    $schema = [
      'columns' => $columns,
    ];

    return $schema;
  }

}
