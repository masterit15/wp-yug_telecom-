/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	wp.customize( 'notification', function( value ) {
		value.bind( function( to ) {
      var defaultCount = 170
      if (to.length > defaultCount){
        var count = Number(to.length) - Number(defaultCount)
        $('.notification').addClass('error')
        $('.notification_text').html('Вы превысили количество символов на '+count+' знак(ов)!')
      }else{
        $('.notification').removeClass('error')
        $('.notification_text').text(to)
      }
		} );
	} );
// 	wp.customize( 'blogdescription', function( value ) {
// 		value.bind( function( to ) {
// 			$( '.site-description' ).text( to );
// 		} );
// 	} );

// 	// Header text color.
// 	wp.customize( 'header_textcolor', function( value ) {
// 		value.bind( function( to ) {
// 			if ( 'blank' === to ) {
// 				$( '.site-title, .site-description' ).css( {
// 					clip: 'rect(1px, 1px, 1px, 1px)',
// 					position: 'absolute',
// 				} );
// 			} else {
// 				$( '.site-title, .site-description' ).css( {
// 					clip: 'auto',
// 					position: 'relative',
// 				} );
// 				$( '.site-title a, .site-description' ).css( {
// 					color: to,
// 				} );
// 			}
// 		} );
// 	} );
}( jQuery ) );
