<html>
<head>
<title>Welcome to CRUD Generator for CodeIgniter</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

</style>
</head>
<body>

<h1>What is CRUD generator for Codeigniter v0.5</h1>

<p>
  CRUD generator for Codeigniter generates code for  creating, reading, updating, and deleting database tables.<br />
  The Generator will create the following files.</p>
  
<ol>
  <li>Views</li>
  <ol>
    <li>{Controller_name}_list.php</li>
    <li>{Controller_name}_add.php</li>
    <li>{Controller_name}_edit.php</li>
  </ol>
  <li>Model</li>
  <ol>
    <li>Codegen_model.php -&gt; a generic model, you can  use you own model if you want.</li>
  </ol>
  <li>Controller</li>
  <ol>
    <li>{Controller_name}.php</li>
  </ol>
</ol>

<p><a href="http://projects.keithics.com/crud-generator-for-codeigniter/index.php/crud">VIEW DEMO HERE</a></p>
<p><a href="http://projects.keithics.com/crud-generator-for-codeigniter/crud-generator-for-ci-keithics.zip">DOWNLOAD</a></p>

<h1>Change Log Version 0.5 - April 3, 2011</h1>
<p>Now compatible with CI 2.01</p>
<p>Renamed model to codegen_model.php from crud_model.php</p>
<p>Will Overwrite files - see comments to disable it</p>


<h1>Details</h1>
<ol>
	<li>This is not scaffolding!</li>
    <li>Generates simple code</li>
    <li>Adds a form_validation.php under the config file so you can call it in any of your controller.</li>
    <li>The generator creates a generic controller, model and views in which you can edit and customized.</li>
    <li>You can customized the Table Header based using Aliases , see controller comments.</li>
    <li>Straight forward</li>
    <li>Pagination</li>
    <li>No CSS, No Images!</li>
</ol>
<h1>Installation:</h1>
<p>1. Unzip the files and copy it in htdocs, htdocs/codegen/</p>
<p>2. Configure the database then go to http://localhost/codegen/crud/</p>
<p>3. That's it!</p>

<h1>Other notes</h1>
  <p>Use this in localhost only!</p>
<h1>Bugs and suggestions? hit the comments!</h1>
<p>&nbsp;</p>
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=163673287007921&amp;xfbml=1"></script><fb:comments numposts="30" width="890" publish_feed="true"></fb:comments>

</body>
</html>