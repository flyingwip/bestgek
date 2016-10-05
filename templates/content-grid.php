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
            <h4><%=post.title %></h4>  
            <a href="<%=post.slug%>"><button>lees meer --></button></a>
          </div>  
      </div>    
    
</script>


<script id="petitie" type="text/html">
    
      <div class="column <%=post.type %>" style="background-image:url(<%=post.background_image %>) ">
        <div class="greybox">
          <h4><%=post.title %></h4>  
          <a href="<%=post.slug%>"><button>lees meer --></button></a>
        </div>  
      </div>    
    
</script>


<script id="gallery" type="text/html">
      <div class="column <%=post.type %>">
          <div class="greybox">
            <h4><%=post.title %></h4>  
            <a rel="prettyPhoto[pp_gal_<%=post.id%>]" href="<%=post.gallery[0].original %>"><button>Bekijk de foto's</button></a>
            <!-- <a href=""><button>Bekijk de foto's</button></a> -->
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
          <h4><%=post.title %></h4>  
          <a class="" rel="prettyPhoto" href="<%=post.video%>" ><button>Bekijk de video</button></a>
        </div>  
      </div>    
    
</script>


<script id="externe_link" type="text/html">
    
      <div class="column <%=post.type %>" style="background-image:url(<%=post.background_image %>) ">
        <div class="greybox">
            <h3><%=post.title %></h3>
            <a href="<%=post.externe_link%>"><button>lees meer --></button></a>
        </div>    
      </div>    
    
</script>

<script id="quote" type="text/html">
    
      <div class="column <%=post.type %>" style="background:#61bec6;">
          <div><%=post.content %></div>
          
      </div>    
    
</script>


<!-- The grid container -->
<div class="container grid"></div>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
