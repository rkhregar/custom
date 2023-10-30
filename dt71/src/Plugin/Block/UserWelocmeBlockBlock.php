<?php

declare(strict_types = 1);

namespace Drupal\dt71\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an user welocme block block.
 *
 * @Block(
 *   id = "dt71_user_welocme_block",
 *   admin_label = @Translation("User welocme block"),
 *   category = @Translation("Custom"),
 * )
 */
final class UserWelocmeBlockBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
    $html = '';
    if ($this->currentUser->isAuthenticated()) {
      $roles = $this->currentUser->getRoles();
      $roles = $roles[1] ?? $roles[0];
      $name = $this->currentUser->getDisplayName();
      $html = 'Welcome ' . $roles . ' ' . $name;
    }
    $build['content'] = [
      '#markup' => $html,
    ];
    return $build;
  }

}
