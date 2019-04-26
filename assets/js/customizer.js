/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
 
   "use strict";


   // Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
   } );

    
   // add new control  typhography
   wp.customize( 'custom_typhography_asdasd', function( value ) {
		value.bind( function( to ) {
         $( '.entry-content p' ).css( JSON.parse(to) );
        
		} );
   } );

   wp.customize( 'sample_alpa_color', function( value ) {
		value.bind( function( to ) {
      
         $( '.copyright-text p' ).css( {"color":to} );
        
		} );
   } );
   
   wp.customize( 'sample_gradient_colors', function( value ) {
		value.bind( function( to ) {
         var color = JSON.parse(to).background;
         var obj = [];
         $.each( color, function( key, value ) {
            $( '.page-banner-area' ).css( {"background" : value} );
          }); 
         
        
		} );
	} );
   //footer
   wp.customize( 'sample_tinymce_editor', function( value ) {
		value.bind( function( to ) {
         $( '.copyright-text p' ).text( to );
        
		} );
   } );
  // repeater
   wp.customize( 'customizer_repeater_examplesa', function( value ) {
		value.bind( function( to ) {
         var data = JSON.parse(to);
         var html = '<ul>';
         $.each( data, function( key, value ) {
            html += "<li>";
            html += value.title+"<br/> "+ value.subtitle; 
            html += "</li>";
          }); 
           html += '</ul>';
         $( '.entry-content p' ).html( html );
        
		} );
   } );

   //dimension

   wp.customize( 'custom_dimension_2nd', function( value ) {
		value.bind( function( to ) {
         var data = JSON.parse(to);  
      
         $( '.page-banner-area' ).css( data );
        
		} );
   } );

   wp.customize( 'custom_dimension_3nd', function( value ) {
		value.bind( function( to ) {
         var data = JSON.parse(to);  
 
         $( '.navbar.navbar-light' ).css( data );
        
		} );
   } );

   wp.customize( 'code_editor_css', function( value ) {
		value.bind( function( to ) {
       
		} );
   } );

   wp.customize( 'social_icon_picker_color', function( value ) {
		value.bind( function( to ) {
        $(".banner-title").html($(".banner-title").text() + '<i class="'+ to +'">'+'</i>');
		} );
   } );

   wp.customize( 'footer_widgets_layout_setting', function( value ) {
		value.bind( function( to ) {
        console.log(to);
		} );
   } );
   
} )( jQuery );
