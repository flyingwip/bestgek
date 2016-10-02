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
    
      <div class="column style:background-image:url(<%=post.background_image %>)">
          <h3><%=post.type %></h3>  
          <div><%=post.title %></div>
          <div><%=post.slug %></div>
      </div>    
    
</script>


<script id="petitie" type="text/html">
    
      <div class="column" style="background-image:url(<%=post.background_image %>) ">
          <h3><%=post.type %></h3>
          <div><%=post.title %></div>
          <div><%=post.slug %></div>
      </div>    
    
</script>


<script id="gallery" type="text/html">
    
      <div class="column" ">
          <h3><%=post.type %></h3>
          <div><%=post.title %></div>
          <div><%=post.slug %></div>
      </div>    
    
</script>


<script id="video" type="text/html">
    
      <div class="column" style="background-image:url(<%=post.background_image %>) ">
          <h3><%=post.type %></h3>
          <div><%=post.title %></div>
          <div><%=post.slug %></div>
          <div><%=post.video %></div>
      </div>    
    
</script>


<script id="externe_link" type="text/html">
    
      <div class="column" style="background-image:url(<%=post.background_image %>) ">
          <h3><%=post.type %></h3>
          <div><%=post.title %></div>
          <div><%=post.slug %></div>
          <div><%=post.externe_link %></div>
      </div>    
    
</script>

<script id="quote" type="text/html">
    
      <div class="column" style="background:#61bec6;">
          <h3><%=post.type %></h3>  
          <div><%=post.title %></div>
          <div><%=post.slug %></div>
      </div>    
    
</script>



<div class="container grid">

  



  


</div>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
