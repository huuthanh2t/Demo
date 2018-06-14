<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

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

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'twentyseventeen' ),
		'social' => __( 'Social Links Menu', 'twentyseventeen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'twentyseventeen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'twentyseventeen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$twentyseventeen_l10n = array(
		'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );



/**********************************************************
 **********************************************************
 ***	Theme  		 : SSJC								***
 ***	Author 		 : C-UNIT SQUARE					***
 ***	Description  : Custom function for this theme	***
 **********************************************************
 **********************************************************/
//add_filter('show_admin_bar', '__return_false');

/**
 * Function 	: get_image_banner()
 * Description  : get images banner
 * @return 		: image url_banner
 */
function get_image_banner() {
	$strImgPc = get_field( 'banner_image01' );
	$doc = new DOMDocument();   
	$doc->loadHTML($strImgPc);    
	$xpath = new DOMXPath($doc);    
	$images = $xpath->evaluate("//img");
	$i = 0;
	$txt = null;
	foreach ($images as $key => $image) {if ($key === 0) {$txt = '';}else{$txt = ',';} echo $txt .'"'. $image->getAttribute('src').'"';}
}
add_action( 'after_theme_setup', 'get_image_banner' );

/**
 * Function 	: change_default_jquery()
 * Description  : Remove defaut jQuery
 * @return 		: null
 
function change_default_jquery( ){
    wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');   
}
add_filter( 'wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX );
*/
/**
 * Function 	: get_img_upload_dir()
 * Description  : Get path of images from uploads dir
 * @return 		: path of image
 */
function get_img_upload_dir(){
	/*get path of uploads dir*/
	$img_path = wp_upload_dir();
	/*count arguments*/
	$numargs  = func_num_args();
	/*check arguments number*/
	if( $numargs == 1 )
		$sub_dir = '2018/03/' . func_get_arg(0);
	else if( $numargs == 2 )
		$sub_dir = func_get_arg(0) . '/' . func_get_arg(1);
	else
		$sub_dir = 'no-image.jpg';
	/*return path of image*/
	return $img_path['baseurl'] . '/' . $sub_dir;
}
add_action( 'after_theme_setup', 'get_img_upload_dir' );

/**
 * Function 	: homeURL()
 * Description  : Return url homepage
 * @return 		: string
 */
function homeURL() {
    return get_home_url();
}
add_shortcode("homeURL", "homeURL");

/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
add_filter( 'pre_get_document_title', 'custom_title' );
function custom_title(){
	if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
		$title = get_bloginfo( 'name', 'display' );
	}else{
		if( is_archive() )
			$title = get_the_archive_title( '', false ) . ' | ' . get_bloginfo( 'description' );
		else
			$title = get_the_title() . ' | ' . get_bloginfo( 'description' );
	}
	return $title;	
}

/**
 * Function 	: limit_content()
 * Description  : Limit content post
 * @return 		: $string
 */
function limit_content( $content, $limit, $more = null ){
	if ( $limit != '0'){
		$trimmed = wp_trim_words( $content, $num_words = $limit, $more = $more );
	}
	return $trimmed;
}

/**
 * Function 	: custom_pagination()
 * Description  : Custome & style for pagination
 * @return 		: pagination
 */
