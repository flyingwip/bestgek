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

    getPosts: function() {
        // JavaScript to be fired on all pages
        //return 'yo';
        jQuery( function( $ ) {
          
            $.ajax( {
              url: 'wp-json/wp/v2/posts?filter[posts_per_page]=8&filter[paged]=1',
              success: function ( data ) {
                   
                //objects needs to be parsed  into a flat horzizontal json 
                var parsedObjects = KWF.parsePosts(data); 

                //npw parse data into templates
                var parsedTemplates = KWF.parseTemplates(data);                 

                
                // var template = $("#doubleColumn").html();
                // var compiled = _.template($("#doubleColumn").html(), {variable: 'post'});
                // $(".grid").html( compiled( {title: post.title , slug:post.slug} ) );          
                //$("#doubleColumn").tmpl(post).appendTo(".grid");
                
              },
              cache: false
            } );
        } );


      },
      parsePosts: function(jsobjects) {
          var newArr = _.map(jsobjects, function (item) {
              return KWF.parsePost(item);
          });
          return newArr;
      },
      parsePost: function(jsobject) {
        
        var post = {};
        post.type = KWF.getData('type',jsobject.acf);
        post.title = KWF.getData('title',jsobject);
        post.content = KWF.getData('content',jsobject);
        post.slug = KWF.getData('slug',jsobject);
        post.afbeelding_een_kolom = KWF.getData('afbeelding_een_kolom',jsobject.acf);
        post.afbeelding_een_kolom = KWF.getData('afbeelding_een_kolom',jsobject.acf);
        post.afbeelding_twee_kolommen = KWF.getData('afbeelding_twee_kolommen',jsobject.acf);
        post.externe_link = KWF.getData('externe_link',jsobject.acf);
        post.video = KWF.getData('video',jsobject.acf);
        post.externe_link = KWF.getData('externe_link',jsobject.acf);
        
        return post;
      },
      getData: function( property,jsobject) {
          if( typeof jsobject[property] == 'string'){
            return jsobject[property]
          } else {
            return jsobject[property].rendered;  
          }
      },
      parseTemplates: function(jsobjects) {

          //map throught the array
          var openRow = true;
          var amountColumns = 2;
          var newArr = _.map(jsobjects, function (item, index) {

              //do I need to open a row? 
              if(openRow){

                //what kind of row . 2 or 3 column?
                if(KWF.isOdd(currentRow)){
                  amountColumns = 3;
                } else {
                  amountColumns = 2;
                }
                //now open row
                KWF.openRow();  
                //console.log('huidige rij', currentRow);
                openRow = false;
              } 

              //console.log('parse kolom');
              //parse cuurent item into right template
              amountColumns--;
              //do I need to close a row?
              if(amountColumns==0){
                KWF.closeRow();  
                openRow = true;
              }

              //return KWF.todoParse(item);
          });
          return newArr;
      },
      isOdd: function(num) {
        return num % 2;
      },
      openRow: function(amountColumns) {


        for (var i = 0; i < amountColumns; i++) {
           //parse data 
        }

        return true;

        //how many columns
        //var template = '<div class="row">';

        //now add a column
      }, 
      closeRow: function() {
        var template = '</div';
        
        //increase the current row
        
        //add row counter
      }



  }


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
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
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
