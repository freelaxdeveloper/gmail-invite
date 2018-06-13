<?php namespace App;

use Jenssegers\Blade\Blade;

class Helpers {

  static function blade($template, $params = [], $view = true)
  {
    $blade = new Blade('resources/views', 'resources/views/cache');
    echo $blade->make($template, $params);
  }

  static function curl_post_get_result($url, $postData)
  {

    $post = http_build_query($postData);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 5);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
  }

  static function curl_file_get_contents($url)
  {
    $curl = curl_init();
    $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
  
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
  
    curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  
    $contents = curl_exec($curl);
    curl_close($curl);
    return $contents;  
  }

}