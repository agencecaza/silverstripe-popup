<h1>agencecaza/silverstripe-popup</h1>
<p>Enable a popup modal with custom settings directly from the LeftAndMain menu.</p>

<h2>Installation</h2>
<code>composer require agencecaza/silverstripe-popup</code>

<h2>Usage</h2>
<p>Add <code><% include Popup %></code> in the <code>body</code> of your site.

<h2>Customisation</h2>
<p>Put the template in your app project <code>app/templates/Includes/Popup.ss</code>.</p>


<h2>Enable locales config with Fluent extension</h2>
<p>Add the following code in your <code>app.yml</code> to enable.</p>

<pre>
AgenceCaza\Popup\PopupConfig:
  extensions:
    - TractorCow\Fluent\Extension\FluentVersionedExtension
  translate:
    - Content
    - ButtonText
</pre>

<h2>ToDos</h2>
<ul>
<li>Improve cookie usage with Silverstripe class</li>
<li>Resolve javascript reset issue after save</li>
<li>Release a stable module</li>
</ul>
