<?php
$links = array(
    array(
        'bi'    => 'facebook',
        'color' => '#1877F2',
        'url'   => esc_url( get_theme_mod('facebook_url') ),
        'text'  => 'Facebook',
    ),
    array(
        'bi'    => 'instagram',
        'color' => '#C7507C',
        'url'   => esc_url( get_theme_mod('instagram_url') ),
        'text'  => 'Instagram',
    ),
    array(
        'bi'    => 'youtube',
        'color' => '#CF2726',
        'url'   => esc_url( get_theme_mod('youtube_url') ),
        'text'  => 'Youtube',
    ),
    array(
        'bi'    => 'twitter-x',
        'color' => '#000000',
        'url'   => esc_url( get_theme_mod('twitter_url') ),
        'text'  => 'Twitter',
    ),
);
?>
<ul class="list-unstyled">
    <?php
    foreach( $links as $link ) {
        ?>
        <li class="border-bottom">
            <a class="d-block post-translate-x link-dark text-decoration-none fw-medium py-3" href="<?php echo $link['url'] ?>" target="__Blank">
                <i class="bi bi-<?php echo $link['bi'] ?> shadow-sm text-white rounded-1 me-2 py-1 px-2" style="background-color: <?php echo $link['color'] ?>;"></i>
                <?php echo $link['text'] ?>
            </a>
        </li>
        <?php
    }
    ?>
</ul>