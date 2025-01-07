<?php
function breadcumb($breadcumb_list = []) {
    ?>
    <div class="row bg-body-tertiary py-2">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <i class="bi bi-house-fill text-primary text-opacity-50 me-1"></i>
                                    <a class="link-primary" href="<?php echo esc_url(home_url()) ?>">Inicio</a>
                                </li>
                                <?php
                                if($breadcumb_list) {
                                    foreach($breadcumb_list as $item) {
                                        if($item->href === 'active') {
                                            ?>
                                            <li class="breadcrumb-item active" aria-current="page"><?php echo $item->name ?></li>
                                            <?php
                                        } else {
                                            ?>
                                            <li class="breadcrumb-item"><a class="link-primary" href="../..">Portafolio</a></li>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}