<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<main id="skip-content" role="main">

	<?php do_action( 'automobile_shop_above_slider' ); ?>

	<?php if( get_theme_mod('automobile_shop_slider_hide_show') != ''){ ?>
		<section id="slider">
			<div id="carouselExampleIndicators" class="carousel" data-ride="carousel"> 
			    <?php $automobile_shop_slider_pages = array();
			    for ( $count = 1; $count <= 4; $count++ ) {
			        $mod = intval( get_theme_mod( 'automobile_shop_slider'. $count ));
			        if ( 'page-none-selected' != $mod ) {
			          $automobile_shop_slider_pages[] = $mod;
			        }
			    }
		      	if( !empty($automobile_shop_slider_pages) ) :
			        $args = array(
			          	'post_type' => 'page',
			          	'post__in' => $automobile_shop_slider_pages,
			          	'orderby' => 'post__in'
			        );
		        	$query = new WP_Query( $args );
		        if ( $query->have_posts() ) :
		          	$i = 1;
		    	?>     
				    <div class="carousel-inner" role="listbox">
				      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
					        <div <?php if($i == 1){echo 'class="carousel-item fade-in-image active"';} else{ echo 'class="carousel-item fade-in-image"';}?>>
		            			<div class="slider-img text-right">
		            				<img src="<?php esc_url(the_post_thumbnail_url('full')); ?>" alt="<?php the_title_attribute(); ?> "/>
		            			</div>
		            			<div class="carousel-caption">
						            <div class="inner-carousel">
						              	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						              	<a href="<?php the_permalink(); ?>" class="read-btn"><span><?php echo esc_html('READ MORE','automobile-shop'); ?></span></a>
				            		</div>
				            	</div>
					        </div>
				      	<?php $i++; endwhile; 
				      	wp_reset_postdata();?>
				    </div>
			    <?php else : ?>
			    	<div class="no-postfound"></div>
	      		<?php endif;
			    endif;?>
			    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			      	<span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
			      	<span class="screen-reader-text"><?php esc_html_e( 'Prev','automobile-shop' );?></span>
			    </a>
			    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			      	<span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
			      	<span class="screen-reader-text"><?php esc_html_e( 'Next','automobile-shop' );?></span>
			    </a>
			</div>
		  	<div class="clearfix"></div>
		</section>
	<?php }?>
	
	<?php do_action('automobile_shop_below_slider'); ?>

	<?php if(get_theme_mod('automobile_shop_section_title') != '' || get_theme_mod('automobile_shop_small_title') != '' || get_theme_mod('automobile_shop_category_setting') != ''){ ?>
		<section id="service-section" class="py-5">
			<div class="container">
				<div class="service-head text-center mb-5">
					<?php if(get_theme_mod('automobile_shop_small_title') != ''){?>
						<p class="small-title"><?php echo esc_html(get_theme_mod('automobile_shop_small_title')); ?></p>
					<?php }?>
					<?php if(get_theme_mod('automobile_shop_section_title') != ''){?>
						<h3><?php echo esc_html(get_theme_mod('automobile_shop_section_title')); ?></h3>
					<?php }?>
				</div>
				<?php $automobile_shop_catData1 =  get_theme_mod('automobile_shop_category_setting');
				if($automobile_shop_catData1){ 
					$args = array(
						'post_type' => 'post',
						'category_name' => esc_html($automobile_shop_catData1 ,'automobile-shop'),
						'post_per_page' => get_theme_mod('automobile_shop_service_number',4)
			        );
			        $i=1; ?>
			        <div class="row">
		        		<?php $query = new WP_Query( $args );
			          	if ( $query->have_posts() ) :
			        		while( $query->have_posts() ) : $query->the_post(); ?>
			          			<div class="col-lg-3 col-md-6">
			          				<div class="service-box mb-4">
	          							<div class="service-img text-center">
	          								<?php the_post_thumbnail(); ?>
	          								<div class="overlay"></div>
	          								<div class="service-content">
		      									<i class="<?php echo esc_attr(get_theme_mod('automobile_shop_service_icon' . $i, 'fas fa-car')); ?> mb-2"></i>
								              	<p class="mb-2"><?php $automobile_shop_excerpt = get_the_excerpt(); echo esc_html( automobile_shop_string_limit_words( $automobile_shop_excerpt,8 ) ); ?></p>
								              	<a href="<?php the_permalink(); ?>" class="read-btn"><?php echo esc_html('Read More','automobile-shop'); ?><span class="screen-reader-text"><?php echo esc_html('Read More','automobile-shop'); ?></span></a>
				            				</div>
		      							</div>
					            		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			          				</div>
							    </div>
			          		<?php $i++; endwhile; 
			          		wp_reset_postdata(); ?>
			          	<?php else : ?>
			              	<div class="no-postfound"></div>
			            <?php endif; ?>
	          		</div>
	      		<?php }?>
			</div>
		</section>
	<?php }?>

	<?php do_action('automobile_shop_below_service_section'); ?>

	<div class="container">
	  	<?php while ( have_posts() ) : the_post(); ?>
	  		<div class="lz-content">
	        	<?php the_content(); ?>
	        </div>
	    <?php endwhile; // end of the loop. ?>
	</div>
</main>

<?php get_footer(); ?>