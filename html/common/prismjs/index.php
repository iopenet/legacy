<?php
/* xRender generator for XCL core */
$main = "../../mainfile.php";
if (file_exists($main)) {
    require_once $main;
    define('IS_XCL_CORE', 1);
    // xRender - XCL core auth
    $root =& XCube_Root::getSingleton();
    $root->mLanguageManager->loadPageTypeMessageCatalog('admin');
    $user =& $root->mContext->mUser;
    // xRender - XCL core log anonymous
    if ( $user->isInRole("Site.GuestUser") ) {
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP']; //ip from share internet
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; //ip pass from proxy
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    // xRender - XCL core log message
    $output_msg = '<h3>Server Log</h3><p>Date : '. date("Y-m-d H:i:s") . '<br>User IP : '. $_SERVER['REMOTE_ADDR'] .'<br>User Real IP : ' . getUserIpAddr() . '</p>';
    // xRender - XCL core log save to root path/uploads/
    $log  = "User IP : ".$_SERVER['REMOTE_ADDR'].' - '.date("Y-m-d H:i:s").PHP_EOL.
        "User Real IP : " . getUserIpAddr().PHP_EOL.
        "Attempt: Failed".PHP_EOL.
        "-------------------------".PHP_EOL;
    // xRender - XCL core log use FILE_APPEND to save string to log
    file_put_contents('../../uploads/log_common_'.date("Y-m-d").'.log', $log, FILE_APPEND);
    // xRender - XCL core redirect URL
    $root->mController->executeRedirect(XOOPS_URL,3,$message=$output_msg);
    } else if ( $user->isInRole('Site.Administrator') || $user->isInRole('Site.Owner') ) {
    ob_start();
   /* xRender template compatible with XCL core  */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XCL - PrismJS 1.25.0</title>
    <!-- Layout Helper and Plugins  -->
    <link rel="stylesheet" href="../js/jquery-ui.min.css">
    <link rel="stylesheet" href="../css/x-spa.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/x-utils.js"></script>
    <!-- ---------- Plugin -->

    <link rel="stylesheet" href="prism.css">
    <script src="prism.js"></script>
</head>
<body>
<header layout="column center-center" id="plugin">

    <nav self="left">
        <ul id="menu">
            <li><a href="#/">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                    <path d="M16 20h4v-4h-4m0-2h4v-4h-4m-6-2h4V4h-4m6 4h4V4h-4m-6 10h4v-4h-4m-6 4h4v-4H4m0 10h4v-4H4m6 4h4v-4h-4M4 8h4V4H4v4z" fill="currentColor"/>
                </svg></a>
                <ul class="menu-sub">
                    <li><a href="#quick_start">Quick Start</a></li>
                    <li><a href="#usage">Usage</a></li>
                    <li><a href="#languages">Languages</a></li>
                    <li><a href="#plugins">Plugins</a></li>
                    <li><a href="#themes">Themes</a></li>
                    <li><a href="#customize">Customize</a></li>
                    <li><a href="#/" id="about">About</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <section layout="row center sm-column m-auto" self="size-large" class="plugin-cover">

            <div self="size-1of3 center sm-full" class="plugin-logo">
                <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 200 170">
                <path fill="#fff" d="M55.37 131.5H48.4v9.13h6.97c1.67 0 2.92-.4 3.78-1.22.85
                -.8 1.28-1.92 1.28-3.33s-.43-2.54-1.28-3.35c-.86-.8-2.12-1.2-3.78-1.2m29.52
                6.4c.3-.53.47-1.2.47-2.04 0-1.35-.45-2.4-1.37-3.2-.92-.76-2.14-1.15-3.65
                -1.15H72.9v8.52h7.32c2.26 0 3.82-.7 4.67-2.1M100 0L0 170h200L100 0M60.86
                141.03c-1.3 1.22-3.1 1.84-5.33 1.84H48.4v7.55H46v-21.2h9.53c2.24 0 4.02.63
                5.34 1.87 1.3 1.23 1.96 2.88 1.96 4.95 0 2.1-.66 3.75-1.97 4.98m24.5 9.4l
                -5.1-8.14h-7.37v8.12h-2.4v-21.2h10.14c2.15 0 3.88.6 5.18 1.8 1.3 1.18 1.95
                2.8 1.95 4.84 0 2.64-1.1 4.44-3.3 5.4-.6.28-1.22.5-1.82.6l5.57 8.56h-2.85m
                13.43 0h-2.4v-21.2h2.4v21.2m23.56-1.32c-1.48 1.05-3.53 1.57-6.16 1.57-2.96 0
                -5.23-.6-6.78-1.85-1.4-1.1-2.18-2.7-2.37-4.74h2.5c.08 1.45.78 2.56 2.1 3.33
                1.16.67 2.68 1 4.58 1 3.97 0 5.95-1.25 5.95-3.74 0-.86-.35-1.53-1.07-2.02-.7
                -.5-1.6-.9-2.68-1.2-1.07-.33-2.24-.63-3.48-.9s-2.4-.65-3.5-1.08-1.97-1.02
                -2.68-1.73c-.7-.72-1.07-1.68-1.07-2.9 0-1.73.65-3.13 1.97-4.22 1.32-1.08
                3.32-1.62 6-1.62 2.67 0 4.75.6 6.23 1.85 1.34 1.1 2.05 2.5 2.14 4.2h-2.46c
                -.22-1.76-1.35-2.92-3.4-3.5-.72-.2-1.62-.3-2.7-.3s-1.98.1-2.72.35c-.74.25
                -1.3.55-1.7.9-.42.35-.7.74-.83 1.17s-.2.88-.2 1.36c0 .5.2.93.62 1.33s.96.75
                1.65 1.03c.68.28 1.46.52 2.33.73.88.2 1.77.43 2.67.65.9.22 1.8.48 2.68.77.87
                .3 1.65.65 2.33 1.1 1.53.96 2.28 2.27 2.28 3.94 0 2-.74 3.5-2.22 4.55m28.84
                1.32v-17.54l-7.84 10.08-7.97-10.08v17.54H133v-21.2h2.78l7.58 10.06 7.45
                -10.05h2.8v21.2h-2.4"/>
                </svg>
                </p>
            </div>

            <div self="size-2of3 sm-full" class="plugin-data">

                <h4 class="plugin-name">PrismJS</h4>

                <h5 class="plugin-version">version <a href="#quick_start">1.25.0</a></h5>

                <div class="plugin-desc">
                    <p class="bg"><span>Prism is a lightweight, extensible syntax highlighter that can be used when working with code blocks in your publications.</p>
                </div>

                <div class="plugin-options">
                    <p class="plugin-ref">Code block easily readable for education, support documents or training content, snippets or software elements.</p>
                </div>

            </div>

    </section>

</header>

<main layout="column" self="size-large">

<section layout="column" id="quick_start">

<article>

    <h3>PrismJS <span data-attr="version">1.25.0</span></h3>

<p>Prism is a lightweight, extensible syntax highlighter that can be used when working with code blocks in your publications.</p>
<p>Syntax highlighting is a feature of text editors (IDE) that are used for programming, scripting, or markup languages, such as HTML.
    Each code block has a specific programming language assigned (e.g. “HTML”, “CSS”, or "PHP"; this is configurable) with different colours according to the category of terms.
    The code block is easily readable for education, support documents or training content, snippets or software elements.</p>

<h3>Quick Start</h3>

<p>Include the <code>prism.css</code> file before the closing <code>&lt;/head&gt;</code> tag. Example:</p>

<pre><code class="language-html"><!--
...
<link rel="stylesheet" href="<{$xoops_url}>/common/prismjs/prism.css">
</head>
--></code></pre>

    <p>and include the <code>prism.js</code> file before the closing tag <code>&lt;/body&gt;</code>. Example:</p>

<pre><code class="language-html"><!--
<{* ---------- Theme Plugins *}>
<script defer src="<{$xoops_url}>/common/prismjs/prism.js"></script>
<script>Prism.highlightAll();</script>
</body>
--></code></pre>


</article>
</section>

<hr>

<section layout="column" id="usage">

    <article>

        <h3>Usage</h3>

        <p>The recommended way to markup source code (both for semantics and for Prism) is to use the <code>pre</code> + <code>code</code> element.</p>
        <p>According to the HTML5 spec, the recommended way to define a code language is a <code>class="language-xxxx"</code>, which is what Prism uses.
            Alternatively, Prism also supports a shorter version: <code>lang-xxxx</code></p>

        <p>To make things easier however, Prism assumes that this language definition is inherited.
            Therefore, if multiple <code>code</code> elements have the same language, you can add the <code>class="language-xxxx"</code> on the <code>body</code> or <code>html</code> element.</p>

        <p>The <code>class="language-none"</code> can be used for any non-existing language or to opt-out of highlighting a <code>code</code> element.</p>

    <pre><code class="language-html"><!--
    <pre><code class="language-css">
    p { color: red }
    </code></pre>
    --></code></pre>

        <p>By using this pattern, the <code>pre</code> element will automatically get the <code>class="language-xxxx"</code> (if it doesn’t already have it) and will be styled as a code block.</p>

        <div class="msg-callout msg-info">Important :
            <p>The following characters are reserved in HTML and must be replaced with their corresponding HTML entities</p></div>
        <p>Replace <kbd><</kbd> and <kbd>&</kbd> characters inside "code" elements (code blocks and inline snippets) or the browser might interpret them as an HTML tag or entity!</p>

        <table>
            <thead>
            <tr><th>Character</th><th>HTML Entity</th></tr>
            </thead>
            <tbody>
            <tr><td><kbd>"</kbd></td><td><strong>&amp;quot;</strong></td></tr>
            <tr><td><kbd>&amp;</kbd></td><td><strong>&amp;amp;</strong></td></tr>
            <tr><td><kbd>&lt;</kbd></td><td><strong>&amp;lt;</strong></td></tr>
            <tr><td><kbd>&gt;</kbd></td><td><strong>&amp;gt;</strong></td></tr>
            </tbody>
        </table>

        <p><strong>XCL package's version of PrismJS</strong> is customized with the <a href="#Unescaped_Markup">Unescaped Markup</a> plugin to work around this.<br>
            <strong>The HTML comment tag is required</strong> - which is regularly used to insert comments in the source code.</p>

        <p>Comments are not displayed in the browsers.<br><strong>Note</strong> the symbol <kbd>#</kbd> must be removed from HTML comment tag !</p>

    <pre><code class="language-none"><!--
    <pre><code class="language-css"><#!--
    <h3>Plugin</h3>
    --#></code></pre>
    --></code></pre>


    <h4>AJAX (Asynchronous JavaScript and XML)</h4>

    <p>By default, Prism will attempt to highlight all code elements by calling <code>Prism.highlightAll</code> on the current page.</p>

    <pre><code class="language-js"><!--
    // Run Prism syntax highlighting on the current page
    Prism.highlightAll();
    --></code></pre>

        <p>This might be a problem, for example, to asynchronously load additional languages or plugins.<br>
            By setting <code>Prism.manual</code> value to true, Prism will not automatically highlight all code elements on the page.<br>
       For example, add an empty Prism object into the global scope before loading the Prism script like this:</p>

    <pre><code class="language-javascript"><!--
    window.Prism = window.Prism || {};
    Prism.manual = true;
    // add a new <script> to load Prism's script
    --></code></pre>

        <p>We suggest the following recommendations to run JavaScript once DOM is loaded and ready.</p>

        <h4>1. Use <code>defer</code> attribute on javascript link in <code>head</code></h4>

    <pre><code class="language-html"><!--
    <script src="demo_defer.js" defer></script>
   --></code></pre>

    <p><em>Learn more from Mozilla - HTML elements reference - The Script element : <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/script#attr-defer" target="_blank" rel="nofollow"> The defer attribute</a></em></p>

    <h4>2. Or add the <code>script</code> that accesses DOM before closing tag <code>&lt;/body&gt;</code></h4>

    <h4>3. Select the inner <code>code</code>, not the <code>pre</code> element !</h4>

    <h4>Using plain Javascript</h4>

    <pre><code class="language-js">
    var block = document.getElementById('some-code')
    Prism.highlightElement(block);
    </code></pre>


    <h4>Using JQuery</h4>

    <pre><code class="language-js">
    Prism.highlightElement($('#some-code')[0]);
    </code></pre>

</article>

</section>

<hr>

<section layout="column" id="languages">

<article id="Markup_HTML">
    <h3>HTML</h3>
    <p>Element <code>pre</code> + <code>code class="language-html"</code>  with HTML comment tag <code>"&lt;!--"</code></p>

    <pre><code class="language-html"><!--
    <h3>Theme</h3>
    <p>Tomorrow Night, Rosey,  1.72KB</p>
    --></code></pre>

</article>

<article id="CSS">
    <h3>CSS</h3>
    <p>Element <code>pre</code> + <code>code class="language-css"</code></p>

    <pre><code class="language-css">
    main{
    background-color: hsl(210deg 20% 21%);
    border:10px solid hsl(210deg 20% 19%);
    border-radius:5px;
    }
    </code></pre>

</article>

<article id="Diff">
    <h3>DIFF</h3>
    <p>Element <code>pre</code> + <code>code class="language-diff"</code></p>
    <p>NOTE: This code block cannot have an empty space/tab at the start of lines !</p>

<pre><code class="language-diff">@@ -4,6 +4,5 @@
-    let foo = bar.baz([1, 2, 3]);
-    foo = foo + 1;
+    const foo = bar.baz([1, 2, 3]) + 1;
console.log(`foo: ${foo}`);
</code></pre>

    <h3>DIFF highlight</h3>
    <p>Element <code>pre</code> + <code>code class="language-diff diff-highlight"</code></p>

<pre><code class="language-diff diff-highlight">
@@ -4,6 +4,5 @@
-    let foo = bar.baz([1, 2, 3]);
-    foo = foo + 1;
+    const foo = bar.baz([1, 2, 3]) + 1;
console.log(`foo: ${foo}`);
</code></pre>

</article>

<article id="JavaScript">
    <h3>JavaScript</h3>
    <p>Element <code>pre</code> + <code>code class="language-js"</code></p>

    <pre><code class="language-js">
    var _self = (typeof window !== 'undefined')
    ? window   // if in browser
    : (
    (typeof WorkerGlobalScope !== 'undefined' && self instanceof WorkerGlobalScope)
    ? self // if in worker
    : {}   // if in node js
    );
    </code></pre>

</article>

<article id="PHP">
    <h3>PHP</h3>
    <p>Element <code>pre</code> + <code>code class="language-php"</code></p>

    <pre><code class="language-php">
    public function __construct( &$controller ) {
    $this->mController =& $controller;
    $this->mRoot       =& $this->mController->mRoot;
    }
    </code></pre>

</article>

<article id="Smarty">
    <h3>Smarty</h3>
    <p>Element <code>pre</code> + <code>code class="language-smarty"</code></p>

    <pre><code class="language-smarty"><!--
    <{include file="$xoops_theme/component/app_layout.html"}>
    {include file="$xoops_theme/component/app_layout.html"}
    --></code></pre>

</article>

<article id="SQL">
    <h3>No class language</h3>
    <p>Element <code>pre</code> + <code>code class="language-none"</code></p>

    <pre><code class="language-none">
    [Manifesto]
    Name="XOOPSCube XCL 2.3.1"
    Depends=Legacy_RenderSystem,legacy
    Url="https://github.com/xoopscube/legacy/"
    Version="2.3.1"
    </code></pre>

</article>

</section>

<hr>

<section layout="column" id="plugins">

    <article>
    <h3>Plugins</h3>
    <p><strong>XCL version of PrismJS</strong> includes these plugins.</p>

    <ul>
    <li><a href="https://prismjs.com/plugins/autolinker" target="_blank" rel="nofollow" title="Plugin documentation">Autolinker</a><br>
    Converts URLs and emails in code to clickable links. Parses Markdown links in comments.</li>

    <li><a href="https://prismjs.com/plugins/copy-to-clipboard" target="_blank" rel="nofollow">Copy to Clipboard</a><br>
    Add a button that copies the code block to the clipboard when clicked.</li>

    <li><a href="https://prismjs.com/plugins/diff-highlight" target="_blank" rel="nofollow">Diff Highlight</a><br>
    Highlights the code inside diff blocks.</li>

    <li><a href="https://prismjs.com/plugins/file-highlight" target="_blank" rel="nofollow">File Highlight</a><br>
    Fetch external files and highlight them with Prism. Used on the Prism website itself.</li>

    <li><a href="https://prismjs.com/plugins/toolbar" target="_blank" rel="nofollow">Toolbar</a><br>
    Attach a toolbar for plugins to easily register buttons on the top of a code block.</li>

    <li><a href="https://prismjs.com/plugins/unescaped-markup" target="_blank" rel="nofollow">Unescaped Markup</a><br>
    Write markup without having to escape the characters reserved in HTML, by replacing with their corresponding HTML entities.</li>
    </ul>
    </article>

</section>

<hr>

<section layout="row sm-column" id="themes">

    <article self="size-1of2 sm-full">
        <h3>Prism Themes</h3>
        <p>Selection of additional themes for the Prism syntax highlighting library.<br>
            To use one of the themes, just include the Prism theme's CSS file in your XCL Theme [ <a href="#quick_start">quick_start</a> ]</p>
        <p><a href="https://github.com/PrismJS/prism-themes" target="_blank" rel="nofollow">GitHub repo for Prism themes</a></p>
        <p><a href="https://github.com/kaicataldo/prism-material-themes" target="_blank" rel="nofollow">Prism Material Themes</a> </p>
        <p><a href=" https://prism.dotenv.dev/" target="_blank" rel="nofollow"> Create a Prism Theme from Visual Studio Code</a></p>
        <p><a href="https://atelierbram.github.io/syntax-highlighting/prism/" target="_blank" rel="nofollow">Prism Base16 Schemes</a></p>
        <p><a href="https://atelierbram.github.io/Base2Tone-prism/evening/dark/" target="_blank" rel="nofollow">Prism Base2Tone</a></p>
    </article>

    <article self="size-1of2 sm-full">
        <h3>Theme Generator</h3>
        <ol>
        <li>Create a custom Prism Theme with the generator and save the file "prism-theme.css"</li>
        <li>Upload "prism-theme.css" to /common/prismjs/</li>
        <li>or to the theme folder (edit "theme.html" CSS link to "prism-theme.css")</li>
        </ol>
        <div class="msg-callout">
            <a href="./generator.php" class="modal-control modal-open" target="iframe-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path d="M21.71 20.29l-1.42 1.42a1 1 0 0 1-1.41 0L7 9.85A3.81 3.81 0 0 1 6 10a4 4 0 0 1-3.78-5.3l2.54 2.54l.53-.53l1.42-1.42l.53-.53L4.7 2.22A4 4 0 0 1 10 6a3.81 3.81 0 0 1-.15 1l11.86 11.88a1 1 0 0 1 0 1.41M2.29 18.88a1 1 0 0 0 0 1.41l1.42 1.42a1 1 0 0 0 1.41 0l5.47-5.46l-2.83-2.83M20 2l-4 2v2l-2.17 2.17l2 2L18 8h2l2-4z" fill="currentColor"/>
                <rect x="0" y="0" width="1em" height="1em" fill="rgba(0, 0, 0, 0)" />
            </svg> Theme Generator</a><br>
            <span style="color:orange">The generated file "prism-theme.css" does not include styles for plugins or additional languages.</span>
        </div>
    </article>

</section>

<hr>

<section id="customize">
    <article>
        <h3>Customize Prism</h3>
        <p>Click the link below to customize the PrismJS version released with XCL package.</p>
        <p>Select your compression level, as well as the languages and plugins you need.</p>
        <p>Replace "prism.js" and "prism.css" in the directory /common/prismjs/ </p>
        <p><a href="https://prismjs.com/download.html#themes=prism-tomorrow&languages=markup+css+clike+javascript+css-extras+diff+markup-templating+php+smarty+sql&plugins=autolinker+file-highlight+unescaped-markup+toolbar+copy-to-clipboard+diff-highlight" target="_blank" rel="script">Customize PrismJS</a></p>
        <pre><code class="language-none">https://prismjs.com/download.html#themes=prism-tomorrow&languages=markup+css+clike+javascript+css-extras+diff+markup-templating+php+smarty+sql&plugins=autolinker+file-highlight+unescaped-markup+toolbar+copy-to-clipboard+diff-highlight</code></pre>

    </article>
</section>

</main>

<div id="dialog" title="About">
    <article id="documentation" class="rel-links">

        <h4>Documentation</h4>

        <p><a href="https://prismjs.com/" target="_blank" rel="nofollow">PrismJS web site</a></p>

        <p><a href="https://github.com/PrismJS" target="_blank" rel="nofollow">GitHub repositories</a></p>

        <p><a href="https://prismjs.com/docs/" target="_blank" rel="nofollow">API Documentation</a></p>

        <p><a href=https://prismjs.com/extending.html" target="_blank" rel="nofollow">Extending</a></p>

        <p><a href="https://prismjs.com/index.html#features-full" target="_blank" rel="nofollow">Full list of features</a></p>

        <p><a href="https://prismjs.com/index.html#limitations" target="_blank" rel="nofollow">Limitations</a></p>

        <h4>License</h4>

        <p>PrismJS/prism is licensed under the <a href="https://github.com/PrismJS/prism/blob/master/LICENSE" target="_blank" rel="nofollow">MIT License</a></p>
    </article>
</div>

<div class="modal-wrap" style="position:relative;top:20px;">
    <div id="modal-this" class="modal" tabindex="-1">
        <iframe id="iframe-this" height="90%" width="90%" src="" name="iframe-modal"></iframe>
        <a class="modal-control modal-close" href="" target="iframe-modal">&times; Close</a>
    </div>
</div>

<footer>
    <div layout="row center-justify" self="size-large mx-auto">
        <small>Powered by XCL 2.3.1 © 2005-2022 <a href="https://github.com/xoopscube/xcl" rel="external">The XOOPSCube Project</a> | <a href="https://github.com/xoopscube/documentation">Documentation</a></small>
    <a href="#top" class="back-to-top-link" aria-label="Scroll to Top">🔝</a>
    </div>
</footer>

<script>
    // pre code syntax
    Prism.highlightAll();
    //Scope Immediately Invoked Function Expression - IIFE
    // Encapsulate
    $(function() {
        // Top nav menu
        $( "#menu" ).menu();
        // Modal
        $("a.modal-control").on("click",function() {
            $("#iframe-this").attr("src", this.href );
            $( "body" ).toggleClass( "no-scroll" );
            $( ".modal" ).toggleClass( "modal-show" );
        });
        // Dialog
        $( "#dialog" ).dialog({
            autoOpen: false,
            minHeight: 200,
            width: 440,
            modal: false,
            draggable: true,
            resizable: false,
            // position: 'center',
            show: {
                effect: "blind",
                duration: 500
            },
            hide: {
                effect: "clip",
                duration: 500
            }
        });
        // About
        $( "#about" ).on( "click", function() {
            $( "#dialog" ).dialog( "open" );
        });

    });
</script>
</body>
</html>
<?php
// 1. xRender theme
// $root->mController->execute();
// 2. return the contents of the output buffer or false, if output buffering is not active
// if passing a callback to ob_start(), must use
return ob_get_contents();
// instead of: return ob_get_clean();
    }
    ob_clean();
}
?>
