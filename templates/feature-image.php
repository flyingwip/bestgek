<?php // code taken from: http://wordpress.org/support/topic/retrieveing-featured-image-url#post-1801898 ?>
<?php if (has_post_thumbnail( get_the_ID() )): ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
  <div id="featured-image" >
  	<img src="<?php echo $image[0]; ?>">
  	<a href="javascript:history.back();"><button class="blue"><-- Terug</button></a>
  </div>
<?php endif; ?>