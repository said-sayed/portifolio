<?php

?>

<div class="vg-page page-portfolio" id="portfolio">
    <div class="container">
      <div class="text-center wow fadeInUp">
        <div class="badge badge-subhead">Portfolio</div>
      </div>
      <h1 class="text-center fw-normal wow fadeInUp">See my work</h1>
      <div class="filterable-button py-3 wow fadeInUp" data-toggle="selected" style="visibility: visible; animation-name: fadeInUp;">
        <button class="btn btn-theme-outline selected" data-filter="*">All</button>
        <?php foreach ($categoriesPortifolio as $category) { ?>
        <button class="btn btn-theme-outline" data-filter=".<?php echo $category['id'] ?>"><?php echo $category['name'] ?></button>
        <?php } ?>
      </div>
      <div class="gridder my-3">
        <?php foreach ($itemsAllItems as $item) { ?>
           <div class='grid-item <?php foreach ($categoriesItems as $categoriesItem) { 
          if($item['id'] == $categoriesItem['item_id']) echo $categoriesItem['category_id'].' ';} ?> wow zoomIn'>
            <div class="img-place" data-src="Images/<?php echo $item['image'] ?>" data-fancybox data-caption="<h5 class='fg-theme'>Mobile Travel App</h5> <p>Travel, Discovery</p>">
              <img src="Images/<?php echo $item['image'] ?>" alt="">
              <div class="img-caption">
                <h5 class="fg-theme"><?php echo $item['slug'] ?></h5>
                <p><?php echo $item['desc'] ?></p>
              </div>
            </div>
            </div>
          <?php } ?>
          

      </div> 
      <!-- End gridder -->
      <div class="text-center wow fadeInUp">
        <a href="javascript:void(0)" class="btn btn-theme">Load More</a>
      </div>
    </div>
  </div>