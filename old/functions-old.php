<?php
/**
 * OSI Starter Theme functions and definitions
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since OSI Starter Theme 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'osi_starter_theme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since OSI Starter Theme 1.0
 */
function osi_starter_theme_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on OSI Starter Theme, use a find and replace
	 * to change 'osi_starter_theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'osi_starter_theme', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'osi_starter_theme' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // osi_starter_theme_setup
add_action( 'after_setup_theme', 'osi_starter_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since OSI Starter Theme 1.0
 */
function osi_starter_theme_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'osi_starter_theme' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'osi_starter_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function osi_starter_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'osi_starter_theme_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'events',
		array(
			'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'Events' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'events'),
			'supports' => array('title', 'editor', 'thumbnail'),
			'taxonomies' => array('category')
		)
	);
	register_post_type( 'directors',
		array(
			'labels' => array(
				'name' => __( 'Directors' ),
				'singular_name' => __( 'Directors' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'directors'),
      'taxonomies' => array('category'),
      'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
		)
	);
  register_post_type( 'committees',
    array(
      'labels' => array(
        'name' => __( 'Committees' ),
        'singular_name' => __( 'Committees' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'committees'),
      'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
    )
  );
}

add_action( 'admin_head', 'cpt_icons' );
function cpt_icons() {
    ?>
    <style type="text/css" media="screen">
		#menu-posts-directors .wp-menu-image {
      background: url(<?php bloginfo('template_url') ?>/images/directors.png) no-repeat 6px -17px !important;
    }
    #menu-posts-events .wp-menu-image {
      background: url(<?php bloginfo('template_url') ?>/images/speaker.png) no-repeat 6px -17px !important;
    }
    #menu-posts-committees .wp-menu-image {
      background: url(<?php bloginfo('template_url') ?>/images/committees.png) no-repeat 6px -17px !important;
    }
		#menu-posts-directors:hover .wp-menu-image, #menu-posts-directors.wp-has-current-submenu .wp-menu-image,
    #menu-posts-events:hover .wp-menu-image, #menu-posts-events.wp-has-current-submenu .wp-menu-image,
		#menu-posts-committees:hover .wp-menu-image, #menu-posts-committees.wp-has-current-submenu .wp-menu-image {
            background-position: 6px 7px!important;
        }
    </style>
<?php }

