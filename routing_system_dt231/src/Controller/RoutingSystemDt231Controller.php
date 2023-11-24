<?php declare(strict_types = 1);

namespace Drupal\routing_system_dt231\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Returns responses for Routing system dt231 routes.
 */
final class RoutingSystemDt231Controller extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(Request $request): array {
    $id = $request->get('id');
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works! and ID is = ' . $id),
    ];

    return $build;
  }

}
