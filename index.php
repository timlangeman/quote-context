<?php include("header.php"); ?><script type="text/javascript" src="lib/jquery.md5.js"></script><h2 class="entry-title"><a href="http://www.openpolitics.com/?p=4736" title="Permalink to Adding Quote-Context using jQuery" rel="bookmark">Adding Quote-Context using jQuery</a></h2><p>While revising the references for an <a href="http://www.openpolitics.com/2013/02/16/the-temptation-of-jesus-mercedes-edition/" target="_blank">earlier post</a>, I got the idea of adding contextual info to blockquotes:</p><a href="https://www.biblegateway.com/passage/?search=matthew+4&version=NRSV">Matthew 4</a>:<blockquote><p>Then Jesus was led up by the Spirit into the wilderness to be tempted by the devil. 2 He fasted forty days and forty nights, and afterwards he was famished. 3 The tempter came and said to him, “If you are the Son of God, command these stones to become loaves of bread.”</p><p>4 But he answered, “It is written, ‘One does not live by bread alone, but by every word that comes from the mouth of God.’”</p></blockquote><p>Which leads you to find the passage in <a href="https://www.biblegateway.com/passage/?search=Deuteronomy%208&version=NRSV">Deuteronomy</a> that Jesus was quoting and ask: "What was the context of this quote; and can I program something in jQuery to automatically expand this context":</p><a href="http://www.openpolitics.com/quote-context/cache/www.biblegateway.com/passage/%3fsearch=Deuteronomy+8.html">Deuteronomy 8</a>:<blockquote cite="https://www.biblegateway.com/passage/?search=Deuteronomy+8&amp;version=NRSV">one does not live by bread alone, but by every word that comes from the mouth of the Lord</blockquote><p>Right now I have working code to pull data from a <a href="deuteronomy-8.js">json file</a> and fill divs beforeand after the blockquote.  The next step is to define a process for creating and querying the json quote caches.</p><blockquote cite="http://en.wikipedia.org/wiki/Chinese_room?oldformat=true">The Chinese room is a thought experiment presented by John Searle</blockquote><div id="testing"></div><!--script type='text/javascript' src='/js/quote-context.js'></script--><script type="text/javascript">jQuery.fn.quoteContext = function() {	// Add "before" and "after" sections to quote excerpts	// Designed to work for "blockquote" tag, (and in the future "q" tag)	jQuery(this).each(function(){		if( jQuery(this).attr("cite") ){			var blockcite = jQuery(this);			var url = blockcite.attr("cite").replace("+", "%20");			if (url.length > 3){								var url_quote = url + "|" + blockcite.text();				var quote_hash = jQuery.md5(encodeURIComponent(url_quote)); 				var json = null;			    jQuery.ajax({			        type: "GET",			        url: '/json/' + quote_hash + '.js',			        dataType: "json",			        success: function(json) {			            add_quote_to_dom( json );			        },			        error: function() {						download_quote_from_url(url, blockcite.text());			        }			    });							function add_quote_to_dom( json ) {										//Fill before and after divs and then quickly hide them					blockcite.before("<div class='quote_context' id='quote_before_" + json['quote_hash'] + "'> \						<blockquote class='quote_context'>.. " + json["before"] + "</blockquote></div>");					blockcite.after("<div class='quote_context' id='quote_after_" + json['quote_hash'] + "'> \						<blockquote class='quote_context'>" + json["after"] + " ..</blockquote></div>");						var context_before = jQuery("#quote_before_" + json['quote_hash']);					var context_after = jQuery("#quote_after_" + json['quote_hash']);										context_before.hide();					context_after.hide();										//Display arrows if content is found					if( json['before'].length > 0){					context_before.before("<div class='quote_arrows' id='context_up_" + json['quote_hash'] + "'> \						<a href=\"javascript:toggle_quote('before', 'quote_before_" + json['quote_hash'] + "');\">&#9650;</a></div>");					}					if( json['after'].length > 0){										context_after.after("<div class='quote_arrows' id='context_down_" + json['quote_hash'] +"'> \						<a href=\"javascript:toggle_quote('after', 'quote_after_" + json['quote_hash'] +"');\">&#9660;</a></div>");					}									}				function download_quote_from_url(url,quote) {				    jQuery.ajax({				        type: "POST",				        url: 'download_quote_from_url.php',						data: {'url': url, 'quote': quote},				        dataType: "json",				        success: function(json) {				            add_quote_to_dom( json );							return json;				        },				        error: function() {							alert("unable to find quote on original site.")				        }				    });				}											} // if url.length is not blank		}	// if "this" has a "cite" attribute	});   // foreach(this): blockquote, or q tag }; // Call plugin on all blockquotes:jQuery( "blockquote" ).quoteContext(); 	</script><?php include("footer.php"); ?>