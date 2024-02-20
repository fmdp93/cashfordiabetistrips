<?php

namespace Cashfordiabetistrips;

use App\Classes\Session;
use Cashfordiabetistrips\Interfaces\Form;
use App\Classes\Validation;
use Cashfordiabetistrips\ProductMailing;
use Cashfordiabetistrips\Traits\TraitUserForm;
use stdClass;

class ProductForm implements Form
{
    use TraitUserForm;
    public function __construct(Product $Product)
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->session = new Session();
        $this->Product = $Product;
        $this->products_to_sell_action = home_url('products-to-sell');
        // $this->USPSReturnLabel = new USPSReturnLabel();
        $this->html_error = json_decode(urldecode($_COOKIE['error_message'] ?? ''), true);
        $this->html_user_data = json_decode(urldecode($_COOKIE['user_data'] ?? ''), true);

        // USPS Return Label
        $xml_path = get_template_directory() . '/template-parts/return_label.xml.php';
        // $xml_path = get_template_directory() . '/template-parts/usps_test.xml.php';
        // $this->USPSReturnLabel->build_xml_request($xml_path);

        add_filter('user_details_form', array($this, 'user_details_form_view'));
        add_filter('payment_method', array($this, 'payment_method'));
        add_filter('product_view', array($this, 'product_view'));
        add_filter('product_form', array($this, 'the_view'));
    }

    /** Hooks */
    public function product_view()
    {
        $url = 'https://secure.shippingapis.com/ShippingAPI.dll?API=USPSReturnsLabelCertify&XML=';
        // $url = 'http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=';
        // $label = $this->USPSReturnLabel->get_response($url);
        if (isset($_GET['model'])) {
            "WHERE brand = {$_GET['model']}";
            $prepare = $this->Product->wpdb->prepare("SELECT * FROM products WHERE model = %d", $_GET['model']);
            $products = $this->Product->wpdb->get_results($prepare);
        } else {
            $products = $this->Product->ModelProduct->get_products();
        }
        return include get_stylesheet_directory() . '/template-parts/product.php';
    }

    public function the_view()
    {
        $products = $this->Product->ModelProduct->get_products();

        return include get_stylesheet_directory() . '/template-parts/product-form.php';
    }

    public function user_details_form_view($filter)
    {
        return include get_stylesheet_directory() . '/template-parts/user_details_form.php';
    }

    public function payment_method()
    {
        return include get_stylesheet_directory() . '/template-parts/payment-method.php';
    }

    /** End of Hooks */

    public function submit()
    {
        if (Validation::form_nonce('products_to_sell', $this->products_to_sell_action)) {
            $this->set_user_data();
            $model = $_POST['model'] ? "model={$_POST['model']}" : '';
            $this->validate() || (wp_redirect(home_url('products-to-sell?' . $model)) && exit);

            $ProductMailing = new ProductMailing($this);
            $ProductMailing->body_building();
            $ProductMailing->send();

            // save to db
            $this->save_order_user_info();
            $this->save_order2products();

            $success_message = "<h1>Thank you for choosing to sell your products to us!</h1>
                <p>We'll send a copy of your shipping label to your email: <b>{$this->user_data['email']}</b></p>";
            setcookie("success_message", urlencode(json_encode($success_message, JSON_HEX_QUOT)), time() + 30, "/");
            setcookie('error_message', '', time() + 1, '/');
            setcookie('user_data', '', time() + 1, '/');

            wp_redirect(home_url('success-message'));
            exit;
        }
    }

    private function save_order2products()
    {
        $order_id = $this->wpdb->insert_id;

        foreach ($_POST['quantity'] as $key => $quantity) {
            if (!empty($quantity)) {
                $price = $_POST['price'][$key];
                $product_id = $_POST['product_id'][$key];

                $data = array($order_id, $product_id, $quantity, $price);
                $prepare = $this->wpdb->prepare("INSERT INTO order2products (order_id, product_id, quantity, price) VALUES (%d, %d, %d, %f)", $data);
                $this->wpdb->query($prepare);
            }
        }
    }

    private function save_order_user_info()
    {
        $user_id = $this->session->user['id'] ?? '';
        $date = date("Y-m-d H:i:s");
        $data = array(
            $user_id,
            $date,
            $this->user_data['name'],
            $this->user_data['state'],
            $this->user_data['city'],
            $this->user_data['address'],
            $this->user_data['zip'],
            $this->user_data['phone_num'],
            $this->user_data['email'],
            $this->user_data['payment_method'],
            $this->user_data['pm_val'],
            $this->user_data['promo_code'],
            $this->user_data['notes'],
        );
        $prepare = $this->wpdb->prepare(
            "INSERT INTO orders (user_id, `date_time`, `name`, `state`, city, street, postcode, phone, email, payment_method, pm_val, promo_code, notes)
                    VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
            $data
        );
        $this->wpdb->query($prepare);
    }

    private function set_user_data()
    {
        $this->set_user_only_data();
        $this->user_data['quantity'] = $_POST['quantity'];
        $this->user_data['promo_code'] = !empty($_POST['promo_code']) ? $_POST['promo_code'] : '&ndash;';
        $this->user_data['notes'] = !empty($_POST['notes']) ? $_POST['notes'] : '&ndash;';
        $this->user_data['payment_method'] = $_POST['payment_method'] ?? '';
        $this->user_data['pm_val'] = $_POST['pm_val'];

        setcookie('user_data', urlencode(json_encode($this->user_data, JSON_HEX_QUOT)), time() + 120, "/");
    }

    public function validate()
    {
        $this->error = [];
        $this->set_user_only_error();
        $this->set_product_error();

        setcookie('error_message', urlencode(json_encode($this->error, JSON_HEX_QUOT)), time() + 120, "/");
        if (!empty($this->error)) {
            return false;
        }

        return true;
    }

    private function set_product_error()
    {
        $empty_count = 0;
        foreach ($_POST['quantity'] as $key => $val) {
            if (empty($val)) {
                $empty_count++;
            }

            if (!preg_match('/^[0-9]*$/', $val)) {
                $this->error['product_item'][$key] = "Please input a number";
            }
        }

        if ($empty_count === count($_POST['quantity'])) {
            // no product added                   
            $this->error['product_error'] = "Add a product before submitting";
        }

        foreach ($_POST['product_id'] as $key => $val) {
            $prep = $this->Product->wpdb->prepare(
                "SELECT COUNT(*) FROM products WHERE id = %d && name = %s && price = %f",
                $val,
                $_POST['product_name'][$key],
                $_POST['price'][$key]
            );
            $result_count = $this->Product->wpdb->get_var($prep);
            if ($result_count == 0) {
                // product info was modified
                $this->error['product_error'] = "Product was modified";
            }
        }
    }
}
