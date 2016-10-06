<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <?php get_template_part( 'templates/feature-image' ); ?>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <!-- <?php get_template_part('templates/entry-meta'); ?> -->
    </header>
    <div class="entry-content">

    <?php

    //what is the message type? 
    $value = get_field( "type" );
    // echo '<pre>';
    // print_r($value);
    // echo '</pre>';
    if($value=='petitie'):
    ?>
      <div class="cl">
        <?php the_content(); ?>
      </div>
      <div class="cr">  
        <?php get_template_part('templates/content-petitie'); ?>
       </div> 
     <?php else : ?>
        <?php the_content(); ?>
     <?php endif ; ?>  

    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>
