<?php

declare(strict_types = 1);

namespace Drupal\dt70\Plugin\Field\FieldFormatter;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'rgb_selector' formatter.
 *
 * @FieldFormatter(
 *   id = "dt70_rgb_selector_default",
 *   label = @Translation("RGB Selector Formatter"),
 *   field_types = {"dt70_rgb_selector"},
 * )
 */
final class RgbSelectorFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = [];
    foreach ($items as $delta => $item) {
      $rgb_code = '#' . $item->rgb_red . $item->rgb_green . $item->rgb_blue;
      $html = "
      <h3 style='color : {$rgb_code}' >RGB Color code - {$rgb_code}</h3>
      <div style='background-color:{$rgb_code};'><h2>RGB Color {$rgb_code}</h2></div>

      <h3 style='color : {$item->color_picker}' >Color picker Color code - {$item->color_picker}</h3>
      <div style='background-color:{$item->color_picker};'><h2>Color Picker Color {$item->color_picker}</h2></div>
      ";
      $element[$delta] = [
        '#markup' => new FormattableMarkup($html, []),
      ];
    }
    return $element;
  }

}
