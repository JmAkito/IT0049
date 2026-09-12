<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-heading"><div class="container"><p class="eyebrow">ABOUT THE PROJECT</p><h1>A practical introduction to CodeIgniter MVC.</h1><p>This four-page application demonstrates how a URL becomes a rendered page through routes, controllers, and views.</p></div></section>
<section class="container about-grid">
    <div>
        <h2>How it works</h2>
        <p>The route selects a controller method. The controller prepares the page data, and the view converts that data into HTML for the browser.</p>
        <p>Customer and user records currently come from static PHP arrays. These arrays act as temporary data sources until database integration is introduced.</p>
    </div>
    <ol class="process">
        <li><span>1</span><div><strong>Route</strong><p>Matches the requested URL.</p></div></li>
        <li><span>2</span><div><strong>Controller</strong><p>Prepares data and selects a view.</p></div></li>
        <li><span>3</span><div><strong>View</strong><p>Displays the final HTML page.</p></div></li>
    </ol>
</section>
<?= $this->endSection() ?>