function custom_pagination( $numpages = '', $pagerange = '', $paged='', $show_first_last = true ) {
	/*set default page mid size*/
	if (empty($pagerange)) { $pagerange = 2; }
	/*set default page current*/
	global $paged;
	if (empty($paged)) { $paged = 1; }
	/*set default numpages total*/
	if ($numpages == '') {
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if(!$numpages) { $numpages = 1; }
	}
	/*fix url param of salon*/
	if( isset( $_GET['term_id'] ) && is_page( 'case' ) )
		$paramURL = '?term_id=' . $_GET['term_id'];
	else $paramURL = '';
	
	$strBase = get_pagenum_link(1) . '%_%';
	/*config*/
	$pagination_args = array(
		'base'            => str_replace( $paramURL, '', $strBase ),
		'format'          => 'page/%#%',
		'total'           => $numpages,
		'current'         => $paged,
		'show_all'        => false,
		'end_size'        => 1,
		'mid_size'        => $pagerange,
		'prev_next'       => true,
		'prev_text'       => __('〈'),
		'next_text'       => __('〉'),
		'type'            => 'plain',
		'add_args'        => false,
		'add_fragment'    => '',
		'before_page_number' => '',
		'after_page_number'  => ''
	);
	/*create page link*/
	$paginate_links = paginate_links($pagination_args);
	
	/*layout*/
	if ($paginate_links) {
		echo "<div class='st-pagelink' data='". $paged . "'>";
			if( $show_first_last ){
				if( $paged > 1 ){
					echo '<a class="first page-numbers" href="../1/' . $paramURL . '">&laquo;</a>';
				}
				echo $paginate_links;
				if( $paged == 1 ){
					echo '<a class="last page-numbers" href="page/' . $numpages . $paramURL . '">&raquo;</a>';
				}else if( $paged < $numpages ){
					echo '<a class="last page-numbers" href="../' . $numpages . $paramURL . '">&raquo;</a>';
				}
			}else{
				echo $paginate_links;
			}
		echo "</div>";
	}
}

/**
 * Function 	: custom_email_confirmation_validation_filter()
 * Description  : custom email confirmation validation filter
 * @return 		: $string
 */
function custom_email_confirmation_validation_filter( $result, $tag ) {
    $tag = new WPCF7_FormTag( $tag );
 
    if ( 'email-confirm' == $tag->name ) {
        $your_email = isset( $_POST['email'] ) ? trim( $_POST['email'] ) : '';
        $your_email_confirm = isset( $_POST['email-confirm'] ) ? trim( $_POST['email-confirm'] ) : '';
 
        if ( $your_email != $your_email_confirm ) {
            $result->invalidate( $tag, "メールアドレス(確認)が正しくないです。" );
        }
    }
 
    return $result;
}
add_filter( 'wpcf7_validate_email*', 'custom_email_confirmation_validation_filter', 20, 2 );

/**
 * Function 	: getlist_posts()
 * Description  : Get list
 * @return 		: array post
 */
function getlist_posts( $atts ) {
	
	/* default params */
	$atts = shortcode_atts(
		array(
			'max_posts'		   => -1,
			'pagination'	   => 'true',
			'limit_text'	   => 0,
			'taxonomy'		   => '',
			'term_id'		   => '',
			'template'		   => '',
			'paged'		   	   => 1,
			'posts_per_page'   => -1,
			'category'         => '',
			'category_name'    => '',
			'orderby'          => 'date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'post_type'        => 'post',
			'post_parent'      => '',
			'author'	   	   => '',
			'author_name'	   => '',
			'post_status'      => 'publish'
		), $atts
	);
	
	/* filter post by URL */
		// by category
	$cateID = isset( $_GET['cate_id'] ) ? $_GET['cate_id'] : $atts['category'];
		//by term_id 
	if( isset( $_GET['term_id'] ) ){
		$termID = $_GET['term_id'];
		$param_detail_url = '?term_id=' . $termID;
		$tax_query_custom = array(
			array(
				'taxonomy' => $atts['taxonomy'],
				'field' => 'term_id',
				'terms' => $termID
			)
		);
	}elseif( $atts['term_id'] != '' ){
		$tax_query_custom = array(
			array(
				'taxonomy' => $atts['taxonomy'],
				'field' => 'term_id',
				'terms' => $atts['term_id']
			)
		);
	}else{
		$param_detail_url = '';
		$tax_query_custom = '';
	}
	
	/* query posts */
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : $atts['paged'];
	$getlist_posts = new WP_Query( array(		
		'paged'			 => $paged,
		'posts_per_page' => $atts['max_posts'] != -1 ? $atts['max_posts'] : $atts['posts_per_page'],
		'cat'       	 => $cateID,
		'category_name'  => $atts['category_name'],
		'orderby'        => $atts['orderby'],
		'order'          => $atts['order'],
		'include'        => $atts['include'],
		'exclude'        => $atts['exclude'],
		'post_type'      => $atts['post_type'],
		'post_parent'    => $atts['post_parent'],
		'author'	   	 => $atts['author'],
		'author_name'	 => $atts['author_name'],
		'post_status'    => $atts['post_status'],
		'tax_query' 	 => $tax_query_custom,
		'pagination'	 => $atts['pagination']
	) );
	
	ob_start();
	if( $getlist_posts->have_posts() ) {
		
		/* get template post list */
		if( $atts['template'] != '' ) {
			$template_file = $atts['template'];
		} else {
			$template_file = 'template-list/' . $atts['post_type'] . '.php';
		}
		include( locate_template( $template_file ) );
		wp_reset_postdata();
		
		/* pagination */
		if( $atts['pagination'] == 'true' ){
			echo '<div class="nav-links">';
				if (function_exists(custom_pagination)) {
					custom_pagination( $getlist_posts->max_num_pages, "2", $paged, true );
				}
			echo '</div>';
		}
		
	}else{
		/* no post */
		//echo '<p>No post.</p>';
	}
	return ob_get_clean();
}
add_shortcode( 'GET_LIST', 'getlist_posts' );