/* =Custom Post Type Meta Boxes
---------------------------------------------*/
//Custom Date meta box for sorting by date

    //We create an array called $meta_box and set the array key to the relevant post type
    $meta_box['events'] = array(
       
        //This is the id applied to the meta box
        'id' => 'events-meta',  
       
        //This is the title that appears on the meta box container
        'title' => 'What\'s the Event Date',    
       
        //This defines the part of the page where the edit screen section should be shown
        'context' => 'side',    
       
        //This sets the priority within the context where the boxes should show
        'priority' => 'high',
       
        //Here we define all the fields we want in the meta box
        'fields' => array(
            
            array(
                'name' => 'Date:',
                'desc' => 'Ex: <strong>2012-05-25</strong><br /> 2012 - Year, 05 - May, 25 - Day',
                'id' => 'events-date',
                'type' => 'date',
                'default' => ''
            )
        )
    );
	add_action('admin_menu', 'events_add_box');

	    //Add meta boxes to post types
    function events_add_box() {
        global $meta_box;
       
        foreach($meta_box as $post_type => $value) {
            add_meta_box($value['id'], $value['title'], 'events_format_box', $post_type, $value['context'], $value['priority']);
        }
    }

        //Format meta boxes
    function events_format_box() {
      global $meta_box, $post;
     
      // Use nonce for verification
      echo '<input type="hidden" name="events_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
     
      echo '<table class="form-table">';
     
      foreach ($meta_box[$post->post_type]['fields'] as $field) {
          // get current post meta data
          $meta = get_post_meta($post->ID, $field['id'], true);
     
          echo '<tr>'.
                  '<th style="width:20%"><label for="'. $field['id'] .'">'. $field['name']. '</label></th>'.
                  '<td>';
          switch ($field['type']) {
              case 'text':
                  echo '<input type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
                  break;
              case 'textarea':
                  echo '<textarea name="'. $field['id']. '" id="'. $field['id']. '" cols="60" rows="4" style="width:97%">'. ($meta ? $meta : $field['default']) . '</textarea>'. '<br />'. $field['desc'];
                  break;
              case 'select':
                  echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '">';
                  foreach ($field['options'] as $option) {
                      echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option>';
                  }
                  echo '</select>';
                  break;
              case 'radio':
                  foreach ($field['options'] as $option) {
                      echo '<input type="radio" name="' . $field['id'] . '" value="' . $option['value'] . '"' . ( $meta == $option['value'] ? ' checked="checked"' : '' ) . ' />' . $option['name'];
                  }
                  break;
              case 'checkbox':
                  echo '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '"' . ( $meta ? ' checked="checked"' : '' ) . ' />';
                  break;
              case 'date':
                  echo '<input type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. date('Y-m-d',($meta ? $meta : $field['default'])) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
                  break;
          }
          echo     '<td>'.'</tr>';
      }
     
      echo '</table>';
     
    }

        // Save data from meta box
    function events_save_data($post_id) {
        global $meta_box,  $post;
       
        //Verify nonce
        if (!wp_verify_nonce($_POST['events_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
     
        //Check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
     
        //Check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
       
        foreach ($meta_box[$post->post_type]['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = strtotime($_POST[$field['id']]);
           
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    } 
    add_action('save_post', 'events_save_data');



// --------------------------------------------
// --------------------------------------------    
//Custom Meta box Meeting Times for committees
 //We create an array called $meta_box and set the array key to the relevant post type
    $committees_meta_box['committees'] = array(
        //meta box setup
        'id' => 'committees-meta',  
        'title' => 'What are the meeting dates?',
        'context' => 'side',    
        'priority' => 'high',
        'fields' => array(
            
            //Field setup
            array(
                'name' => 'Day:',
                'desc' => 'What day of the week?',
                'id' => 'meeting-day',
                'type'  => 'select',
                'options' => array (  
                  'Monday',
                  'Tuesday',
                  'Wednesday',
                  'Thursday',
                  'Friday',
                  'Saturday',
                  'Sunday'
                ), 
                'default' => ''
            ),
            array(
                'name' => 'Time:',
                'desc' => 'What time of the day?',
                'id' => 'meeting-time',
                'type' => 'text',
                'default' => ''
            ),
            array(
                'name' => 'Location:',
                'desc' => 'Where is the meeting at?',
                'id' => 'meeting-location',
                'type' => 'text',
                'default' => ''
            )
        )
    );
  add_action('admin_menu', 'committees_add_box');

      //Add meta boxes to post types
    function committees_add_box() {
        global $committees_meta_box;
       
        foreach($committees_meta_box as $post_type => $value) {
            add_meta_box($value['id'], $value['title'], 'committees_format_box', $post_type, $value['context'], $value['priority']);
        }
    }

        //Format meta boxes
    function committees_format_box() {
      global $committees_meta_box, $post;
     
      // Use nonce for verification
      echo "<script src='http://osi.ucf.edu/cab/testing/js/test.js'></script>";
      echo '<input type="hidden" name="committees_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
     
      echo '<table class="form-table">';
     
      foreach ($committees_meta_box[$post->post_type]['fields'] as $field) {
          // get current post meta data
          $meta = get_post_meta($post->ID, $field['id'], true);
     
          echo '<tr>'.
                  '<th style="width:20%"><label for="'. $field['id'] .'">'. $field['name']. '</label></th>'.
                  '<td>';
          switch ($field['type']) {
              case 'text':
                  echo '<input type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
                  break;
              case 'textarea':
                  echo '<textarea name="'. $field['id']. '" id="'. $field['id']. '" cols="60" rows="4" style="width:97%">'. ($meta ? $meta : $field['default']) . '</textarea>'. '<br />'. $field['desc'];
                  break;
              case 'select':
                  echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '">';
                  foreach ($field['options'] as $option) {
                      echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option>';
                  }
                  echo '</select>';
                  break;
          }
          echo     '<td>'.'</tr>';
      }
     
      echo '</table>';
     
    }

        // Save data from meta box
    function committees_save_data($post_id) {
        global $committees_meta_box,  $post;
       
        //Verify nonce
        if (!wp_verify_nonce($_POST['committees_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
     
        //Check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
     
        //Check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
       
        foreach ($committees_meta_box[$post->post_type]['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];
           
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    } 
    add_action('save_post', 'committees_save_data');

// Remove these from main menu
function remove_menus () {
  global $menu;
  $restricted = array( __('Posts'), __('Media'), __('Links'), __('Tools'), __('Comments'), __('Plugins'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
  }
}
add_action('admin_menu', 'remove_menus');


// Purpose: Add META text to the menu

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
