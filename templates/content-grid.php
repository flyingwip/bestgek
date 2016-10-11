<?php// the_content(); ?>

<script id="doubleColumn" type="text/html">
    <div class="col-xs-12 col-sm-6">
    </div>
</script>


<script id="tripleColumn" type="text/html">
    <div class="col-xs-12 col-sm-4">
      
    </div>
</script>

<script id="blog" type="text/html">
    
      <div class="column <%=post.type %>" style=background-image:url(<%=post.background_image %>)>
          <div class="greybox">
            <div class="bottombox">
              <h4><%=post.title %></h4>  
              <a href="<%=post.slug%>"><button class="white">Lees meer</button></a>  
            </div>
          </div>  
      </div>    
    
</script>


<script id="petitie" type="text/html">
    
      <div class="column <%=post.type %>" style="background-image:url(<%=post.background_image %>) ">
        <div class="greybox">
          <div class="bottombox">
              <h4><%=post.title %></h4>  
              <a href="<%=post.slug%>"><button class="white">Lees meer</button></a>  
            </div>
        </div>  
      </div>    
    
</script>


<script id="gallery" type="text/html">
      <div class="column <%=post.type %>">
          <div class="greybox">
            <div class="bottombox">
              <h4><%=post.title %></h4>  
              <a rel="prettyPhoto[pp_gal_<%=post.id%>]" href="<%=post.gallery[0].original %>"><button class="white">Bekijk de foto's</button></a>
              <!-- <a href=""><button>Bekijk de foto's</button></a> -->
            </div>  
          </div> 
          <div class="flexslider">
            <ul class="slides">
              <% _.each(post.gallery, function(figure) { %> 
                <li>
                  <a href="<%=figure.original%>" rel="prettyPhoto[pp_gal_<%=post.id%>]" title="">
                  <% if(post.columns===2){ %>
                    <img src="<%=figure.afbeelding_twee_kolommen%>" />
                  <% } else {  %> 
                    <img src="<%=figure.afbeelding_een_kolom%>" />  
                  <% } %>
                  </a>    
                </li>
              <% }); %>               
            </ul>
          </div>   
      </div>    
    
</script>


<script id="video" type="text/html">
    
      <div class="column <%=post.type %>" style="background-image:url(<%=post.background_image %>) ">
          <div class="greybox">
          <div class="bottombox">
            <h4><%=post.title %></h4>  
            <a class="" rel="prettyPhoto" href="<%=post.video%>" ><button class="white">Bekijk de video</button></a>
          </div>  
        </div>  
      </div>    
    
</script>


<script id="externe_link" type="text/html">
    
      <div class="column <%=post.type %>" style="background-image:url(<%=post.background_image %>) ">
        <div class="greybox">
          <div class="bottombox">
              <h4><%=post.title %></h4>
              <a href="<%=post.externe_link%>"><button class="white">Lees meer</button></a>
          </div>    
        </div>    
      </div>    
    
</script>





<script id="quote" type="text/html">
    
      <div class="column <%=post.type %>" style="background:#61bec6;">
          <div><%=post.content %></div>
          
      </div>    
    
</script>

<?php
$banner = new WP_Query(array('post_type' => 'banner', 'posts_per_page' => 1,'post_status' => array('publish')));


while ($banner->have_posts()) : $banner->the_post();
?>
  <!-- The Banner -->
  <div class="container banner">
    <div class="row" style="background:url(<?php echo get_field('achtergrond', $banner->posts[0]->ID ); ?>">
      <?php

      $fields = get_post_custom( $banner->posts[0]->ID );
      // echo '<pre>';
      // print_r($fields);
      // echo '</pre>';
      ?>
      <!-- linker kolom -->
      <div class="col-xs-12 col-sm-6" >
      <?php
          echo get_field('linker_kolom', $banner->posts[0]->ID );
          //echo($fields['rechter_kolom'][0]);
      ?>
      </div>

      <!-- rechter kolom -->
      <div class="col-xs-12 col-sm-6 dv_color" >
      <?php
          echo get_field('rechter_kolom', $banner->posts[0]->ID );
          //echo($fields['rechter_kolom'][0]);
      ?>

      </div>

    </div>
  </div>
<?php
endwhile;
wp_reset_query(); ?>


<!-- The grid container -->
<div class="container grid">
  

</div>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
