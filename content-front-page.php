<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @@subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<section class="section banner-section" style="background-image:url('<?php the_field('banner_image');?>');"> <!-- Displays banner background image.-->
		<div class="container">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<div class="banner-inner">
					<?php the_field('banner_title');?> <!-- Displays Banner Title.-->
					<div class="form">
					    <form method="post" action="#" onsubmit="return newsletter_check(this)">
                                <div class="address"><input class="tnp-email" type="email" name="ne" placeholder="Enter Your Address" required>
                                <input class="tnp-submit" type="submit" value="Shop Now"></div>
                            </form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section welcome-section">     <!-- Used Advanced Custom Fields Pro Repeater Fields wich displays 3 colums in a row. -->
		<div class="container">
			<?php if (have_rows('intro_section')): 
				echo '<div class="row">';
				while (have_rows('intro_section')) : the_row(); 
					$icon_image = get_sub_field('intro_icon');
					$intro_title = get_sub_field('intro_title');
					$intro_desc = get_sub_field('intro_desc');
					echo '<div class="col-sm-4 col-md-4 col-xs-12">';
						echo '<div class="welcome-inner">';
							echo '<div class="icon-image">';
								echo wp_get_attachment_image( $icon_image, 'full' );
							echo '</div>';
							echo '<div class="welcome-detail">';
								echo '<h3><?php echo $intro_title;?></h3>';
								echo '<p>'.$intro_desc .'</p>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				endwhile;
			echo '</div>';
			endif;?>
		</div>
	</section>
	<section class="section categories-section">
		<div class="container">              
		<?php 
			/* Used ACF Pro field to map product categories using check boxes and user has to select 4 check boxes for the categories they want to display on home page.
			Set limit of 4 selection in order to maintain design of the website.*/
			
			$prod_cat = get_field('category_section');
			asort($prod_cat);
			$args = array(
				'include' =>  $prod_cat,
				'orderby' => 'include',
			);
			$terms = get_terms( 'product_cat', $args);
			if ( $terms ) {
				echo '<div class="row">';
				foreach ( $terms as $term ) {
					echo '<div class="col-sm-6 col-md-3 col-xs-12">';
					echo '<div class="categories-inner">';
					woocommerce_subcategory_thumbnail( $term );
					echo '<div class="category-title">';
					echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
					echo $term->name;
					echo '</a>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			}
		?>
		</div>
	</section>
	<section class="section product-section one">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-ms-12 col-xs-12">
				    <div class="section-title">
				        <h2><?php the_field('product_section_1_title');?></h2>
				    </div>
				</div>
			</div>
			<div class="row"> <!-- Displays categoriwise Product in this section. -->
			    <?php 
				
				/* Created ACF dropdown field which lists product categories and user has to select any one from the list in order to display products from that category. */
				
				$category = get_field('select_product_category');
				$args = array( 
					'post_type' => 'product', 
					'posts_per_page' => 4, 
					'product_cat' => $category->slug  
				);
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                echo '<div class="col-sm-6 col-md-3 col-xs-12">';
                    echo '<div class="row">';
                        echo '<div class="col-sm-6 col-md-6 col-xs-6">';
                            echo '<div class="product-image">';
							$prd_image = get_the_post_thumbnail(get_the_ID(),'full');
                                echo '<a href="' . get_the_permalink() .'">' . $prd_image . '</a>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-sm-6 col-md-6 col-xs-6">';
                            echo '<div class="product-detail">';
                                echo '<div class="product-title">';
                                    echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() .'</a></h3>';
                                echo '</div>';
                                echo '<div class="start-price">';
                                    echo '<p>Starting at</p>';
									wc_get_template_part('loop/price');
                                echo '</div>';
                                echo '<div class="read-more">';
                                    echo '<a href="' . get_the_permalink() .'">Shop</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                endwhile;
				wp_reset_query();?>
			</div>
		</div>
	</section>
	<section class="section product-section two">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-ms-12 col-xs-12">
				    <div class="section-title">
				        <h2><?php the_field('product_section_2_title');?></h2>
				    </div>
				</div>
			</div>
			<div class="row">  <!-- This is another loop to display products from another category. -->
			    <?php 
				/* Created ACF dropdown field which lists product categories and user has to select any one from the list in order to display products from that category. */
				
				$category2 = get_field('select_product_category_2');
				$args = array( 
					'post_type' => 'product', 
					'posts_per_page' => 4, 
					'product_cat' => $category2->slug  
				);
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                echo '<div class="col-sm-6 col-md-3 col-xs-12">';
                    echo '<div class="row">';
                        echo '<div class="col-sm-6 col-md-6 col-xs-6">';
                            echo '<div class="product-image">';
                                $prd_image = get_the_post_thumbnail(get_the_ID(),'full');
                                echo '<a href="' . get_the_permalink() .'">' . $prd_image . '</a>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-sm-6 col-md-6 col-xs-6">';
                            echo '<div class="product-detail">';
                                echo '<div class="product-title">';
                                    echo '<h3><a href="' . get_the_permalink() .'">'. get_the_title() .'</a></h3>';
                                echo '</div>';
                                echo '<div class="start-price">';
                                    echo '<p>Starting at</p>';
                                    wc_get_template_part('loop/price');
                                echo '</div>';
                                echo '<div class="read-more">';
                                    echo '<a href="' . get_the_permalink() .'">Shop</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                endwhile; 
				wp_reset_postdata();?>
			</div>
		</div>
	</section>
	<section class="section give-10-section">
		<div class="container">
			<?php 
			
			/*Create ACF pro Repeater Field to display secondary banner with 2 sections on front page. and used loop to display it.*/
			
			if(have_rows('bottom_banner_section')) : 
			echo '<div class="row">';
				while (have_rows('bottom_banner_section')) : the_row();
				$rows = get_row_index();
				$title = get_sub_field('banner_bottom_title');
				$link = get_sub_field('banner_button_link');
			    echo '<div class="col-sm-6 col-md-6 col-xs-12">';
					if($rows == 1){
						echo '<div class="give-inner left">';
					}else{
						echo '<div class="give-inner right">';
					}
				 
			            echo '<div class="row">';
			                echo '<div class="col-sm-7 col-md-7 col-xs-7">';
			                    echo '<div class="give-left">';
			                        echo '<h3>'. $title .'</h3>';
			                        echo '<a href="'. $link .'">Learn More</a>';
			                    echo'</div>';
			                echo '</div>';
			            echo '</div>';
			        echo '</div>';
			    echo '</div>';
				endwhile;
				echo '</div>';
			endif; ?>
			</div>
		</div>
	</section>
	<section class="section news-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-ms-12 col-xs-12">
				    <div class="section-title">
				        <h2><?php the_field('news_section_title');?></h2>
				    </div>
				</div>
			</div>
			<div class="row">
			    <?php 
				
				/*Create loop to display News Post on the front page. Put Drop down using ACF Pro which maps with post categories and the category which selected by user,\
				News will shown in this section according to that category.*/
				
				$news = get_field('select_news_category');
				$args = array( 
					'post_type' => 'post',
					'category_name' => $news->slug,
					'posts_per_page' => 4 
				);
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                echo '<div class="col-sm-6 col-md-3 col-xs-12">';
                    echo '<div class="news-inner">';
                        echo '<div class="news-image">';
                            echo '<a href="' . get_the_permalink().'">';
                                $news_image = get_the_post_thumbnail(get_the_ID(),'full');
                                echo '<a href="' . get_the_permalink() .'">' . $news_image . '</a>';
                                echo '<div class="overlay"></div>';
                            echo '</a>';
                        echo '</div>';
                        echo '<div class="news-detail">';
                            echo '<div class="news-meta">';
								the_time('F j, Y');
                            echo '</div>';
                            echo '<div class="news-title">';
                                echo '<h3><a href="' . get_the_permalink(). '">'. get_the_title() .'</a></h3>';
                            echo '</div>';
                            echo '<div class="read-more">';
                                echo '<a href="' . get_the_permalink() .'">Read Now <i class="fa fa-angle-right"></i></a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                endwhile; 
				wp_reset_query();?>
			</div>
		</div>
	</section>
	<section class="section newsletter-section">
		<div class="container">
			<div class="row">
			    <div class="col-sm-6 col-md-6 col-xs-12">
			        <div class="newsletter-left">
			            <h3><?php the_field('newsletter_section_title');?></h3>
			            <p><?php the_field('newsletter_section_subtitle');?></p>
			        </div>
			    </div>
			    <div class="col-sm-6 col-md-6 col-xs-12">
			        <div class="newsletter-right">
			            <div class="tnp tnp-subscription">
                            <form method="post" action="#" onsubmit="return newsletter_check(this)">
                                <input type="hidden" name="nlang" value="">
                                <div class="tnp-field tnp-field-email"><input class="tnp-email" type="email" name="ne" placeholder="Enter Email Address" required></div>
                                <div class="tnp-field tnp-field-button"><input class="tnp-submit" type="submit" value=""></div>
                            </form>
                        </div>
			        </div>
			    </div>
			</div>
		</div>
	</section>
</article><!-- #post-## -->