/**
 * Function 	: getmore_topic()
 * Description  : Load more topic
 * @return 		: post
 */
add_action( 'wp_ajax_getmore_topic', 'getmore_topic' );
add_action( 'wp_ajax_nopriv_getmore_topic', 'getmore_topic' );
function getmore_topic() {
	$next_page = isset( $_POST['next_paged'] ) ? ' paged="' . $_POST['next_paged'] . '" ' : '';
	$category = isset( $_POST['cate_id'] ) ? ' category="' . $_POST['cate_id'] . '" ' : '';
	echo do_shortcode( '[GET_LIST' . $next_page . $category . ' posts_per_page="12" pagination="false" taxonomy="category" template="template-list/blog.php" limit_text="70"]' );
	die();
}

/**
 * Function 	: getmore_news()
 * Description  : Load more news
 * @return 		: post
 */
add_action( 'wp_ajax_getmore_news', 'getmore_news' );
add_action( 'wp_ajax_nopriv_getmore_news', 'getmore_news' );
function getmore_news() {
	$next_page = isset( $_POST['next_paged'] ) ? ' paged="' . $_POST['next_paged'] . '" ' : '';
	$category = isset( $_POST['cate_id'] ) ? ' term_id="' . $_POST['cate_id'] . '" ' : '';
	echo do_shortcode( '[GET_LIST post_type="practice_news" taxonomy="cate_practice_news"' . $next_page . $category . ' posts_per_page="12" pagination="false" template="template-list/news_archive.php" limit_text="70"]' );
	die();
}

/**
 * Contact Form 7
 * Set - radio_required.
 */
add_action( 'wpcf7_init', 'wpcf7_add_shortcode_radio_required' );
function wpcf7_add_shortcode_radio_required(){
wpcf7_add_shortcode( array('radio*'), 'wpcf7_checkbox_form_tag_handler', true );
}
add_filter( 'wpcf7_validate_radio*', 'wpcf7_checkbox_validation_filter', 10, 2 );

/**
 * Function 	: get_event_banner()
 * Description  : Return event banner
 * @return 		: array
 */
function get_event_banner() {
	$event_banner = get_field( 'event_main_visual', get_the_ID() );
    if( !empty( $event_banner ) ) {
		return '<div class="event_campus_banner" style="background-image: url(' . $event_banner['url'] . ');"</div>';
	}
}
add_shortcode("get_event_banner", "get_event_banner");