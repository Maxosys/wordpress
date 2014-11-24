<?php
	abstract Class AjaxLoginNew 
	{
		
		 public function __construct(){
        add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );

        add_action( 'wp_head', array( &$this, 'header' ) );

        add_action( 'wp_ajax_nopriv_validate_email', array( &$this, 'validate_email' ) );
        add_action( 'wp_ajax_validate_email', array( &$this, 'validate_email' ) );

        add_action( 'wp_ajax_nopriv_validate_username', array( &$this, 'validate_username' ) );
        add_action( 'wp_ajax_validate_username', array( &$this, 'validate_username' ) );

        add_action( 'wp_ajax_nopriv_load_template', array( &$this, 'load_template' ) );
        add_action( 'wp_ajax_load_template', array( &$this, 'load_template' ) );
    }

		 /**
     * Any additional code to be ran during wp_head
     *
     * Prints the ajaxurl in the html header.
     * Prints the meta tags template.
     */
    public function header(){
        print '<script type="text/javascript"> var ajaxurl = "'. admin_url("admin-ajax.php") .'";</script>';
        load_template( plugin_dir_path( dirname( __FILE__ ) ) . "views/meta-tags.php" );
    }
	
	
	
		public function load_template()
		{
			check_ajax_referer( $_POST['referer'],'security');
			load_template( plugin_dir_path( dirname( __FILE__ ) ) . "views/" . $_POST['template'] . '.php' );
			die();
		}
		
		
 /**
     * Process request to pass variables into WordPress' validate_username();
     *
     * @uses validate_username()
     * @param $username (string)
     * @param $is_ajax (bool) Process as an AJAX request or not.
     */
    public function validate_username( $username=null, $is_ajax=true ) {

        $username = empty( $_POST['login'] ) ? $username : $_POST['login'];

        if ( validate_username( $username ) && ! is_object( get_user_by( 'login', $username ) ) ) {
            $msg = null;
        } else {
            $msg =$this->status[2];
        }

        if ( $is_ajax ){
            print json_encode( $msg );
            die();
        } else {
            return $msg;
        }
    }		
		
		
		   /**
     * Check if an email is "valid" using PHPs filter_var & WordPress
     * email_exists();
     *
     * @param $email (string) Emailt to be validated
     * @param $is_ajax (bool)
     * @todo check ajax refer
     */
    public function validate_email( $email=null, $is_ajax=true ) {

        $email = is_null( $email ) ? $email : $_POST['email'];

        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $msg = email_exists( $email ) ? $this->status[3] : null;
        } else {
            $msg = $this->status[3];
        }

        if ( $is_ajax ){
            print json_encode( $msg );
            die();
        } else {
            return $msg;
        }
    }
	
		
		  public function enqueue_scripts( $scripts=null )
	{
        if ( empty( $this->scripts ) ) return;

        $dependencies = array(
            'jquery',
            'jquery-ui-core',
            'jquery-ui-widget',
            'jquery-ui-mouse',
            'jquery-ui-position',
            'jquery-ui-draggable',
            'jquery-ui-resizable',
            'jquery-ui-button',
            'jquery-ui-dialog'
        );

        wp_enqueue_style( 'ajax-login-style', plugin_dir_url( dirname( __FILE__ ) ) . "assets/style.css" );
        wp_enqueue_style( 'jquery-ui-custom', plugin_dir_url( dirname( __FILE__ ) ) . "assets/jquery-ui.css" );
        wp_enqueue_script( 'ajax-login-script', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/scripts.js', $dependencies  );

        foreach( $this->scripts as $script )
            wp_enqueue_script( $script, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/' . $script . '.js', array('jquery')  );

        if ( ! empty( $this->styles ) ){
            foreach( $this->styles as $style )
                wp_enqueue_style( $style, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/' . $style . '.css' );
        }
    }
		
	}

?>