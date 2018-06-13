<?php namespace App;

use App\Helpers;

class GoogleContact {

  const CLIENT_ID = '429063125803-hovpgm94vpp8adqossme8bqnuh9nv4fj.apps.googleusercontent.com';
  const SECRET = 'i-oDoUPxVH7t2nAEo_gn9uG9';
  const REDIRECT_URI = 'http://gmail-import.com/token.php';

  static function contacts($accessToken)
  {
    $resultData = [];
    $queryURL = 'https://www.google.com/m8/feeds/contacts/default/full?max-results=500&oauth_token='.$accessToken;

    $xmlresponse = Helpers::curl_file_get_contents($queryURL);
    //В случае получения ошибки авторизации от Google.
    if( (strlen(stristr($xmlresponse,'Authorization required')) > 0) || strlen(stristr($xmlresponse,'Error ')) > 0) {
      return false;
    }
    
    $xml = simplexml_load_string($xmlresponse);
    $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
    $result = $xml->xpath('//gd:email');
            
    foreach ($result as $emailData) {
      $resultData[] = $emailData->attributes()->address->__toString();
    }
    return $resultData;
  }

  static function oauth($authCode)
  {
    $oauthURL = 'https://accounts.google.com/o/oauth2/token';
  
    $oauthData = array(
      'code' => $authCode,
      'client_id' => self::CLIENT_ID,
      'client_secret' => self::SECRET,
      'redirect_uri' => self::REDIRECT_URI,
      'grant_type' => 'authorization_code'
    );
    return json_decode(Helpers::curl_post_get_result($oauthURL, $oauthData));
  }
  
  static function gmailAuthURL()
  {
    $authUrl = 'https://accounts.google.com/o/oauth2/auth';
  
    $config = [
      'client_id' => self::CLIENT_ID,
      'redirect_uri' => self::REDIRECT_URI,
      'scope' => 'https://www.google.com/m8/feeds/',
      'response_type' => 'code',
    ];
  
    return "{$authUrl}?" . http_build_query($config);
  }

}
