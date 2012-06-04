<?php

class Redactor extends Plugin {
	/**
	 * Add the required javascript
	 *
	 * @param Theme $theme The admin theme
	 */
	public function action_admin_header( $theme )
	{
		if ( $theme->page == 'publish' ) {
			Stack::add( 'admin_header_javascript', $this->get_url() . '/redactor/redactor.min.js', 'redactor', 'jquery' );
			Stack::add( 'admin_stylesheet', array( $this->get_url() . '/redactor/css/redactor.css', 'screen' ), 'redactor', 'admin-css' );

			$js = "$(document).ready( function(){ $('#content').redactor(); });";
			Stack::add( 'admin_header_javascript', $js, 'redactor_init', 'redactor' );
		}
	}

	/**
	 * Remove the change checking from the content textarea (from the TinyMCE plugin)
	 * @todo Need a better solution than this to the problem of incorrectly saying you're navigating away
	 *
	 * @param FormUI $form The publish form
	 * @param Post $post
	 */
	public function action_form_publish( $form, $post )
	{
		$key = array_search( 'check-change', $form->content->class );
		if ( $key !== FALSE ) {
			unset( $form->content->class[ $key ] );
		}
	}
}
?>
