<?php

class MypageLecturePdfController
{


  protected $key = "VjJ0V2ExWXlSa2RoTTJ4b1VqTm9jVmR1YjNkUFVUMDk=";
  protected $iv = "WVVkR2FtRXlWbmxqZHowOQ==";

  public function enc($str)
  {
    $key = base64_decode($this->key);
    $iv = base64_decode($this->iv);

    return base64_encode(openssl_encrypt($str, "AES-256-CBC", $key, true, $iv));
  }

  public function dec($str)
  {
    $key = base64_decode($this->key);
    $iv = base64_decode($this->iv);

    return openssl_decrypt(base64_decode($str), "AES-256-CBC", $key, true, $iv);
  }
}

$test = new MypageLecturePdfController();

$url = 'https://teacher.hackers.com/site/contents/mypage/html/myroom/s3_file_down_n.php?lec_no=5797&file_url=5797/5797_0_20220905133639.pdf';

$option = array(
  'http' => array(
    'method' => 'GET',
    'header' => 'Accept-Language: ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7'
  )
);

$result = file_get_contents($url, false, stream_context_create($option));

$result = "https://teacher.hackers.com/test.php";

$result = $result . "?memberNo=&memberId=&lectureInfo=&lectureNo=&lectureDocNo=&isPrintAble=true&&isSaveAble=false&printCount=3&printAble=https://teacher.hackers.com/pdf/return_url.php";

//echo $result;

$result = 'ezpdfhk://' . $test->enc($result);

//echo $result;

?>

<script>
  window.open('<?= $result ?>');
</script>