<?php
/**
 * twilitgrotto functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package twilitgrotto
 */


TwilitGrotto::_init();

class TwilitGrotto {

   static $path;
	
   // ! @static int $excerpt_length How long excerpts should be
	static $excerpt_length = 20;
   
   // ! @static string $excerpt_more The trailing string for excerpts
   static $excerpt_more = '... ';
   
   // ! @static bool $show_toolbar Whether or not to show the toolbar on the front end
   static $show_toolbar = false;
   
   // ! @static array $nav_menus The unique menus for this theme
   static $nav_menus = array(
   		array(
   			'slug' => 'main-menu',
   			'name' => 'Main Menu',
   		),
   );

	// @static array _dynamic_sidebars The dynamic sidebars for this theme
   static $dynamic_sidebars = array(
    	array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar-1',
			'description'   => 'Add widgets here.', 'twilitgrotto',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
    	),
      array(
      'name'          => 'Subfooter',
      'id'            => 'sidebar-2',
      'description'   => 'Add widgets here.', 'twilitgrotto',
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
      ),

   );

   // ! @static array $default_widgets The default widgets that we want to unregister
   static $default_widgets = array(
 		'WP_Widget_Pages',                  // Pages Widget
		'WP_Widget_Calendar',        		// Calendar Widget
		'WP_Widget_Archives',         		// Archives Widget
		'WP_Widget_Links',         			// Links Widget
		'WP_Widget_Meta',         			// Meta Widget
		'WP_Widget_Search',         		// Search Widget
		'WP_Widget_Text',         			// Text Widget
		'WP_Widget_Categories',         	// Categories Widget
		'WP_Widget_Recent_Posts',         	// Recent Posts Widget
		'WP_Widget_Recent_Comments',        // Recent Comments Widget
		'WP_Widget_RSS',         			// RSS Widget
		'WP_Widget_Tag_Cloud',         		// Tag Cloud Widget
		'WP_Nav_Menu_Widget',         		// Menus Widget
	);


   static $url = '';

   static $shortcodes = array(
    	/*
    	array(
     		'name' => the name of the shortcode
     		'callback' => the callback function that handles the shortcode
     	)
     	*/
   );

   // ! @static array $admin_menus_to_hide A list of admin menus to hide
   static $admin_menus_to_hide = array(
      /*
    	'index.php',						// Dashboard
    	'edit.php',							// Posts
    	'upload.php',						// Media
    	'link-manager.php',				// Links
    	'edit.php?post_type=page',		// Pages
    	'edit-comments.php',				// Comments
    	'themes.php',						// Themes
    	'plugins.php',						// Plugins
    	'users.php',						// Users
    	'tools.php',						// Tools
    	'options-general.php'			// Settings
      */
   );  


   // ! @static array $dashboard_widgets_to_hide A list of dashboard widgets to hide
   static $dashboard_widgets_to_hide = array(
 		// 'side' => array(
 		// 	'dashboard_quick_press',
 		// 	'dashboard_recent_drafts',
 		// 	'dashboard_primary',
 		// 	'dashboard_secondary',
 		// ),
 		// 'normal' => array(
 		// 	'dashboard_incoming_links',
 		// 	'dashboard_right_now',
 		// 	'dashboard_plugins',
 		// 	'dashboard_recent_comments',
 		// ),
    );

 
   /*--------------------------------------------------------------------------------------
    *
    * Initialize
    *
    *--------------------------------------------------------------------------------------*/
     
	public static function _init() {

      	
		//set the theme's base path
  	self::$path = get_stylesheet_directory();
    
  	// Set the theme's base url
  	self::$url = get_stylesheet_directory_uri();

		// Add theme support for menus
		self::register_nav_menus(); 
		
		// Register custom post types
		add_action('init', array(__CLASS__, 'register_post_types'));

		// Register dynamic sidebars
		add_action('init', array(__CLASS__, 'register_sidebars'));
		

		//Load the themes and styles
   	  	include_once 'inc/class-assets-loader.php';
   	  	TwilitGrotto_Assets_Loader::init();

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on twilitgrotto, use a find and replace
		 * to change 'twilitgrotto' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twilitgrotto', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'twilitgrotto_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		if ( ! isset( $content_width ) ) $content_width = 640;

	} // Closes Twilit Grotto: init()

   /*--------------------------------------------------------------------------------------
    *
    * Change the default excerpt length
    *
    * @param int $length The desired excerpt length
    * @return int
    *
    *--------------------------------------------------------------------------------------*/
     
    public static function change_excerpt_length( $length ) {

   		return self::$excerpt_length;

	}
    
   /*--------------------------------------------------------------------------------------
    *
    * Change the default more [...]
    * @param string $more The default more text
    * @return string The new more text
    *
    *--------------------------------------------------------------------------------------*/
     
   public static function change_excerpt_more( $more ) {

		return self::$excerpt_more;

   }  
   /*--------------------------------------------------------------------------------------
    *
    * Hide admin menu items
    * @uses $menu
    *
    *--------------------------------------------------------------------------------------*/
    
  	public static function hide_admin_menu_items() {
   		global $menu;

		if ( empty(self::$admin_menus_to_hide) ) return;
		
      	foreach ( $menu as $key => $item ){ 
      		if ( in_array($item[2], self::$admin_menus_to_hide) ){
      			unset($menu[$key]);
      		}
      	}
    }
   
   /*--------------------------------------------------------------------------------------
    *
    * Hide dashboard widgets
    * @uses $wp_meta_boxes
    *
    *--------------------------------------------------------------------------------------*/
    
   public static function hide_dashboard_widgets() {
    	global $wp_meta_boxes;
    	
    	foreach ( (array) self::$dashboard_widgets_to_hide as $context => $boxes ) {
    		foreach ( $boxes as $boxname ) {
    			unset($wp_meta_boxes['dashboard'][$context]['core'][$boxname]);
    		}
    	}
   }
   
   /*--------------------------------------------------------------------------------------
    *
    * Register navigation menus for this theme
    *
    *--------------------------------------------------------------------------------------*/
    
   public static function register_nav_menus() {

	   	if ( empty(self::$nav_menus) ) return false;
	   	
	   	add_theme_support('menus');
	   	
	   	foreach ( self::$nav_menus as $menu ) {
	   	    register_nav_menu($menu['slug'], $menu['name']);
	   	}

   }        

   /*--------------------------------------------------------------------------------------
    *
    * Register the custom post types for this theme
    *
    *
    *--------------------------------------------------------------------------------------*/
     
	public static function register_post_types(){ 
		
		include_once self::$path . '/inc/post-types.php';		

	}

	/*--------------------------------------------------------------------------------------
	 *
	 * Register this theme's dynamic sidebars
	 *
	 *--------------------------------------------------------------------------------------*/
      
	public static function register_sidebars() {

		array_map('register_sidebar', self::$dynamic_sidebars);

	}

	/*--------------------------------------------------------------------------------------
	 *
	 * Gets the template url including an optional path
	 * @param string $path
	 * @param bool $echo
	 *
	 *--------------------------------------------------------------------------------------*/
	
	public static function theme_url( $path = '', $echo = true ){
		
		if ( $echo ) {
			echo self::$url . str_replace('//', '/', '/' . $path);
		} else {
			return self::$url . str_replace('//', '/', '/' . $path);
		}

	}


} // Closes Twilit Grotto class




/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
