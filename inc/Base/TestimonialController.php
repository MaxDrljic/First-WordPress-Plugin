<?php
/**
  * @package MaxPlugin
  */
namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

/**
 * 
 */
class TestimonialController extends BaseController
{
  public $callbacks;

  public $subpages = array();


  public function register()
  {
    if ( ! $this->activated( 'testimonial_manager' ) ) return;

    add_action( 'init', array( $this, 'testimonial_cpt') );
    add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
    add_action( 'save_post', array( $this, 'save_meta_box' ) );
  }

  public function testimonial_cpt ()
  {
    $labels = array(
      'name' => 'Testimonials',
      'singular_name' => 'Testimonial'
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-testimonial',
      'exclude_from_search' => true,
      'publicly_queryable' => false,
      'supports' => array( 'title', 'editor' )
    );

    register_post_type( 'testimonial', $args );
  }

  public function add_meta_boxes()
  {
    add_meta_box(
      'testimonial_author',
      'Testimonial Options',
      array( $this, 'render_features_box' ),
      'testimonial',
      'side',
      'default'
    );
  }

  public function render_features_box($post)
  {
    wp_nonce_field( 'max_testimonial', 'max_testimonial_nonce' );

    $data = get_post_meta( $post->ID, '_max_testimonial_key', true );
    $name = isset($data['name']) ? $data['name'] : '';
    $email = isset($data['email']) ? $data['email'] : '';
    $approved = isset($data['approved']) ? $data['approved'] : false;
    $featured = isset($data['featured']) ? $data['featured'] : false;
    ?>
    <p>
      <label class="meta-label" for="max_testimonial_author">Author Name</label>
      <input type="text" id="max_testimonial_author"
        name="max_testimonial_author" class="widefat" value="<?php echo esc_attr( $name ); ?>">
    </p>

    <p>
      <label for="max_testimonial_email" class="meta-label">Author Email</label>
      <input type="email" id="max_testimonial_email" name="max_testimonial_email"
      class="widefat" value="<?php echo esc_attr( $email ); ?>">
    </p>

    <div class="meta-container">
      <label for="max_testimonial_approved" class="meta-label w-50 text-left">Approved</label>
      <div class="text-right w-50 inline">
      <br />
        <div class="ui-toggle inline"><input type="checkbox" id="max_testimonial_approved" name="max_testimonial_approved" value="1" <?php echo $approved ? 'checked' : ''; ?>>
          <label for="max_testimonial_approved"><div></div></label>
        </div>
      </div>
    </div>
    <br />
    <div class="meta-container">
      <label for="max_testimonial_featured" class="meta-label w-50 text-left">Featured</label>
      <div class="text-right w-50 inline">
      <br />
        <div class="ui-toggle inline"><input type="checkbox" id="max_testimonial_featured" name="max_testimonial_featured" value="1" <?php echo $featured ? 'checked' : ''; ?>>
          <label for="max_testimonial_featured"><div></div></label>
        </div>
      </div>
    </div>

    <?php
  }

  public function save_meta_box($post_id)
  {
    if (! isset($_POST['max_testimonial_nonce'])) {
      return $post_id;
    }

    $nonce = $_POST['max_testimonial_nonce'];
    if (! wp_verify_nonce( $nonce, 'max_testimonial' )) {
      return $post_id;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return $post_id;
    }

    if (! current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
    }

    $data = array(
      'name' => sanitize_text_field( $_POST['max_testimonial_author'] ),
      'email' => sanitize_text_field( $_POST['max_testimonial_email'] ),
      'approved' => isset($_POST['max_testimonial_approved']) ? 1 : 0,
      'featured' => isset($_POST['max_testimonial_featured']) ? 1 : 0,
    );
    update_post_meta( $post_id, '_max_testimonial_key', $data );
  }
}
