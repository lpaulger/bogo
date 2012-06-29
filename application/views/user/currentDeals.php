<div class="masonry">
    <?php
    foreach ($deals as $deal) {
            
            $url;
            if($deal->item->userInCohort == 0){
                //see cohorts for item (or create one if none exist)
                $url = site_url('deals/'. $deal->dealId);
            }
            else{
                //see the users cohort for this item
                $url = site_url('deals/cohort/'. $deal->cohortId);
            }
        ?>
        <div class="masonry-brick span2  ">
            <div class="vendor-item">
                <h3><a href="<?php echo $url; ?>"><?php echo $deal->item->name; ?></a></h3>
                <span><?php echo $deal->item->initPrice . ' ' . $deal->item->basePrice; ?></span>
                <span><?php echo $deal->item->totalQty . ' ' . $deal->item->currentQty; ?></span>
            </div>
        </div>
        <?php
    }
    ?>
</div>