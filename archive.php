<?php
get_header();
?>
<div class="container-fluid bg-body-tertiary py-5">
    <div class="row">
        <div class="col">
            <?php
            get_template_part(
                '/template-parts/post/archive',
                sgnv_get_post_type(),
            );
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
