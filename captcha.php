	<?php

    function generate_captcha($input, $length = 6)
    {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
    function generate_captcha_image()
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $image = imagecreatetruecolor(150, 50);
        $red = imagecolorallocate($image, 255, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $green = imagecolorallocate($image, 0, 255, 0);
        $textcolors = [$red, $white, $green];
        $fonts = [dirname(__FILE__) . '\fonts\captcha_fonts\GochiHand-Regular.ttf',  dirname(__FILE__) . '\fonts\captcha_fonts\NanumBrushScript-Regular.ttf'];
        $captcha_string = generate_captcha($chars, 6);
        $_SESSION['captcha_text'] = $captcha_string;

        for ($i = 0; $i < 6; $i++) {
            $letter_space = 140 / 6;
            $initial = 15;
            imagettftext($image, 24, rand(-15, 15), $initial + $i * $letter_space, rand(25, 45), $textcolors[rand(0, 2)], $fonts[array_rand($fonts)], $captcha_string[$i]);
        }
        $filepathcaptcha = "captcha.png";
        imagepng($image, $filepathcaptcha);
        imagedestroy($image);
        return $captcha_string;
    }

    ?>
 