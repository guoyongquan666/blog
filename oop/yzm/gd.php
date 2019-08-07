<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/4/30
 * Time: 上午03:49
 */


$img = imagecreatetruecolor(500, 500);


imagefill($img, 0, 0, createColor($img));


for ($i = 0; $i < 10000; $i++){

    imagesetpixel($img, rand(0, 500), rand(0, 500), createColor($img));
}


for ($i = 0; $i < 100; $i++){

    imageline($img, rand(0, 500), rand(0, 500), rand(0, 500), rand(0, 500), createColor($img));
}

for ($i = 0; $i < 1000; $i++){

    imagestring($img, 5, rand(0, 500), rand(0, 500), '*', createColor($img));
}

$font_file = '华文行楷.ttf';

for ($i = 0  ; $i < 4; $i++){
    imagefttext($img, 50, rand(0, 100), 100 * ($i + 1), 300, createColor($img, 1), $font_file, randString(1, 3));
}



imagefttext($img, 50, rand(0, 100), 100, 400, createColor($img, 1), $font_file, randString(1));
imagefttext($img, 50, 0, 150, 400, createColor($img, 1), $font_file, '+');
imagefttext($img, 50, rand(0, 100), 250, 400, createColor($img, 1), $font_file, randString(1));
imagefttext($img, 50, 0, 300, 400, createColor($img, 1), $font_file, '=');



//imagefilledarc($img, 200, 200, 50, 100, 0, 360, createColor($img, 1), IMG_ARC_NOFILL);
//imageellipse($img, 200, 200, 50, 100, createColor($img, 1));

header('content-type:image/png');
imagepng($img);






//r*0.299 + g*0.578 + b*0.114 >= 192

/**
 * @param $tu
 * @param int $type 0：表示浅色 1：表示深色
 * @return int
 */
function createColor($tu, $type = 0 ){

    if ($type == 0){
        while (true){
            $x = rand(0, 255);
            $y = rand(0, 255);
            $z = rand(0, 255);
            if($x * 0.299 + $y * 0.578 + $z * 0.114 >= 192){
                return imagecolorallocate($tu, $x, $y, $z);
            }
        }
    }

    if($type == 1){
        while (true){
            $x = rand(0, 255);
            $y = rand(0, 255);
            $z = rand(0, 255);
            if($x * 0.299 + $y * 0.578 + $z * 0.114 < 192){
                return imagecolorallocate($tu, $x, $y, $z);
            }
        }
    }
}




/**
 * $num 验证码的字数
 * int $type 验证码的类型 0：纯数字 1：纯字母 2：字母数字组合 3：纯中文
 */
function randString($num, $type = 0){

    //10个数字
    $number = '0123456789';
    //44个字母
    $english = 'abcdefhijkmnprstuvwxyABCDEFGHJKLMNPQRSTUVWXY';
    //200个汉字
    $chinese = '的,一,是,在,不,了,有,和,人,这,中,大,为,上,个,国,我,以,要,他,时,来,用,们,生,到,作,地,于,出,就,分,对,成,会,可,主,发,年,动,同,工,也,能,下,过,子,说,产,种,面,而,方,后,多,定,行,学,法,所,民,得,经,十,三,之,进,着,等,部,度,家,电,力,里,如,水,化,高,自,二,理,起,小,物,现,实,加,量,都,两,体,制,机,当,使,点,从,业,本,去,把,性,好,应,开,它,合,还,因,由,其,些,然,前,外,天,政,四,日,那,社,义,事,平,形,相,全,表,间,样,与,关,各,重,新,线,内,数,正,心,反,你,明,看,原,又,么,利,比,或,但,质,气,第,向,道,命,此,变,条,只,没,结,解,问,意,建,月,公,无,系,军,很,情,者,最,立,代,想,已,通,并,提,直,题,党,程,展,五,果,料,象,员,革,位,入,常,文,总';
    $str = '';

    for ($i = 0; $i < $num; $i++){

        if ($type == 0){
            $str .= $number{rand(0, 9)};
        }

        if ($type == 1){
            $str .= $english{rand(0, 43)};
        }

        if ($type == 2){
            $tmp = $number.$english;
            $str .= $tmp{rand(0, 53)};
        }

        if($type == 3){
//            $str .= $chinese{rand(0, 199)};
            $tmp = explode(',',$chinese);
            $str .= $tmp[rand(0, 199)];
        }
    }
    return $str;
}

