<?php
get_header();
?>
<div class="container-fluid bg-body-tertiary pb-5">
    <div class="row">
        <div class="col">
            <?php
            get_template_part(
                '/template-parts/post/single',
                sgnv_get_post_type()
            );
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
