<?php

namespace Cashfordiabetistrips;

use Cashfordiabetistrips\Interfaces\Form;
use Cashfordiabetistrips\Interfaces\Mailing as Mailing;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ProductMailing implements Mailing
{
    public $mail;
    public function __construct(Form $productForm)
    {
        $this->ProductForm = $productForm;

        $this->mail = new PHPMailer(true);

        try {
            // Passing `true` enables exceptions
            //Server settings
            $this->mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $this->mail->isSMTP();                                      // Set mailer to use SMTP
            $this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
            $this->mail->Username = 'cashfordiabetistrips@gmail.com';                 // SMTP username
            $this->mail->Password = 'Testrips2021';                           // SMTP password
            $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = 587;                                    // TCP port to connect to
            //Recipients
            $this->mail->setFrom('cashfordiabetistrips@gmail.com', 'Cash For Diabetis Strips');
            $this->mail->addAddress($_POST['email']);     // Add a recipient            
            $this->mail->addReplyTo('cashfordiabetistrips@gmail.com', 'Cash For Diabetis Strips Team');

            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'CashForDiabetiStrips Label';
        } catch (Exception $e) {
            echo $e;
            exit;
        }
    }

    public function send()
    {
        try {
            $this->mail->send();
        } catch (Exception $e) {
            echo $e;
            exit;
        }
    }

    public function body_building()
    {        
        $products_to_buy_table = $this->get_products_to_buy_table();
        $table_user_info = $this->get_table_user();
        // $shipping_label = $_POST['shipping_label'];            

        $this->mail->Body = "
            <p>Thank You for your submission. </p>
            <span style=\"border:1px solid #ccc;background:#ccc;border-radius:5px;padding:5px\">Please download attached file for Free shipping label</span>
            <center><img src='" . get_template_directory_uri() . "/assets/img/logo.png" . "' alt=\"Cash For Diabetis Strips\"></center>
            <center><p><b>If you have more good test strips you can add them</b></p>
            <p><b>to this order we pay for whatever we recieve</b></p></center>
            <h4>Cashfordiabetistrips.com</h4>
            $table_user_info
            <br/>
            <br/>
            $products_to_buy_table
            <br/>
            <br/>
            <table style='padding:20px 0 20px 0;width:100%;border-collapse:collapse' border='1'>
                <tr>
                    <th>DATE</th>
                    <th>" . date("Y-m-d") . "</th>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td>" . sprintf('$ %01.2f', $this->getSubTotal()) . "</td>
                </tr>
                <tr>
                    <td colspan='2'><b>IMPORTANT NOTICE:</b></td>                        
                </tr>
                <tr>
                    <td colspan='2'>DO NOT REMOVE any existing labels from your diabetic supply boxes! We remove all labels upon receipt at our facility; however, if you are still concerned about your privacy, please simply mark out any personal information (such as your name) with a soft, felt-tip marker (no ballpoint pens or pencils, please) to avoid damaging the box(es).</td>
                </tr>
                <tr>
                    <td colspan='2'>Please note: We do not handle, nor do we accept, diabetic equipment or supplies shipped from overseas.</td>
                </tr>
            </table>
            ";
    }

    private function get_products_to_buy_table()
    {
        $table = "<table style='padding:20px 0 20px 0;border-collapse:collapse; margin:0 auto;' border='1'>
            <tr>
                <th>TEST STRIPS BRAND NAME</th>
                <th colspan='2'>Price & Number of Boxes</th>
                <th>Estimated Sub-Total</th>
            </tr>            
        ";
        $pass_func = function ($key) {            
            return "
            <tr>
                <td>" . $_POST['product_name'][$key] . "</td>                
                <td>" . sprintf('$ %01.2f', $_POST['price'][$key]) . "</td>                
                <td>x " . $_POST['quantity'][$key] . "</td>                
                <td>" . sprintf('$ %01.2f', $this->getItemSubTotal($key)) . "</td>                
            </tr>
            ";
        };

        foreach($this->products_loop($pass_func) as $row){
            $table .= $row;
        }        
        
        $table .= "
            <tr>
                <td>&nbsp;</td>
                <td colspan='2'>Estimated Sub-Total</td>
                <td>" . sprintf('$ %01.2f', $this->getSubTotal()) . "</td>
            </tr>
        </table>";
        return $table;
    }

    private function getItemSubTotal($key){
        return $_POST['price'][$key] * $_POST['quantity'][$key];
    }

    private function getSubTotal()
    {
        $subTotal = 0;
        $pass_func = function($key){
            return $this->getItemSubTotal($key);
        };
        foreach($this->products_loop($pass_func) as $itemSubTotal){
            $subTotal += $itemSubTotal;
        }       
        return $subTotal;
    }

    /**
     * Generator
     */
    private function products_loop($callback)
    {
        foreach ($_POST['product_id'] as $key => $val) {
            if (!empty($_POST['quantity'][$key])) {
                yield call_user_func_array($callback, array($key));
            }
        }
    }

    private function get_table_user()
    {
        extract($this->ProductForm->user_data);
        return "
                <table style='padding:20px 0 20px 0;width:100%;border-collapse:collapse' border='1'>
                    <tr>
                        <td><b>Mail To</b></td>
                        <td><b>Address of the hub</b></td>
                    </tr>
                    <tr>
                        <td>
                            <p>Mail From</p>
                            <p>Name</p>
                            <p>Address</p>
                            <p>City</p>
                            <p>State</p>
                            <p>Zip</p>
                            <p>Phone#</p>
                        </td>
                        <td>
                            <p>$email</p>
                            <p>$name</p>
                            <p>$address</p>
                            <p>$city</p>
                            <p>$state</p>
                            <p>$zip</p>
                            <p>$phone_num</p>
                        </td>                        
                    </tr>    
                    <tr>
                        <td>Promo Code</td>
                        <td>$promo_code</td>
                    </tr>              
                    <tr>
                        <td>Note</td>
                        <td>$notes</td>
                    </tr>  
                    <tr>
                        <td>Preferred Payment Method</td>
                        <td>$payment_method:$pm_val</td>
                    </tr>
                    <tr>
                        <td>Label Request</td>
                        <td>Require a shipping label to be email </td>
                    </tr>
                </table>";
    }
}
