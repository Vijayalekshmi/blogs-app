<?php 

namespace App;
use App\Models\Post;
class SpellCheck
{
    private $Key;
    public function __construct($Key){
        $this->Key=$Key;
    }
    public function checkSpell($sentence="")
    {
        $curl = curl_init();        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.apilayer.com/spell/spellchecker?q='".str_replace(' ','%20',$sentence)."'",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey:{$this->Key}"
          ),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET"
        ));        
        $response = curl_exec($curl);        
        curl_close($curl);    
        $response_body=$response ? json_decode($response,true) : [];        
        return array_key_exists('corrections',$response_body) && $response_body['corrections'] ? $response_body['corrections'][0]['best_candidate'] : '';
       
    }
    
}

?>