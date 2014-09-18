<?php
/**
 * Article Search API to search New York Times articles from Sept. 18, 1851 to today
 *
 * @author Adnan Siddiqi<kadnan(at)gmail(dot)com>[http://adnansiddiqi.me]
 */

namespace phpNYT;

class Article
{
    private $api_key;
    private $format = "json";
    public  $sort = "newest";
    public  $page = 0;
    public  $keyword = "";
    public  $start_date = null;
    public  $end_date = null;
    
    public function  __construct($key)
    {
	$this->api_key = $key;
    }

    public function find()
    {
	if($this->sort == "" || $this->sort == null)
		$this->sort = "newest";
	
	$url = "http://api.nytimes.com/svc/search/v2/articlesearch.".$this->format."?sort=".$this->sort."&api-key=".$this->api_key;
	if($this->keyword!="" || $this->keyword!=null)
	    $url.="&q=".$this->keyword;

	if($this->start_date!="" || $this->start_date!=null)
	    $url.="&begin_date=".$this->start_date;

	if($this->end_date!="" || $this->end_date!=null)
	    $url.="&end_date=".$this->end_date;

	if($this->page!="" || $this->page!=null)
	    $url.="&page=".intval($this->page);
	
	$results = $this->fetch($url);
	return $results;
    }

    private function fetch($url)
    {
	if(!$this->checkCURL())
		return null;
	else
	{
	    $ch = curl_init(); 

	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($ch);
	    curl_close($ch);
	    //get assoc array
	    $results = json_decode($output, true);
	    return $results;
	}
    }

    private function checkCURL()
    {
      if(
	  !function_exists("curl_init") &&
	  !function_exists("curl_setopt") &&
	  !function_exists("curl_exec") &&
	  !function_exists("curl_close")
	)
	  return false;
      else
	  return true;
    }
}