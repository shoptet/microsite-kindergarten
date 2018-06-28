<section class="section section-claim">
    <div class="section-inner container">
        <div class="claim">
            <div class="claim-inner">
                <?php
                    $blogdesc = get_bloginfo('description');
                    $blogdesc = preg_replace("/, */", ",<br> ", $blogdesc);
                    echo $blogdesc;
                ?>
            </div>
        </div>
    </div>
</section>
<section class="section section-primary">
    <div class="section-inner container">
        <div class="claim-secondary">
            <?php echo _e( get_theme_mod( 'shp_secondary_claim_setting' ), 'shoptet-wp-theme'); ?>
        </div>
    </div>
</section>

