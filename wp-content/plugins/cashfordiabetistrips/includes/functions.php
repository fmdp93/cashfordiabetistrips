<?php

if (!function_exists('get_id_by_slug')) {
    function get_id_by_slug($page_slug)
    {
        $page = get_page_by_path($page_slug);
        if ($page) {
            return $page->ID;
        } else {
            return null;
        }
    }
}

if (!function_exists('get_plugin_data')) {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

if (!function_exists('show_caps')) {
    function show_caps()
    {
        $data = get_userdata(get_current_user_id());

        if (is_object($data)) {
            echo '<pre>' . print_r($data->allcaps, true) . '</pre>';
        }
    }
}

if (!function_exists('alertSuccess')) {
    function alertSuccess($var)
    {
?>
        <?php
        if ($var) {
        ?>
            <div class="row">
                <div class="col alert alert-success m-3 rounded-0">
                    <?php echo $var ?>
                </div>
            </div>
        <?php
        }
    }
}

if (!function_exists('alertError')) {
    function alertError($var)
    {
        if ($var) {
        ?>
            <div class="row">
                <div class="col alert alert-danger m-3 rounded-0">
                    <?php echo "<b>Error:</b> $var" ?>
                </div>
            </div>
<?php
        }
    }
}
