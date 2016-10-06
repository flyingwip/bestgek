/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  var KWF = {

    grid: '',
    currentPage: 1,
    page: 1,
    setPage: function() {
       KWF.currentPage++;
       return true
    },
    getPosts: function() {
        // JavaScript to be fired on all pages
        //return 'yo';
        jQuery( function( $ ) {
          
            $.ajax( {
              url: 'wp-json/wp/v2/posts?filter[posts_per_page]=12&filter[paged]='+KWF.currentPage,
              success: function ( data ) {

                var new_data = ((data.length !== 0) ? KWF.setPage() : false);
                
                if(new_data){
                  //objects needs to be parsed  into a flat horzizontal json 
                  var parsedObjects = KWF.parsePosts(data); 
                  //npw parse data into templates
                  var parsedTemplates = KWF.parseTemplates(parsedObjects);  
                  //trigger evenet
                  $( document ).trigger( "postsReady", parsedTemplates );  
                  return   true;             
                } else {
                  return false;
                }
              
              },
              cache: false
            } );
        } );


      },
      addToGrid: function() {

        //lister to event
        $( document ).on( "postsReady", function( posts, parsedTemplates ) {
          
          $(parsedTemplates).appendTo('.grid').promise().done(function(){
            //console.log( 'nu klaar moeten zijn' ); // "bar"
            
            //do we need to do this every time???
            $('.flexslider').flexslider({slideshow: true, slideshowSpeed:4000});
            $("a[rel^='prettyPhoto']").prettyPhoto();
            
            return true;
          });  

          
      });
        return true;
      },
      infiniteScrolling: function(jsobjects) {
        var win = $(window);
        // Each time the user scrolls
        win.scroll(function() {
          // End of the document reached?
          if ($(document).height() - win.height() == win.scrollTop()) {
            ///$('#loading').show();

            console.log('load more posts for page ' + KWF.currentPage);
            //get some posts
            KWF.getPosts();
          }
        });

      },
      parsePosts: function(jsobjects) {
          var newArr = _.map(jsobjects, function (item) {
              return KWF.parsePost(item);
          });
          return newArr;
      },
      parsePost: function(jsobject) {

        var post = {};
        //if the object is of type gallery. The image url need
        // to be parsed as well
        if(jsobject.acf.type==='gallery'){
          //parse te gallery
          //make sure content is object and not a string
          if(typeof jsobject.content==='object'){
            post.gallery = KWF.parseGallery(jsobject.content);
          }
        } 

        post.id = jsobject.id;
        post.type = KWF.getData('type',jsobject.acf);
        post.title = KWF.getData('title',jsobject);
        post.content = KWF.getData('content',jsobject);
        post.slug = KWF.getData('slug',jsobject);
        post.afbeelding_een_kolom = KWF.getData('afbeelding_een_kolom',jsobject.acf);
        post.afbeelding_twee_kolommen = KWF.getData('afbeelding_twee_kolommen',jsobject.acf);
        post.externe_link = KWF.getData('externe_link',jsobject.acf);
        post.video = KWF.getData('video',jsobject.acf);
        post.externe_link = KWF.getData('externe_link',jsobject.acf);
        //console.log(post);
        return post;
      },
      getData: function( property,jsobject) {
          if( typeof jsobject[property] === 'string'){
            return jsobject[property];
          } else {
            return jsobject[property].rendered;  
          }
      },
      parseGallery: function(galleryObject) {

          gallery = [];
          var $gallery = $($.parseHTML( galleryObject.rendered )); 
          if($gallery){
            $gallery.find('figure div a img').each(function(i, obj){
              var figure = {};
              figure.original =  obj.src.replace("-150x150", "");   
              figure.afbeelding_een_kolom = KWF.getRightImage(obj.src, 1); 
              figure.afbeelding_twee_kolommen = KWF.getRightImage(obj.src, 2); 
              gallery[i] = figure;
            });
          }
          return gallery;

      },
      blaat: function() {
        alert('Blaat me!')
      },
      getRightImage: function(imageName, columnSize) {

          //find 150x150 and replace with 275x165
          if(columnSize===1){
            return imageName.replace("150x150", "265x275");   
          } else {
            return imageName.replace("150x150", "400x275"); 
          }
          


      },
      parseTemplates: function(jsobjects) {

          //map throught the array
          var currentRow = 0;
          var openRow = true;
          var amountColumns = 2;
          var column_layout = 0;
          var template = '';
          var grid = _.map(jsobjects, function (item, index) {

              //do I need to open a row? 
              if(openRow){
                //what kind of row . 2 or 3 column?
                if(KWF.isOdd(currentRow)){
                  amountColumns = 3;
                  column_layout = 3;
                } else {
                  amountColumns = 2;
                  column_layout = 2;
                }
                //now open row
                template += KWF.openRow();
                openRow = false;
              } 

              //get the right type template
              item = KWF.setBackgroundImage(item,column_layout);
              var post = KWF.getTypeTemplate(item, column_layout);
              
              //parse current item into right template
              template += KWF.parseColumn(post,column_layout);
              //console.log( template);
              amountColumns--;
              //do I need to close a row?
              if(amountColumns===0){
                //console.log( 'sluiten', currentRow);
                template += KWF.closeRow(); 
                currentRow++; 
                openRow = true;
              }
              return template;
          });
          return template;
      },
      isOdd: function(num) {
        return num % 2;
      },
      openRow: function() {
        return '<div class="row">';
      }, 
      closeRow: function() {
        return '</div>';
      },
      parseColumn: function(post, columns) {

        var template = '';
        if(columns===2){
          //template = $("#doubleColumn").html();
          template = '<div class="col-xs-12 col-sm-6" >' + post + '</div>';
        } else {
          template = '<div class="col-xs-12 col-sm-4" >' + post + '</div>';
        }
        
        return template;
      },
      getTypeTemplate: function(post,columnSize) {
        
        //var columnSize = columnSize;
        var post_type = post.type.replace(" ", "_");
        var template = $('#'+post_type).html();
        var compiled = _.template(template, {variable: 'post'});
        return  compiled( { id:post.id, type:post.type, title: post.title , slug:post.slug, 
          video:post.video, externe_link:post.externe_link,
          content:post.content, afbeelding_een_kolom:post.afbeelding_een_kolom,
          afbeelding_twee_kolommen : post.afbeelding_twee_kolommen ,
          background_image : post.background_image,
          gallery:post.gallery, columns:columnSize,
          blaat:KWF.blaat
        } );
        //return  compiled( {type:post.type, title: post.title , slug:post.slug, video:post.video, externe_link:post.externe_link} );
      },
      setBackgroundImage: function(post, columns) {


        if(columns===2){
          post.background_image = post.afbeelding_twee_kolommen;
        } else {
          post.background_image = post.afbeelding_een_kolom;
        }
        
        return post;
      }


  };

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
        KWF.getPosts() ;
        KWF.addToGrid();

        //enable 
        KWF.infiniteScrolling() ;



      },
      finalize: function() {
        

       
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
