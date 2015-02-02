<?php
if ( post_password_required() )
	return;
?>

			<section id="blog-post-comments" class="blog-post-comments">
			    <?php if ( have_comments() ) : ?>
				<!-- Inner  -->
				<section class="inner-section">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h1><?php
				printf( _nx( 'One Comment', '%1$s comments', get_comments_number(), 'comments title', 'secretlang' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			    ?></h1>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">

					<ul>
					<?php
						$args = array(
							'walker'            => null,
							'max_depth'         => '',
							'style'             => 'ul',
							'callback'          => 'secret_format_comments',
							'end-callback'      =>  null,
							'type'              => 'all',
							'reply_text'        => 'Reply',
							'page'              => '',
							'per_page'          => '',
							'avatar_size'       => 32,
							'reverse_top_level' => null,
							'reverse_children'  => '',
							'format'            => 'xhtml', //or html5 @since 3.6
							'short_ping'        => false // @since 3.6
						);			
						wp_list_comments($args); 
					?>
				   </ul><!-- .comment-list -->

                            </div>	
						</div>
					</div>
				</section>
                <?php
				  // Are there comments to navigate through?
				 if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			     ?>
					<nav class="navigation comment-navigation" role="navigation">
						<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'secretlang' ); ?></h1>
						<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'secretlang' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'secretlang' ) ); ?></div>
					</nav><!-- .comment-navigation -->
					<?php endif; // Check for comment navigation ?>

					<?php if ( ! comments_open() && get_comments_number() ) : ?>
					<p class="no-comments"><?php _e( 'Comments are closed.' , 'secretlang' ); ?></p>
					<?php endif; ?>              
             <?php endif; // have_comments() ?>
			</section>

<?php if (comments_open()){ ?>
		<!-- Blog Post Contact Form : starts -->
			<section id="blog-post-contact-form" class="blog-post-contact-form  pad-bottom-100 bg-color-grey">
				<section class="inner-section">
					<div class="container pad-top pad-bottom bg-color-light">
						<div class="row">
							<div class="col-md-offset-3 col-md-6 contact-form">
<?php							
	$commenter = wp_get_current_commenter();
	$args = array( 'fields' => apply_filters( 'comment_form_default_fields', 

		array(
		'author' => '<input class="blog-cnt-input" id="author" name="author" type="text"placeholder="'.__('Name','secretlang').'"  value="' .esc_attr( $commenter['comment_author'] ) . '"  />',
		'email'  => '<input id="email" class="blog-cnt-input" name="email" type="text" placeholder="'.__('Email','secretlang').'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" />',
		'url'    => '<input id="url" class="blog-cnt-input" name="url" type="text" placeholder="'.__('Website','secretlang').'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />' ) ),
		'comment_field' =>'<div><textarea id="comment" class="textbox" name="comment" cols="45" rows="10" tabindex="4" placeholder="'.__('Comment','secretlang').'" aria-required="true"></textarea></div>',
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be logged in to post a comment.' ,'secretlang') ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%s">%s</a>.</p>','secretlang' ), admin_url( 'profile.php' ), $user_identity ),
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_form' => 'comments-form',
		'id_submit' => 'post-comment',
		'title_reply' => __( 'Leave a Comment' ,'secretlang'),
		'title_reply_to' => __( 'Leave a reply to %s' ,'secretlang'),
		'cancel_reply_link' => __( 'Cancel reply' ,'secretlang'),
		'label_submit' => __( 'Leave A Comment' ,'secretlang'),
	);
	comment_form($args);
?>
							</div>
						</div>
					</div>

				</section>	
			</section>
		<!-- Blog Post Contact Form : ends -->
<?php } 