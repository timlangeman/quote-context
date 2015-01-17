<?php include("header.php"); ?><h2 class="entry-title"><a href="http://www.openpolitics.com/?p=4736" title="Permalink to Adding Quote-Context using jQuery" rel="bookmark">Adding Quote-Context using jQuery</a></h2><p>While revising the references for an <a href="http://www.openpolitics.com/2013/02/16/the-temptation-of-jesus-mercedes-edition/" target="_blank">earlier post</a>, I got the idea of adding contextual info to blockquotes:</p><a href="https://www.biblegateway.com/passage/?search=matthew+4&version=NRSV">Matthew 4</a>:<blockquote cite="'https://www.biblegateway.com/passage/?search=Matthew+4%3A1-11&amp;version=NRSV"><p>Then Jesus was led by the Spirit into the Desert to be tempted by the devil.  After fasting forty days and forty nights, he was hungry.  The tempter came to him and said, “If you are the Son of God, tell the stones to become bread.”</p><p>Jesus answered, “It is written: ‘Man does not live on bread alone, but on every word that comes from the mouth of God.”</p></blockquote><p>Which leads you to find the passage in <a href="https://www.biblegateway.com/passage/?search=Deuteronomy%208&version=NRSV">Deuteronomy</a> that Jesus was quoting and ask: &#8220;What was the context of this quote; and can I program something in jQuery to automatically expand this context:</p><a href="https://www.biblegateway.com/passage/?search=Deuteronomy%208&version=NRSV">Deuteronomy 8</a>:<blockquote cite="https://www.biblegateway.com/passage/?search=Deuteronomy+8&amp;version=NRSV"><p>He humbled you by letting you hunger, then by feeding you with manna, with which neither you nor your ancestors were acquainted, in order to make you understand that one does not live by bread alone, but by every word that comes from the mouth of the Lord.</p></blockquote><h2>Example:</h2>As an example of what I'm trying to achieve, here's a hard-coded example.  <div class="quote_arrows" id="context_up_www_nytimes_com/2014/11/19/opinion/how-medical-care-is-being-corrupted_html"><a href="javascript:toggle_quote('before', 'www_nytimes_com/2014/11/19/opinion/how-medical-care-is-being-corrupted_html');">&#9650;</a></div><div class="quote_context" id="quote_before"><blockquote class="quote_context">	These measures are clearly designed to coerce physicians to comply with the metrics. Thus doctors may feel pressured to withhold treatment that they feel is required or feel forced to recommend treatment whose risks may outweigh benefits.<p>It is not just treatment targets but also the particular medications to be used that are now often dictated by insurers. Commonly this is done by assigning a larger co-payment to certain drugs, a negative incentive for patients to choose higher-cost medications.</p></blockquote></div><blockquote id="www_nytimes_com/2014/11/19/opinion/how-medical-care-is-being-corrupted_html"cite="http://www.nytimes.com/2014/11/19/opinion/how-medical-care-is-being-corrupted.html">But now some insurers are offering a positive financial incentive directly to physicians to use specific medications. For example, WellPoint, one of the largest private payers for health care, recently outlined designated treatment pathways for cancer and announced that it would pay physicians an incentive of $350 per month per patient treated on the designated pathway.</blockquote><div class="quote_context" id="quote_after"><blockquote class="quote_context">	This has raised concern in the oncology community because there is considerable debate among experts about what is optimal. Dr. Margaret A. Tempero of the National Comprehensive Cancer Network observed that every day oncologists saw patients for whom deviation from treatment guidelines made sense: “Will oncologists be reluctant to make these decisions because of an adverse effects on payments?” Further, some health care networks limit the ability of a patient to get a second opinion by going outside the network. The patient is financially penalized with large co-payments or no coverage at all. Additionally, the physician who refers the patient out of network risks censure from the network administration.</blockquote></div>My goal is to incrementally develop this feature, starting with code to pull the expanded quote text from a <a href="deuteronomy-8.js">json file</a>.<div class="quote_arrows" id="context_down_www_nytimes.com/2014/11/19/opinion/how-medical-care-is-being-corrupted.html"><a href="javascript:toggle_quote('after', 'www_nytimes_com/2014/11/19/opinion/how-medical-care-is-being-corrupted_html');">&#9660;</a></div><?php include("footer.php"); ?>