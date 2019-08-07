<?php
/**
 * Created by PhpStorm.
 * User: qingyun
 * Date: 19/4/30
 * Time: 上午04w:33
 */

class Verify
{
    //画布的宽
    protected $width;
    //画布的高
    protected $height;
    //使用的字库路径
    protected $font;
    //验证码的数量
    protected $num;


    public function __construct($width = 100, $height = 40, $num = 4, $font = '../华文行楷.ttf')
    {
        $this->width = $width;
        $this->height = $height;
        $this->font = $font;
        $this->num = $num;
    }

//    public function chinese()
//    {
//        //创建画布
//        $img = imagecreatetruecolor($this->width, $this->height);
//        //填充背景色
//        imagefill($img, 0, 0, $this->createColor($img));
//
//        //画星号干扰
//        for ($i = 0; $i < 40; $i++){
//            imagestring($img, 5, rand(0, 100), rand(0, 40), '*', $this->createColor($img));
//        }
//
//        for ($i = 0; $i < 10; $i++){
//            imageline($img, rand(0, 100), rand(0, 40), rand(0, 100), rand(0, 40), $this->createColor($img, 1));
//        }
//
//
//        //将中文字符写入到画布中
//        $code = '';
//        for ($i = 0  ; $i < $this->num; $i++){
//            $one = $this->randString(1, 3);
//            $code .= $one;
//            imagefttext($img, 18, rand(-30,30), 20 * $i + 5, rand(20, 30), $this->createColor($img, 2), $this->font, $one);
//        }
//
//        header('content-type:image/png');
//
//        session_start();
//        //将验证码上的字符记录到session中
//        $_SESSION['yyzzmm'] = $code;
//        imagepng($img);
//
//    }



    public function chinese()
    {
        //创建画布
        $img = imagecreatetruecolor($this->width, $this->height);
        //填充背景色
        imagefill($img, 0, 0, $this->createColor($img));


        $starNum = $this->height * $this->width / 100;

        //画星号干扰
        for ($i = 0; $i < $starNum; $i++){
            imagestring($img, 5, rand(0, $this->width), rand(0, $this->height), '*', $this->createColor($img));
        }

        $lineNum = $this->height * $this->width / 400;
        for ($i = 0; $i < $lineNum; $i++){
            imageline($img, rand(0, $this->width), rand(0, $this->height), rand(0, $this->width), rand(0, $this->height), $this->createColor($img, 1));
        }


        //将中文字符写入到画布中
        $code = '';
        for ($i = 0  ; $i < $this->num; $i++){
            $one = $this->randString(1, 3);
            $code .= $one;
            $fontSize = 18 / 40 * $this->height;
            imagefttext($img, $fontSize, rand(-30,30), 0.5 * $this->height * $i + 5, rand(0.5 * $this->height, 0.75 * $this->height), $this->createColor($img, 2), $this->font, $one);
        }

        header('content-type:image/png');

        session_start();
        //将验证码上的字符记录到session中
        $_SESSION['yyzzmm'] = $code;
        imagepng($img);

    }


    public function math()
    {
        //创建画布
        $img = imagecreatetruecolor($this->width, $this->height);
        //填充背景色
        imagefill($img, 0, 0, $this->createColor($img));


        $starNum = $this->height * $this->width / 100;

        //画星号干扰
        for ($i = 0; $i < $starNum; $i++){
            imagestring($img, 5, rand(0, $this->width), rand(0, $this->height), '*', $this->createColor($img));
        }

        $lineNum = $this->height * $this->width / 400;
        for ($i = 0; $i < $lineNum; $i++){
            imageline($img, rand(0, $this->width), rand(0, $this->height), rand(0, $this->width), rand(0, $this->height), $this->createColor($img, 1));
        }


        //将中文字符写入到画布中
        $x = 0;
        $y = 0;
        $fontSize = 18 / 40 * $this->height;
        //随机生成一个数字
        $one = $this->randString(1, 0);
        $x = $one;
        imagefttext($img, $fontSize, rand(-30,30), 0.5 * $this->height * 0 + 5, rand(0.5 * $this->height, 0.75 * $this->height), $this->createColor($img, 2), $this->font, $one);
        imagefttext($img, $fontSize, rand(-30,30), 0.5 * $this->height * 1 + 5, rand(0.5 * $this->height, 0.75 * $this->height), $this->createColor($img, 2), $this->font, '+');
        $one = $this->randString(1, 0);
        $y = $one;
        imagefttext($img, $fontSize, rand(-30,30), 0.5 * $this->height * 2 + 5, rand(0.5 * $this->height, 0.75 * $this->height), $this->createColor($img, 2), $this->font, $one);

        header('content-type:image/png');

        session_start();
        //将验证码上的字符记录到session中
        $_SESSION['yyzzmm'] = (int)$x + (int)$y;
        imagepng($img);
    }




    /**
     * 创建一个图的颜色
     * @param $tu
     * @param int $type 0：表示浅色 1：表示深色 2：更深色
     * @return int
     */
    protected function createColor($tu, $type = 0 ){

        if ($type == 0){
            while (true){
                $x = rand(0, 255);
                $y = rand(0, 255);
                $z = rand(0, 255);
//                标准的分界点是192
                if($x * 0.299 + $y * 0.578 + $z * 0.114 >= 200){
                    return imagecolorallocate($tu, $x, $y, $z);
                }
            }
        }

        if($type == 1){
            while (true){
                $x = rand(0, 255);
                $y = rand(0, 255);
                $z = rand(0, 255);
                if($x * 0.299 + $y * 0.578 + $z * 0.114 < 200 || $x * 0.299 + $y * 0.578 + $z * 0.114 >= 100 ){
                    return imagecolorallocate($tu, $x, $y, $z);
                }
            }
        }

        if($type == 2){
            while (true){
                $x = rand(0, 255);
                $y = rand(0, 255);
                $z = rand(0, 255);
                if($x * 0.299 + $y * 0.578 + $z * 0.114 < 100){
                    return imagecolorallocate($tu, $x, $y, $z);
                }
            }
        }
    }

    /**
     * @param $num 验证码的字数
     * @param int $type 验证码的类型 0：纯数字 1：纯字母 2：字母数字组合 3：纯中文
     * @return string
     */
    protected function randString($num, $type = 0){

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


}


$v = new  Verify(200, 60, 4, '../文泉驿微米黑.ttf');
$v->math();
