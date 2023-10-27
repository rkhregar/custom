<?php

declare(strict_types = 1);

namespace Drupal\dt70\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the 'dt70_rgb_selector' field widget.
 *
 * @FieldWidget(
 *   id = "dt70_rgb_selector_default",
 *   label = @Translation("RGB Selector"),
 *   field_types = {"dt70_rgb_selector"},
 * )
 */
class RgbSelectorWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings(): array {
    $setting = [
      'rgb_red_label' => 'Red',
      'rgb_green_label' => 'Green',
      'rgb_blue_label' => 'Blue',
    ];
    return $setting + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state): array {
    $form = parent::settingsForm($form, $form_state);
    $form['rgb_red'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Red'),
      '#default_value' => $this->getSetting('rgb_red_label'),
    ];
    $form['rgb_green'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Green'),
      '#default_value' => $this->getSetting('rgb_green_label'),
    ];
    $form['rgb_blue'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Blue'),
      '#default_value' => $this->getSetting('rgb_blue_label'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(): array {
    $summary[] = $this->t('Red: @label', ['@label' => $this->getSetting('rgb_red_label')]);
    $summary[] = $this->t('Green: @label', ['@label' => $this->getSetting('rgb_green_label')]);
    $summary[] = $this->t('Blue: @label', ['@label' => $this->getSetting('rgb_blue_label')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state): array {
    if (empty($element['#description'])) {
      $element['#description'] = $this->t('Acceptable charaters are [0-9 and A-F]');
    }
    $element['rgb_group'] = $element + [
      '#type' => 'fieldset',
    ];
    $element['rgb_group']['rgb_red'] = [
      '#title' => $this->getSetting('rgb_red_label'),
      '#type' => 'textfield',
      '#default_value' => $items[$delta]->rgb_red,
      '#pattern' => '^[0-9a-fA-F]{2}$',
      '#required' => $element['#required'],
    ];
    $element['rgb_group']['rgb_green'] = [
      '#pattern' => '^[0-9a-fA-F]{2}$',
      '#required' => $element['#required'],
      '#type' => 'textfield',
      '#title' => $this->getSetting('rgb_green_label'),
      '#default_value' => $items[$delta]->rgb_green,
    ];
    $element['rgb_group']['rgb_blue'] = [
      '#required' => $element['#required'],
      '#type' => 'textfield',
      '#title' => $this->getSetting('rgb_blue_label'),
      '#pattern' => '^[0-9a-fA-F]{2}$',
      '#default_value' => $items[$delta]->rgb_blue,
    ];
    return $element['rgb_group'];
  }

}
