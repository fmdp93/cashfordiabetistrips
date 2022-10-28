<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7f9176f2b2d9e64d9b84e774580bb744
{
    public static $files = array (
        'af3b636327f147651d6daea3d0b23786' => __DIR__ . '/../..' . '/src/constants.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'C' => 
        array (
            'Cashfordiabetistrips\\' => 21,
            'CashfordiabetistripsPlugin\\' => 27,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Cashfordiabetistrips\\' => 
        array (
            0 => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes',
        ),
        'CashfordiabetistripsPlugin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/wp-content/plugins/cashfordiabetistrips/classes',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'A' => 
        array (
            'App\\' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static $classMap = array (
        'App\\Classes\\Pagination' => __DIR__ . '/../..' . '/src/Classes/Pagination.php',
        'App\\Classes\\Session' => __DIR__ . '/../..' . '/src/Classes/Session.php',
        'App\\Classes\\Validation' => __DIR__ . '/../..' . '/src/Classes/Validation.php',
        'App\\Model\\User' => __DIR__ . '/../..' . '/src/Model/User.php',
        'App\\Model\\produck' => __DIR__ . '/../..' . '/src/Model/produck.php',
        'CashfordiabetistripsPlugin\\Admin' => __DIR__ . '/../..' . '/wp-content/plugins/cashfordiabetistrips/classes/Admin.php',
        'CashfordiabetistripsPlugin\\Validation' => __DIR__ . '/../..' . '/wp-content/plugins/cashfordiabetistrips/classes/Validation.php',
        'Cashfordiabetistrips\\EditAccountForm' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/EditAccountForm.php',
        'Cashfordiabetistrips\\Interfaces\\Form' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/Interfaces/Form.php',
        'Cashfordiabetistrips\\Interfaces\\Mailing' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/Interfaces/Mailing.php',
        'Cashfordiabetistrips\\Interfaces\\USPS' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/Interfaces/USPS.php',
        'Cashfordiabetistrips\\LoginForm' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/LoginForm.php',
        'Cashfordiabetistrips\\Orders' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/Orders.php',
        'Cashfordiabetistrips\\ProductForm' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/ProductForm.php',
        'Cashfordiabetistrips\\ProductMailing' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/ProductMailing.php',
        'Cashfordiabetistrips\\RegisterForm' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/RegisterForm.php',
        'Cashfordiabetistrips\\Setup' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/Setup.php',
        'Cashfordiabetistrips\\Traits\\TraitUserForm' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/Traits/TraitUserForm.php',
        'Cashfordiabetistrips\\USPSReturnLabel' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/USPSReturnLabel.php',
        'Cashfordiabetistrips\\User' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/User.php',
        'Cashfordiabetistrips\\UserMailing' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/UserMailing.php',
        'Cashfordiabetistrips\\produck' => __DIR__ . '/../..' . '/wp-content/themes/cashfordiabetistrips/classes/produck.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PHPMailer\\PHPMailer\\Exception' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/Exception.php',
        'PHPMailer\\PHPMailer\\OAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/OAuth.php',
        'PHPMailer\\PHPMailer\\OAuthTokenProvider' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/OAuthTokenProvider.php',
        'PHPMailer\\PHPMailer\\PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/PHPMailer.php',
        'PHPMailer\\PHPMailer\\POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/POP3.php',
        'PHPMailer\\PHPMailer\\SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/SMTP.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7f9176f2b2d9e64d9b84e774580bb744::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7f9176f2b2d9e64d9b84e774580bb744::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7f9176f2b2d9e64d9b84e774580bb744::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7f9176f2b2d9e64d9b84e774580bb744::$classMap;

        }, null, ClassLoader::class);
    }
}
