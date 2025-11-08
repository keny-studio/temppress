// KENY - boilerplate - admin dashboard widget
  
<?php

add_action( 'wp_dashboard_setup', 'keny_register_dashboard_widget' );
function keny_register_dashboard_widget() {
	wp_add_dashboard_widget(
		'keny_dashboard_widget',
		'KENY.STUDIO', // widget name here
		'keny_dashboard_widget_display'
	);

}

function keny_dashboard_widget_display() {
    echo 'Hola, Hola KENY!'; // widget content here
}
