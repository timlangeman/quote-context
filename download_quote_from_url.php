<?include("lib/simple_html_dom.php");$url_default = "http://www.openpolitics.com/quote-context/cache/www.biblegateway.com/passage/%3fsearch=Deuteronomy+8.html";$quote_default = "He humbled you, causing you to hunger and then feeding you with manna, which neither you nor your ancestors had known, to teach you that man does not live on bread alone but on every word that comes from the mouth of the Lord .";	$url = isset($_REQUEST['url']) ? $_REQUEST['url'] : $url_default;$quote = $_REQUEST['quote'] ? $_REQUEST['quote'] : $quote_default;$url_quote = $url . "|" . $quote;$computed_hash = md5(rawurlencode($url_quote));  $json_folder = "json";// Or maybe the user only specifies the hash, and ommits the quote and url$requested_hash = isset($quote) ? $computed_hash : $_GET['hash'];$requested_file = $json_folder . "/" . $requested_hash . ".js";// Check to see if json file already exists.  If so, output itif (file_exists($requested_file)){	$file = fopen($requested_file, 'r');	header('Content-Type: application/json');	header("Content-Length: " . filesize($requested_file));	fpassthru($file);				exit;}else {	// Download url and parse out before and after sections	$html = file_get_html($url)->plaintext;	//Get plaintext version of URL	//$html = htmlentities($html, ENT_QUOTES, 'UTF-8');	$html = $mystring = str_replace("&nbsp;", " ", $html);	$html = trim($html);		//$html = html_entity_decode($html);	if ($_GET['debug'] == "plaintext"){		echo($html);	}	//Calculate starting position of quote	$quote_length = strlen($quote);	$quote_start_pos = stripos($html, $quote);	if (strpos($quote_start_pos, $quote) !== false){		echo("Can't find the quote");	}	else {		$quote_end_pos = $quote_start_pos + $quote_length;		$prior_quote_context_length = 500;	//arbitrary length in number of characters		$after_quote_context_length = 500;	//arbitrary length in number of characters			//Calculate starting position of prior and subsequent sections		$context_start_pos = $quote_start_pos - $prior_quote_context_length;		if ($context_start_pos < 0) {			$context_start_pos = 0;		}		$context_end_pos = $quote_end_pos + $after_quote_context_length;		if ($context_end_pos > strlen($html) ) {			$context_end_pos = strlen($html);		}			//Get text that immediately preceeds and follows		$context_before = trim(substr($html, $context_start_pos, ($quote_start_pos - $context_start_pos) )); 		$context_quote = trim(substr($html, $quote_start_pos, $quote_length ));		$context_after = ltrim(substr($html, $quote_end_pos, $after_quote_context_length));				$json = json_encode( 				array("url"=> $url,					"before"=> $context_before,					"quote"=> $context_quote,					"after"=> $context_after,					"quote_hash"=> $computed_hash, 										"context_start_pos"=> $context_start_pos,					"quote_start_pos"=> $quote_start_pos,					"quote_end_pos"=> $quote_end_pos,					"context_end_pos"=> $context_end_pos,					"html"=> $html,				));		// Save data to json file		//$file = fopen($requested_file, "w");		//fwrite($file, $json);		// Send output to browser		echo($json);	}}// Download citing page and verify that the quote is valid, (restrict to local domain)?>