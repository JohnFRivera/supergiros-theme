<?php
$page = get_queried_object();
?>

<input type="hidden" id="ip-term" value="<?php echo $page->taxonomy === 'category' ? esc_attr($page->slug) : '' ?>">
<input type="hidden" id="ip-tag" value="<?php echo $page->taxonomy === 'post_tag' ? esc_attr($page->slug) : '' ?>">
<main class="container-fluid bg-body-tertiary py-5">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h6 class="text-center text-uppercase"><?php echo esc_attr($page->description) ?></h6>
                        <h2 class="text-center fw-bold mb-5"><?php echo esc_attr($page->name) ?></h2>
                    </div>
                </div>
                <div class="row row-cols-4 g-3" id="loop-posts"></div>
                <div class="row" id="divPaginator"></div>
            </div>
        </div>
    </div>
</main>