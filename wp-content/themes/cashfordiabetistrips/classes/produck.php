<?php

namespace Cashfordiabetistrips;

use \App\Model\produck as ModelProduct;

class produck
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->ModelProduct = new ModelProduct();
        $this->ProductForm = new ProductForm($this);

        add_filter('brands_we_buy', array($this, 'brands_we_buy_view'));
        add_action('template_redirect', array($this->ProductForm, 'submit'));
    }

    public function brands_we_buy_view()
    {
        $product_page = home_url("/products-to-sell?brand=");
        $view = '<div class="row">';
        $models_result = $this->wpdb->get_results("SELECT * FROM models");
        foreach ($models_result as $model_row) {
            $products_sql = $this->wpdb->get_results("SELECT * FROM products WHERE model = {$model_row->id}");

            $view .= $this->product_list($model_row, $products_sql);
        }
        $view .= '</div>';
        return $view;
    }

    private function product_list($model_row, $products_sql)
    {
        return include get_stylesheet_directory() . '/template-parts/brand_list.php';
    }
}
