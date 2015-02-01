<?include("simple_html_dom.php");// The user specifies the complete quote contents//$url = "https://www.biblegateway.com/passage/?search=Deuteronomy%208&version=NRSV";$url = "http://www.openpolitics.com/quote-context/cache/www.biblegateway.com/passage/%3fsearch=Deuteronomy+8.html";$quote = "Remember how the Lord your God led you all the way in the wilderness these forty years, to humble and test you in order to know what was in your heart, whether or not you would keep his commands. 3 He humbled you, causing you to hunger and then feeding you with manna, which neither you nor your ancestors had known, to teach you that man does not live on bread alone but on every word that comes from the mouth of the Lord";$quote = "He humbled you, causing you to hunger and then feeding you with manna, which neither you nor your ancestors had known, to teach you that man does not live on bread alone but on every word that comes from the mouth of the Lord .";	$url_quote = $url . "|" . $quote;$computed_hash = md5(rawurlencode($url_quote));  $json_folder = "json";// Or maybe the user only specifies the hash, and ommits the quote and url$requested_hash = isset($quote) ? $computed_hash : $_GET['hash'];$requested_file = $json_folder . "/" . $requested_hash . ".js";// Check to see if json file already exists.  If so, output itif (file_exists($requested_file)){	$file = fopen($requested_file, 'r');	header('Content-Type: application/json');	header("Content-Length: " . filesize($requested_file));	fpassthru($file);				exit;}else {	// Download url and parse out before and after sections	$html = file_get_html($url)->plaintext;	//Get plaintext version of URL	$html = htmlentities($html, ENT_QUOTES, 'UTF-8');	$html = $mystring = str_replace("&nbsp;", " ", $html);	if ($_GET['debug'] == "plaintext"){		echo($html);	}	//Calculate starting position of quote	$quote_length = strlen($quote);	$quote_start_pos = stripos($html, $quote);	if (strpos($quote_start_pos, $quote) !== false){		echo("Can't find the quote");	}	else {		$quote_end_pos = $quote_start_pos + $quote_length;		$prior_quote_context_length = 378;	// hard coded to match this particular quote		$after_quote_context_length = 1696;	// hard coded to match this particular			//Calculate starting position of prior and subsequent sections		$context_start_pos = $quote_start_pos - $prior_quote_context_length;			$context_end_pos = $quote_end_pos + $after_quote_context_length;			//Get text that immediately preceeds and follows		$context_before = trim(substr($html, $context_start_pos, $prior_quote_context_length )); //quote_length);		$context_quote = trim(substr($html, $quote_start_pos, $quote_length ));		$context_after = ltrim(substr($html, $quote_end_pos, $after_quote_context_length));				$json = json_encode( 				array("url"=> $url,					"before"=> $context_before,					"after"=> $context_after				));		// Save data to json file		$file = fopen($requested_file, "w");		fwrite($file, $json);		// Send output to browser		echo($json);	}}// Download citing page and verify that the quote is valid, (restrict to local domain)?>