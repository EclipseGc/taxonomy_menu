<?php

/**
 * @file
 * Contains \Drupal\taxonomy_menu\Plugin\Menu\TaxonomyMenuMenuLink.
 */

namespace Drupal\taxonomy_menu\Plugin\Menu;

use Drupal\Core\Menu\MenuLinkBase;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\taxonomy_menu\Entity\TaxonomyMenu;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines menu links provided by taxonomy menu.
 *
 * @see \Drupal\taxonony_menu\Plugin\Derivative\TaxonomyMenuMenuLink
 */
class TaxonomyMenuMenuLink extends MenuLinkBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  protected $overrideAllowed = array(
    //'menu_name' => 1,
    //'parent' => 1,
    'weight' => 1,
    'expanded' => 1,
    'enabled' => 1,
    //'title' => 1,
    //'description' => 1,
    //'metadata' => 1,
  );

  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * The taxonomy menu.
   *
   * @var \Drupal\taxonomy_menu\TaxonomyMenu
   */
  protected $taxonomyMenu;

  /**
   * Constructs a new TaxonomyMenuMenuLink.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager
   * @param \Drupal\views\ViewExecutableFactory $view_executable_factory
   *   The view executable factory
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityManagerInterface $entity_manager, TaxonomyMenu $taxonomy_menu) {
    $this->configuration = $configuration;
    $this->pluginId = $plugin_id;
    $this->pluginDefinition = $plugin_definition;

    $this->entityManager = $entity_manager;
    $this->taxonomyMenu = $taxonomy_menu;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity.manager'),
      $container->get('taxonomy_menu')
    );
  }

  /**
   * {@inheritdoc}
   */
  /*public function updateLink(array $new_definition_values, $persist) {
    $overrides = array_intersect_key($new_definition_values, $this->overrideAllowed);
    // Update the definition.
    $this->pluginDefinition = $overrides + $this->pluginDefinition;
    if ($persist) {
      $view = $this->loadView();
      $display = &$view->storage->getDisplay($view->current_display);
      // Just save the title to the original view.
      $changed = FALSE;
      foreach ($new_definition_values as $key => $new_definition_value) {
        if (isset($display['display_options']['menu'][$key]) && $display['display_options']['menu'][$key] != $new_definition_values[$key]) {
          $display['display_options']['menu'][$key] = $new_definition_values[$key];
          $changed = TRUE;
        }
      }
      if ($changed) {
        // @todo Improve this to not trigger a full rebuild of everything, if we
        //   just changed some properties. https://www.drupal.org/node/2310389
        $view->storage->save();
      }
    }
    return $this->pluginDefinition;
  }*/

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
  }

  /**
   * {@inheritdoc}
   */
  public function isDeletable() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function updateLink(array $new_definition_values, $persist) {
    $overrides = array_intersect_key($new_definition_values, $this->overrideAllowed);
    // Update the definition.
    $this->pluginDefinition = $overrides + $this->pluginDefinition;
    if ($persist) {
      // TODO - Evaluate what to do if link gets updated
    }
    return $this->pluginDefinition;
  }

  /**
   * {@inheritdoc}
   */
  public function deleteLink() {
    // TODO - Evaluate what to do if link gets deleted
  }

}
