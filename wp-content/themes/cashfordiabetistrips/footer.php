<?php wp_footer(); ?>
</div>
<footer class="mt-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-3 my-3">
                <a class="" href="<?php echo home_url() ?>">
                    <img class="img-fluid logo" src="<?php echo get_template_directory_uri() . "/assets/img/footer-logo.png" ?>" alt="site_logo" />
                </a>
            </div>
            <div class="col-12 col-md-3 my-3">
                <h3>LINKS</h3>
                <ul>
                    <li><a href="<?php echo home_url("products-to-sell"); ?>">Products to sell</a></li>
                    <li><a href="<?php echo home_url("/shipping-instructions") ?>">Shipping Instructions</a></li>                    
                    <li><a href="<?php echo home_url("/faqs") ?>">FAQs</a></li>
                    <li><a href="<?php echo home_url("/damage-guidelines") ?>">Damage Guidelines</a></li>
                    <li><a href="<?php echo home_url("/testimonials") ?>">Testimonials</a></li>
                    <li><a href="<?php echo home_url("/blog") ?>">Blog</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3 my-3">
                <h3>CONTACT US</h3>
                <p>(###)-###-###</p>
                <p>cashfordiabetistrips@gmail.com</p>
                <p>Please note: prices per box are subject to change without notice.</p>
                <p>*All test strip boxes are subject to inspection once received.</p>
            </div>
            <div class="col-12 col-md-3 my-3">
                <h3>SIGN UP NEWSLETTER</h3>
                <div>
                    <input type="text" placeholder="Email address" class="w-100">
                    <input type="submit" name="submit" value="SIGN UP" class="btn btn-blue-c1 w-100">
                </div>
            </div>
        </div>
    </div>
</footer>

</body>

</html>