/* * Quote-Context JS Library * https://github.com/timlangeman/quote-context/ * * Copyright 2015, Tim Langeman * http://www.openpolitics.com/tim * * Licensed under the MIT license: * http://www.opensource.org/licenses/MIT */jQuery.fn.quoteContext = function() {	// Add "before" and "after" sections to quote excerpts	// Designed to work for "blockquote" and "q" tags	jQuery(this).each(function(){		if( jQuery(this).attr("cite") ){			var blockcite = jQuery(this);			var url = blockcite.attr("cite").replace("+", "%20");			if (url.length > 3){				var url_quote = url + "|" + blockcite.text();				var quote_hash = jQuery.md5(encodeURIComponent(url_quote)); 				var json = null;			    jQuery.ajax({			        type: "GET",			        url: '/json/' + quote_hash + '.js',			        dataType: "json",			        success: function(json) {			            add_quote_to_dom( json );			        },			        error: function() {						download_quote_from_url(url, blockcite.text());			        }			    });				function add_quote_to_dom( json ) {					//Fill before and after divs and then quickly hide them					blockcite.before("<div class='quote_context' id='quote_before_" + json['quote_hash'] + "'> \						<blockquote class='quote_context'>.. " + json["before"] + "</blockquote></div>");					blockcite.after("<div class='quote_context' id='quote_after_" + json['quote_hash'] + "'> \						<blockquote class='quote_context'>" + json["after"] + " ..</blockquote></div>");					var context_before = jQuery("#quote_before_" + json['quote_hash']);					var context_after = jQuery("#quote_after_" + json['quote_hash']);					context_before.hide();					context_after.hide();					//Display arrows if content is found					if( json['before'].length > 0){					context_before.before("<div class='quote_arrows' id='context_up_" + json['quote_hash'] + "'> \						<a href=\"javascript:toggle_quote('before', 'quote_before_" + json['quote_hash'] + "');\">&#9650;</a></div>");					}					if( json['after'].length > 0){										context_after.after("<div class='quote_arrows' id='context_down_" + json['quote_hash'] +"'> \						<a href=\"javascript:toggle_quote('after', 'quote_after_" + json['quote_hash'] +"');\">&#9660;</a></div>");					}				}				function download_quote_from_url(url,quote) {				    jQuery.ajax({				        type: "POST",				        url: 'download_quote_from_url.php',						data: {'url': url, 'quote': quote},				        dataType: "json",				        success: function(json) {				            add_quote_to_dom( json );							return json;				        },				        error: function() {							alert("unable to find quote on original site.")				        }				    });				}			} // if url.length is not blank		}	// if "this" has a "cite" attribute	});   // foreach(this): blockquote, or q tag };