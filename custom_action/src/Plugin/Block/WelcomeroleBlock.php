<?php declare(strict_types = 1);

namespace Drupal\custom_action\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a welcomerole block.
 *
 * @Block(
 *   id = "custom_action_welcomerole",
 *   admin_label = @Translation("welcomeRole"),
 *   category = @Translation("Custom"),
 * )
 */
final class WelcomeroleBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs the plugin instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    private readonly AccountProxyInterface $currentUser,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new self(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $roles = $this->currentUser->getRoles();
    $role = $roles[1] ?? $roles[0];
    $build['content'] = [
      '#markup' => 'Welcome ' . $role,
    ];
    return $build;
  }

}
