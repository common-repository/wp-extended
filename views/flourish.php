<div class="wrap">

<h2>Flourish Libs</h2>
<h3>About</h3>
<div class="img"><a href="http://flourishlib.com" target="_blank"><img src="http://cdn.flourishlib.com/header_logo_beta.gif" width="204" height="70" /></a></div>

<p>Flourish is an object-oriented PHP 5 library designed to reduce code and improve security. It’s not an MVC framework and it doesn’t try to solve every problem. Instead, it focuses on being small, portable, well documented and easy to use.</p>
<h2 id="WhyUseFlourish">Why Use Flourish?</h2>
<p>Flourish provides classes to simplify many common and repetitive tasks in PHP with class APIs that are simple and intuitive. It is built to improve the compatibility of code across databases, operating systems and different versions of PHP. It helps produce code that is easy to write, and more importantly, easy to read and maintain.</p>
<p>So how can Flourish help you? The <strong>How Do I … ? page</strong> contains a list of common issues and the classes that can help. Topics include database interaction, UTF-8 string handling, image manipulation, money calculations and much more. Still not quite sure? Check out these code examples to see Flourish in action.</p>
<h3>Flourish Links</h3>
<ul>
  <li>    <a href="http://flourishlib.com/docs/Download" target="_blank">Download Flourish Here</a></li>
  <li><a href="http://flourishlib.com/docs/HowDoI" target="_blank">How To I</a></li>
  <li><a href="http://flourishlib.com/docs/Documentation">Documentation</a></li>
  <li><a href="http://flourishlib.com/discussion" target="_blank">Forums</a></li>
  </ul>
<h3>XT &amp; Flourish Quick Start</h3>
<p>While wordpress provides ways to sanatize post and comment data, it is always safer to ensure that all your user input is sanatized. Using the Flourish <strong>fRequest</strong> to safely grab user input (post/get/delete) using a typecasting see the <a href="http://flourishlib.com/docs/fRequest" target="_blank">flourish docs for more info</a> on <strong>fRequest class methods.</strong></p>
<blockquote>
  <pre><em>&lt;?php $postdata = fRequest::get('twitter','string'); 
echo $postdata; ?&gt;
?&gt; </em></pre>
<strong>example 2</strong>
  <pre><em>&lt;?php  $user_id    = fRequest::get('user_id', 'integer', 0);  
$group_ids  = fRequest::get('group_ids', 'array', array(1));  
$first_name = fRequest::get('first_name');  ?&gt;</em></pre>
  <p><strong>Autoload / Instantiation</strong></p>
  <p>To use the validation the <a href="/docs/fValidation">fValidation</a> class must be instantiated before options can be set and the validation can be performed, WP Xtended autoloads the class so there in no need for file includes.</p>
  
    <pre>&nbsp;  </pre>
    <pre>try {      $validator = new fValidation();
            $validator-&gt;addRequiredFields(
          'name',
          array(
              'email',
              'phone'
          )      
);            
$validator-&gt;addEmailFields('email');
$validator-&gt;addEmailHeaderFields('name', 'email');
$validator-&gt;addDateFields('birthday');        
$validator-&gt;addURLFields('my_blog');       
$validator-&gt;validate();      
// Here you would perform the action of your contact form, such as emailing it...     
} catch (fValidationException $e) 
{      
$e-&gt;printMessage(); 
}</pre>
</blockquote>
<h3>Thats It</h3>
<p>Thats about it does not take much to wrap these into functions, and you have quick and simple way to extend Wordpress...!</p>
<p>&nbsp;...</p>


</div>