<?php declare(strict_types = 1);

namespace Drupal\custom_action\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for custom_action routes.
 */
final class CustomActionController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t(''),
    ];

    return $build;
  }

}
