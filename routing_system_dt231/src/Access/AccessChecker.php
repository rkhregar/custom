<?php declare(strict_types = 1);

namespace Drupal\routing_system_dt231\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Symfony\Component\Routing\Route;

/**
 * Checks if passed parameter matches the route configuration.
 */
final class AccessChecker implements AccessInterface {

  /**
   * Access callback.
   */
  public function access(Route $route, mixed $id): AccessResult {
    return AccessResult::allowedIf(is_numeric($id));
  }

}
