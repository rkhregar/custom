<?php declare(strict_types = 1);

namespace Drupal\routing_system_dt231\EventSubscriber;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Route subscriber.
 */
final class RoutingSystemDt231RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection): void {
    // @see https://www.drupal.org/node/2187643
    if ($route = $collection->get('routing_system_dt231.campaign_value')) {
      $route->setRequirement('_role', 'administrator');
    }
  }

}
