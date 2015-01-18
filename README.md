Quote-context
================
expands "q" and "blockquote" tags with text from cited url that surrounds the quoted text.

uses jQuery, jQuery.md5

DEMO: http://www.openpolitics.com/quote-context/

BEFORE:
<blockquote cite="https://www.biblegateway.com/passage/?search=Deuteronomy+8&amp;version=NRSV">
He humbled you by letting you hunger, then by feeding you with manna, with which neither you nor 
your ancestors were acquainted, in order to make you understand that <strong>one does not live 
by bread alone, but by every word that comes from the mouth of the Lord</strong>.</blockquote>


AFTER:

<div class="quote_arrows" id="context_up_972f988c868d325a2a64463250dd9242">
  <a href="javascript:toggle_quote('before', 'quote_before_972f988c868d325a2a64463250dd9242');">▲</a>
</div>
<div class="quote_context" id="quote_before_972f988c868d325a2a64463250dd9242" style="display: block;">
  <blockquote class="quote_context">8 This entire commandment that I command you today you must diligently observe, 
  so that you may live and increase, and go in and occupy the land that the Lord promised on oath to your 
  ancestors. 2 Remember the long way that the Lord your God has led you these forty years in the wilderness, 
  in order to humble you, testing you to know what was in your heart, whether or not you would keep his 
  commandments.
  </blockquote>
</div>

<blockquote cite="https://www.biblegateway.com/passage/?search=Deuteronomy+8&amp;version=NRSV">
He humbled you by letting you hunger, then by feeding you with manna, with which neither you nor 
your ancestors were acquainted, in order to make you understand that <strong>one does not live 
by bread alone, but by every word that comes from the mouth of the Lord</strong>.</blockquote>

<div class="quote_context" id="quote_after_972f988c868d325a2a64463250dd9242" style="display: none;"> 					
  <blockquote class="quote_context">4 The clothes on your back did not wear out and your feet did not 
  swell these forty years. 5 Know then in your heart that as a parent disciplines a child so the Lord 
  your God disciplines you. 6 Therefore keep the commandments of the Lord your God, by walking in his 
  ways and by fearing him. 7 For the Lord your God is bringing you into a good land, a land with 
  flowing streams, with springs and underground waters welling up in valleys and hills, 8 a land 
  of wheat and barley, of vines and fig trees and pomegranates, a land of olive trees and honey, 
  9 a land where you may eat bread without scarcity, where you will lack nothing, a land whose 
  stones are iron and from whose hills you may mine copper. 10 You shall eat your fill and 
  bless the Lord your God for the good land that he has given you.
</blockquote></div>

<div class="quote_arrows" id="context_down_972f988c868d325a2a64463250dd9242">
  <a href="javascript:toggle_quote('after', 'quote_after_972f988c868d325a2a64463250dd9242');">▼</a>
</div>
