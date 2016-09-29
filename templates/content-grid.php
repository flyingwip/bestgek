<?php// the_content(); ?>

<div class="container grid">

  <!-- Eerste rij twee colommen -->



  <div class="row">
    <div class="col-xs-12 col-sm-6 ">
    	<div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-6 ">
    	<div>Dit is een test</div>
    </div>
  </div>

  <!-- Twee rij drie colommen -->
  <div class="row">
    <div class="col-xs-12 col-sm-4 ">
    <div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-4 ">
    <div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-4 ">
    <div>Dit is een test</div>
    </div>
  </div>

  <!-- Derde rij twee colommen -->
  <div class="row">
    <div class="col-xs-12 col-sm-6 ">
    	<div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-6 ">
    	<div>Dit is een test</div>
    </div>
  </div>

  <!-- Vier rij drie colommen -->
  <div class="row">
    <div class="col-xs-12 col-sm-4 ">
    <div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-4 ">
    <div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-4 ">
    <div>Dit is een test</div>
    </div>
  </div>

  <!-- Vijf rij twee colommen -->
  <div class="row">
    <div class="col-xs-12 col-sm-6 ">
    	<div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-6 ">
    	<div>Dit is een test</div>
    </div>
  </div>

  <!--now loop -->

  <div class="row">
    <div class="col-xs-12 col-sm-4 ">
      <div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-4 ">
      <div>Dit is een test</div>
    </div>
    <div class="col-xs-12 col-sm-6 ">
      <div>Dit is een test</div>
    </div>
  </div>



</div>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
