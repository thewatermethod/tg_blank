<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class TwilitGrotto_Assets_Loader {

	public static function init() {

    // enqueue base scripts and styles
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );

    // add google analytics tracking code
		add_action( 'wp_footer', array( __CLASS__, 'ga_tracking_script' ) );

    // remove the emoji stuff from wordpress head
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
		
	}


 /*--------------------------------------------------------------------------------------
    *
    * Enqueue scripts
    *
    *--------------------------------------------------------------------------------------*/
     
   public static function enqueue_scripts() {
   		
      wp_enqueue_script( 'wp-a11y' );    

      /** Uncomment to use Font Awesome **/
      //wp_enqueue_script( 'fa', '//use.fontawesome.com/3ad4db6811.js', array(), null);   
      
      wp_enqueue_script( 'twilitgrotto-js', get_template_directory_uri() . '/compiled.js', array('jquery'), '20151215', true );

      if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
      }

   }
    
   /*--------------------------------------------------------------------------------------
    *
    * Enqueue styles
    *
    *--------------------------------------------------------------------------------------*/
    
   public static function enqueue_styles() {
      
      wp_enqueue_style( 'twilitgrotto', get_template_directory_uri() . '/compiled.css' );           

   }    


  public static function ga_tracking_script() {
		$ga_id = get_theme_mod( 'opts_ga_id', '' );
		if ( false === $ga_id ) {
			return;
		}
		?>

		<!-- Google Analytics Code -->
		<script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push( [ '_setAccount', '<?php echo $ga_id; ?>' ] );
            _gaq.push( [ '_trackPageview' ] );

            (function() {
                var ga = document.createElement( 'script' );
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName( 'script' )[ 0 ];
                s.parentNode.insertBefore( ga, s );
            })();
		</script>
		<?php
	}

}

