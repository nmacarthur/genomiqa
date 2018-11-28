<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$backgroundImage = get_field('background_image');

$image = $backgroundImage['background_image'];
$imageOverlay = $backgroundImage['image_overlay'];
$backgroundEffect = $backgroundImage['background_effect'];
$invertColours = $backgroundImage['invert_colours'];
?>
<?php while ( have_posts() ) : the_post(); ?>
<section id="sub-header"

class="page-header page-header--work bg-effect--<?php echo $backgroundEffect ?> imagebg <?php if( $invertColours == 'yes' ): echo 'image--light'; endif; ?>"

>

<?php

if( !empty($image) ):

  // vars
  $url = $image['url'];
  $alt = $image['alt'];

  ?>
  <div class="background-image-holder">
    <img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>"/>
  </div>
<?php endif; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 ">
    <h6 class="subTitle"><?php the_title(); ?></h6>

      <h3 class="page-title"><?php echo get_field('subtitle'); ?></h3>


    </div>
  </div>
</div>



</section>

    <?php get_template_part( 'page-templates/blocks' ); ?>



<section class="related-posts" style="background:url('http://genomiqa.local/wp-content/uploads/2018/11/bg.png')">
  <div class="container">
    <div class="row">
      <div class="col">
        <h6 class="subTitle">The full picture</h6>
        <h2>Other products and services</h2>
      </div>
    </div>
    <div class="row">
          <?php

          $currentID = get_the_ID();

          $args = array(
              'post__not_in' => array($currentID),
              'showposts' => '2',
              'post_type'=> 'product',
              'orderby' => 'rand'
              );

          $the_query = new WP_Query( $args );

          if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();  
          ?>

            <div class='col-md-6'>
              <?php

                get_template_part( 'loop-templates/content-product', get_post_format() );

              ?>
            </div>

          <?php endwhile; endif;
          /*
           * Include the Post-Format-specific template for the content.
           * If you want to override this in a child theme, then include a file
           * called content-___.php (where ___ is the Post Format name) and that will be used instead.
           */
          ?>
      </div>
    </div>


</section>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
