<?php
/**
* @package MaxPlugin
*/
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

/**
 * 
 */
class Admin extends BaseController
{
  public $settings;

  public $callbacks;

  public $pages = array();

  public $subpages = array();

  public function register() 
  {
    $this->settings = new SettingsApi();

    $this->callbacks = new AdminCallbacks();

    $this->setPages();

    $this->setSubpages();

    $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
  }

  public function setPages()
  {
    $this->pages = array(
      array(
        'page_title' => 'Max Plugin',
        'menu_title' => 'Max',
        'capability' => 'manage_options',
        'menu_slug' => 'max_plugin',
        'callback' => array( $this->callbacks, 'adminDashboard' ),
        'icon_url' => 'dashicons-store',
        'position' => 110
      )
    );
  }

  public function setSubpages()
  {
    $this->subpages = array(
      array(
        'parent_slug' => 'max_plugin',
        'page_title' => 'Custom Post Types',
        'menu_title' => 'Max',
        'capability' => 'manage_options',
        'menu_slug' => 'max_cpt',
        'callback' => function() { echo '<h1>CPT Manager</h1>'; }
      ),
      array(
        'parent_slug' => 'max_plugin',
        'page_title' => 'Custom Taxonomies',
        'menu_title' => 'Taxonomies',
        'capability' => 'manage_options',
        'menu_slug' => 'max_taxonomies',
        'callback' => function() { echo '<h1>Taxonomies Manager</h1>'; }
      ),
      array(
        'parent_slug' => 'max_plugin',
        'page_title' => 'Custom Widgets',
        'menu_title' => 'Widgets',
        'capability' => 'manage_options',
        'menu_slug' => 'max_widgets',
        'callback' => function() { echo '<h1>Widgets Manager</h1>'; },
      )
    );
  }
}