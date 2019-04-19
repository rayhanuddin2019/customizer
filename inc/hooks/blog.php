<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * hooks for wp blog part
 */

// if there is no excerpt, sets a defult placeholder
// ----------------------------------------------------------------------------------------
function ts_excerpt( $words = 20, $more = 'BUTTON' ) {
	if($more == 'BUTTON'){
		$more = '<a class="btn btn-primary">'.esc_html__('read more', 'ts').'</a>';
	}
	$excerpt		 = get_the_excerpt();
	$trimmed_content = wp_trim_words( $excerpt, $words, $more );
	echo wp_kses_post( $trimmed_content );
}

// comment walker
function ts_comment_style( $comment, $args, $depth ) {
	if ( 'div' === $args[ 'style' ] ) {
		$tag		 = 'div';
		$add_below	 = 'comment';
	} else {
		$tag		 = 'li ';
		$add_below	 = 'div-comment';
	}
	?>
	<?php
	if ( $args[ 'avatar_size' ] != 0 ) {
		echo get_avatar( $comment, $args[ 'avatar_size' ], '', '', array( 'class' => 'comment-avatar pull-left' ) );
	}
	?>
	<<?php
	echo wp_kses_post( $tag );
	comment_class( empty( $args[ 'has_children' ] ) ? '' : 'parent'  );
	?> id="comment-<?php comment_ID() ?>"><?php if ( 'div' != $args[ 'style' ] ) { ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php }
	?>	
		<div class="meta-data">
           
         <div class="pull-right reply"><?php
          
				comment_reply_link(
				array_merge(
				$args, array(
        			'add_below'	 => $add_below,
					'depth'		 => $depth,
               'max_depth'	 => $args[ 'max_depth' ],
               'reply_text' => __('<i class="fa fa-mail-reply-all"></i> Reply ', 'ts'),
               
				) ) );
				?>
			</div>


			<span class="comment-author vcard"><?php
				printf( wp_kses_post( '<cite class="fn">%s</cite> <span class="says">%s</span>', 'ts' ), get_comment_author_link(), esc_html__( 'says:', 'ts' ) );
				?>
			</span>
			<?php if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ts' ); ?></em><br/><?php }
			?>

			<div class="comment-meta commentmetadata comment-date">
				<?php
				// translators: 1: date, 2: time
				printf(
				esc_html__( '%1$s at %2$s', 'ts' ), get_comment_date(), get_comment_time()
				);
				?>
				<?php edit_comment_link( esc_html__( '(Edit)', 'ts' ), '  ', '' ); ?>
			</div>
		</div>	
		<div class="comment-content">
			<?php comment_text(); ?>
		</div>
		<?php if ( 'div' != $args[ 'style' ] ) : ?>
		</div><?php
	endif;
}



// add css class to submit button in comment
function add_submit_button_attr_class( $arg ) {
 
   $arg['class_submit'] = 'submit btn-comments btn btn-primary';
   return $arg;
}

add_filter( 'comment_form_defaults', 'add_submit_button_attr_class' );

// search
function ts_search_form( $form ) {
   $form = '
       <form  method="get" action="' . esc_url( home_url( '/' ) ) . '" class="ts-serach">
           <div class="input-group">
               <input type="search" class="form-control" name="s" placeholder="' .esc_attr__( 'Search', 'ts' ) . '" value="' . get_search_query() . '">
               <button class="input-group-btn"><i class="fa fa-search"></i></button>
           </div>
       </form>';
  return $form;
}
add_filter( 'get_search_form', 'ts_search_form' );

// nav

function ts_post_nav() {
   // Don't print empty markup if there's nowhere to navigate.
      $next_post	 = get_next_post();
      $pre_post	 = get_previous_post();
      if ( !$next_post && !$pre_post ) {
         return;
      }
   ?>
      <nav class="post-navigation clearfix">
         <div class="post-previous">
            <?php if ( !empty( $pre_post ) ): ?>
               <a href="<?php echo get_the_permalink( $pre_post->ID ); ?>">
                  <h3><?php echo get_the_title( $pre_post->ID ) ?></h3>
                  <span><i class="fa fa-long-arrow-left"></i><?php esc_html_e( 'Previous post', 'ts' ) ?></span>
               </a>
            <?php endif; ?>
         </div>
         <div class="post-next">
            <?php if ( !empty( $next_post ) ): ?>
               <a href="<?php echo get_the_permalink( $next_post->ID ); ?>">
                  <h3><?php echo get_the_title( $next_post->ID ) ?></h3>
   
                  <span><?php esc_html_e( 'Next post', 'ts' ) ?> <i class="fa fa-long-arrow-right"></i></span>
               </a>
            <?php endif; ?>
         </div>
      </nav>
   <?php }

