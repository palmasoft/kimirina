<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-embed_close themed-color"></i>Syntax Highlighting<br><small>Showcase your code in style!</small></h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Components</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Syntax Highlighting</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Usage Block -->
    <div class="block block-themed">
        <!-- Usage Title -->
        <div class="block-title">
            <h4>Usage</h4>
        </div>
        <!-- END Usage Title -->

        <!-- Usage Content -->
        <div class="block-content">
            <p>Just a <code>&lt;code&gt;</code> element inside a <code>&lt;pre&gt;</code> element. To specify a language just add the class <code>.language-{value}</code> to the <code>&lt;code&gt;</code> element with one of the following values: <code>markup</code>, <code>css</code>, <code>javascript</code> or <code>php</code>. Check out the following examples:</p>
            <h4 class="sub-header">For HTML</h4>
            <pre class="line-numbers"><code class="language-markup">&lt;pre class=&quot;line-numbers&quot;&gt;&lt;code class=&quot;language-markup&quot;&gt;
HTML code..
&lt;/code&gt;&lt;/pre&gt;</code></pre>
            <h4 class="sub-header">For CSS</h4>
            <pre class="line-numbers"><code class="language-markup">&lt;pre class=&quot;line-numbers&quot;&gt;&lt;code class=&quot;language-css&quot;&gt;
CSS code..
&lt;/code&gt;&lt;/pre&gt;</code></pre>
            <h4 class="sub-header">For Javascript</h4>
            <pre class="line-numbers"><code class="language-markup">&lt;pre class=&quot;line-numbers&quot;&gt;&lt;code class=&quot;language-javascript&quot;&gt;
Javascript code..
&lt;/code&gt;&lt;/pre&gt;</code></pre>
            <h4 class="sub-header">For PHP</h4>
            <pre class="line-numbers"><code class="language-markup">&lt;pre class=&quot;line-numbers&quot;&gt;&lt;code class=&quot;language-php&quot;&gt;
PHP code..
&lt;/code&gt;&lt;/pre&gt;</code></pre>
            <div class="block-section"><span class="text-error">*</span> <em>For Internet Explorer, versions 9 and higher are supported</em></div>
        </div>
        <!-- END Usage Content -->
    </div>
    <!-- END Usage Block -->

    <!-- HTML Block -->
    <div class="block block-themed">
        <!-- HTML Title -->
        <div class="block-title">
            <h4>HTML <small>Basic Template Structure</small></h4>
        </div>
        <!-- END HTML Title -->

        <!-- HTML Content -->
        <div class="block-content">
            <pre class="line-numbers"><code class="language-markup">&lt;!-- Body --&gt;
&lt;!-- In the PHP version you can set the following options from the config file --&gt;
&lt;!-- Add the class .hide-side-content to &lt;body&gt; to hide side content by default --&gt;
&lt;body&gt;
    &lt;!-- Page Container --&gt;
    &lt;!-- In the PHP version you can set the following options from the config file --&gt;
    &lt;!-- Add the class .full-width for a full width page --&gt;
    &lt;div id=&quot;page-container&quot;&gt;
        &lt;!-- Header --&gt;
        &lt;!-- In the PHP version you can set the following options from the config file --&gt;
        &lt;!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively --&gt;
        &lt;header class=&quot;navbar navbar-inverse&quot;&gt;
            Search, Logo and Dropdowns
        &lt;/header&gt;
        &lt;!-- END Header --&gt;

        &lt;!-- Left Sidebar --&gt;
        &lt;!-- In the PHP version you can set the following options from the config file --&gt;
        &lt;!-- Add the class .sticky for a sticky sidebar --&gt;
        &lt;aside id=&quot;page-sidebar&quot; class=&quot;nav-collapse collapse&quot;&gt;
            Side Content + Main Navigation
        &lt;/aside&gt;
        &lt;!-- END Left Sidebar --&gt;

        &lt;!-- Pre Page Content --&gt;
        &lt;div id=&quot;pre-page-content&quot;&gt;
            Optional Content
        &lt;/div&gt;
        &lt;!-- END Pre Page Content --&gt;

        &lt;!-- Page Content --&gt;
        &lt;div id=&quot;page-content&quot;&gt;
            Main Content
        &lt;/div&gt;
        &lt;!-- END Page Content --&gt;

        &lt;!-- Footer --&gt;
        &lt;footer&gt;
            Copyright etc..
        &lt;/footer&gt;
        &lt;!-- END Footer --&gt;
    &lt;/div&gt;
    &lt;!-- END Page Container --&gt;
&lt;/body&gt;
&lt;!-- END Body --&gt;</code></pre>
        </div>
        <!-- END HTML Content -->
    </div>
    <!-- END HTML Block -->

    <!-- CSS Block -->
    <div class="block block-themed">
        <!-- CSS Title -->
        <div class="block-title">
            <h4>CSS <small>Basic Stylesheet Structure</small></h4>
        </div>
        <!-- END CSS Title -->

        <!-- CSS Content -->
        <div class="block-content">
            <pre class="line-numbers"><code class="language-css">/*
=================================================================
(#shortcode) SECTION
=================================================================
*/

/* Sub section 1 */
selector {
}

/* Sub section 2 */
selector {
}

/*
=================================================================
(#shortcode) SECTION
=================================================================
*/

/* Sub section 1 */
selector {
}

/* Sub section 2 */
selector {
}</code></pre>
        </div>
        <!-- END CSS Content -->
    </div>
    <!-- END CSS Block -->

    <!-- Javascript Block -->
    <div class="block block-themed">
        <!-- Javascript Title -->
        <div class="block-title">
            <h4>Javascript <small>Scroll to top function used in the template</small></h4>
        </div>
        <!-- END Javascript Title -->

        <!-- Javascript Content -->
        <div class="block-content">
            <pre class="line-numbers"><code class="language-javascript">/* Scroll to top link */
var scrollToTop = function() {

    // Get link
    var link = $(&#39;#to-top&#39;);

    $(window).scroll(function(){

        // If the user scrolled a bit (150 pixels) show the link
        if ($(this).scrollTop() > 150) {
            link.fadeIn(100);
        } else {
            link.fadeOut(100);
        }
    });

    // On click get to top
    link.click(function(){
        $(&#39;html, body&#39;).animate({ scrollTop: 0 }, 150);
        return false;
    });
};</code></pre>
        </div>
        <!-- END Javascript Content -->
    </div>
    <!-- END Javascript Block -->

    <!-- PHP Block -->
    <div class="block block-themed block-last">
        <!-- PHP Title -->
        <div class="block-title">
            <h4>PHP <small>Example Code</small></h4>
        </div>
        <!-- END PHP Title -->

        <!-- PHP Content -->
        <div class="block-content">
            <pre class="line-numbers"><code class="language-php">&lt;?php
// Comment
class Test {
    function home() {
        // ...
    }
}
?&gt;</code></pre>
        </div>
        <!-- END PHP Content -->
    </div>
    <!-- END PHP Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>