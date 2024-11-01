<div class="wrap">

<h2>Zend Framework</h2>
<h3>About </h3>
<p><?php
echo '<b>Zend directory:- </b>' . ZEND_DIR ;
?></p>
<p>Zend Framework
  Extending the art & spirit of PHP, Zend Framework is based on simplicity, object-oriented best practices, corporate friendly licensing, and a rigorously tested agile codebase. Zend Framework is focused on building more secure, reliable, and modern Web 2.0 applications & web services, and consuming widely available APIs from leading vendors like Google, Amazon, Yahoo!, Flickr, as well as API providers and cataloguers like StrikeIron and ProgrammableWeb.</p>
<h3>Zend Framework Xtended</h3>
<p>Xtend wordpress with one of the most powerful php libaries available, download only what you need or grab the whole hog does not matter once you add it to you libaries you are ready to rock!!!</p>
<h3>Zend Links</h3>
<ol>
  <li><a href="http://framework.zend.com/">Framework</a></li>
  <li><a href="http://framework.zend.com/download/overview" target="_blank">Download</a></li>
  <li><a href="http://framework.zend.com/manual/manual" target="_blank">Reference Guide</a></li>
  <li><a href="http://devzone.zend.com/tutorials" target="_blank">Tutorials</a></li>
</ol>
<h3>Usage Sample</h3>
<p><strong>File Transfer</strong> use Zend component simple instansitate and use <strong>XTENDED</strong> built in autoloading...</p>

<blockquote>
  <pre>$adapter = new Zend_File_Transfer_Adapter_Http();<br /><br />$adapter-&gt;setDestination('C:\temp');<br /><br />if (!$adapter-&gt;receive()) {<br />    $messages = $adapter-&gt;getMessages();<br />    echo implode(&quot;\n&quot;, $messages);<br />}</pre>
</blockquote>
<p>&nbsp;</p>
</div>
