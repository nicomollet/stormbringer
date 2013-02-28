<?php
/**
 * The template for displaying Twitter Bootstrap Styles.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 *
 * Template Name: Styles
 */
?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

<?php stormbringer_breadcrumb();?>

<?php if (have_posts()) : the_post(); ?>
  <?php $format = get_post_format();
  if (false === $format)
    $format = 'standard';
  get_template_part('content', 'page');
  ?>
  <?php endif;?>
<section class="content-styles-typography">
  <div class="page-header">
    <h2>Typography</h2>
  </div>

  <h3>Headings</h3>

  <div class="bs-docs-example">
    <h1>h1. Heading 1</h1>

    <h2>h2. Heading 2</h2>

    <h3>h3. Heading 3</h3>
    <h4>h4. Heading 4</h4>
    <h5>h5. Heading 5</h5>
    <h6>h6. Heading 6</h6>
  </div>

  <h3 id="body-copy">Body copy</h3>

  <div class="bs-docs-example">
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient
      montes,
      nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>

    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla
      non
      metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem
      nec
      elit. Donec ullamcorper nulla non metus auctor fringilla.</p>

    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget
      metus.
      Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
  </div>

  <h3>Emphasis classes</h3>

  <div class="bs-docs-example">
    <p class="muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>

    <p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>

    <p class="text-error">Donec ullamcorper nulla non metus auctor fringilla.</p>

    <p class="text-info">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis.</p>

    <p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
  </div>


  <h3 id="abbreviations">Abbreviations</h3>

  <div class="bs-docs-example">
    <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
  </div>


  <h3 id="blockquotes">Blockquotes</h3>

  <div class="bs-docs-example">
    <blockquote>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
    </blockquote>
  </div>

  <div class="bs-docs-example">
    <blockquote>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
    </blockquote>
  </div>

  <hr class="bs-docs-separator">


  <h3>Lists</h3>

  <h4>Unordered</h4>

  <div class="bs-docs-example">
    <ul>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Consectetur adipiscing elit</li>
      <li>Integer molestie lorem at massa</li>
      <li>Facilisis in pretium nisl aliquet</li>
      <li>Nulla volutpat aliquam velit
        <ul>
          <li>Phasellus iaculis neque</li>
          <li>Purus sodales ultricies</li>
          <li>Vestibulum laoreet porttitor sem</li>
          <li>Ac tristique libero volutpat at</li>
        </ul>
      </li>
      <li>Faucibus porta lacus fringilla vel</li>
      <li>Aenean sit amet erat nunc</li>
      <li>Eget porttitor lorem</li>
    </ul>
  </div>

  <h4>Ordered</h4>

  <div class="bs-docs-example">
    <ol>
      <li>Lorem ipsum dolor sit amet</li>
      <li>Consectetur adipiscing elit</li>
      <li>Integer molestie lorem at massa</li>
      <li>Facilisis in pretium nisl aliquet</li>
      <li>Nulla volutpat aliquam velit</li>
      <li>Faucibus porta lacus fringilla vel</li>
      <li>Aenean sit amet erat nunc</li>
      <li>Eget porttitor lorem</li>
    </ol>
  </div>
  <h4>Unstyled <code>.unstyled</code></h4>

  <div class="bs-docs-example">
    <ul class="unstyled">
      <li>Lorem ipsum dolor sit amet</li>
      <li>Consectetur adipiscing elit</li>
      <li>Integer molestie lorem at massa</li>
      <li>Facilisis in pretium nisl aliquet</li>
      <li>Nulla volutpat aliquam velit
        <ul>
          <li>Phasellus iaculis neque</li>
          <li>Purus sodales ultricies</li>
          <li>Vestibulum laoreet porttitor sem</li>
          <li>Ac tristique libero volutpat at</li>
        </ul>
      </li>
      <li>Faucibus porta lacus fringilla vel</li>
      <li>Aenean sit amet erat nunc</li>
      <li>Eget porttitor lorem</li>
    </ul>
  </div>

  <h3>Description</h3>

  <div class="bs-docs-example">
    <dl>
      <dt>Description lists</dt>
      <dd>A description list is perfect for defining terms.</dd>
      <dt>Euismod</dt>
      <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
      <dd>Donec id elit non mi porta gravida at eget metus.</dd>
      <dt>Malesuada porta</dt>
      <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
    </dl>
  </div>

  <h4>Horizontal description</h4>

  <div class="bs-docs-example">
    <dl class="dl-horizontal">
      <dt>Description lists</dt>
      <dd>A description list is perfect for defining terms.</dd>
      <dt>Euismod</dt>
      <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
      <dd>Donec id elit non mi porta gravida at eget metus.</dd>
      <dt>Malesuada porta</dt>
      <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
      <dt>Felis euismod semper eget lacinia</dt>
      <dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet
        risus.
      </dd>
    </dl>
  </div>

</section>



<section id="tables">
  <div class="page-header">
    <h2>Tables</h2>
  </div>


  <h3>Table hover <code>.table-hover</code></h3>


  <div class="bs-docs-example">
    <table class="table table-hover">
      <thead>
      <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>1</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <td>3</td>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
      </tr>
      </tbody>
    </table>
  </div>

  <h3>Striped <code>.table-striped</code></h3>

  <div class="bs-docs-example">
    <table class="table table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>1</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <td>3</td>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
      </tbody>
    </table>
  </div>
  <h3>Bordered <code>.table-bordered</code></h3>

  <div class="bs-docs-example">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td rowspan="2">1</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <td>Mark</td>
        <td>Otto</td>
        <td>@TwBootstrap</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <td>3</td>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
      </tr>
      </tbody>
    </table>
  </div>

  <h3>Condensed <code>.table-condensed</code></h3>


  <div class="bs-docs-example">
    <table class="table table-condensed">
      <thead>
      <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>1</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <td>3</td>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
      </tr>
      </tbody>
    </table>
  </div>


</section>


<section id="forms">
<div class="page-header">
  <h2>Forms</h2>
</div>

<h3>Default styles</h3>

<form class="bs-docs-example">
  <legend>Legend</legend>
  <label>Label name</label>
  <input type="text" placeholder="Type something…">
  <span class="help-block">Example block-level help text here.</span>
  <label class="checkbox">
    <input type="checkbox"> Check me out
  </label>
  <button class="btn" type="submit">Submit</button>
</form>

<h3>Search form <code>.form-search</code></h3>


<form class="bs-docs-example form-search">
  <input type="text" class="input-medium search-query">
  <button class="btn" type="submit">Search</button>
</form>

<h3>Inline form <code>.form-inline</code></h3>


<form class="bs-docs-example form-inline">
  <input type="text" placeholder="Email" class="input-small">
  <input type="password" placeholder="Password" class="input-small">
  <label class="checkbox">
    <input type="checkbox"> Remember me
  </label>
  <button class="btn" type="submit">Sign in</button>
</form>

<h3>Horizontal form <code>.form-horizontal</code></h3>

<form class="bs-docs-example form-horizontal">
  <legend>Legend</legend>
  <div class="control-group">
    <label for="inputEmail" class="control-label">Email</label>

    <div class="controls">
      <input type="text" placeholder="Email" id="inputEmail">
    </div>
  </div>
  <div class="control-group">
    <label for="inputPassword" class="control-label">Password</label>

    <div class="controls">
      <input type="password" placeholder="Password" id="inputPassword">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <label class="checkbox">
        <input type="checkbox"> Remember me
      </label>
      <button class="btn" type="submit">Sign in</button>
    </div>
  </div>
</form>



<h3>Prepended and appended inputs</h3>
<h4>Default options</h4>

<form class="bs-docs-example">
  <div class="input-prepend">
    <span class="add-on">@</span>
    <input type="text" placeholder="Username" size="16" id="prependedInput" class="span2">
  </div>
  <br>

  <div class="input-append">
    <input type="text" size="16" id="appendedInput" class="span2">
    <span class="add-on">.00</span>
  </div>
</form>

<h4>Combined</h4>


<form class="bs-docs-example form-inline">
  <div class="input-prepend input-append">
    <span class="add-on">$</span>
    <input type="text" size="16" id="appendedPrependedInput" class="span2">
    <span class="add-on">.00</span>
  </div>
</form>

<h4>Buttons instead of text</h4>


<form class="bs-docs-example">
  <div class="input-append">
    <input type="text" size="16" id="appendedInputButton" class="span2">
    <button type="button" class="btn">Go!</button>
  </div>
  <br>

  <div class="input-append">
    <input type="text" size="16" id="appendedInputButtons" class="span2">
    <button type="button" class="btn">Search</button>
    <button type="button" class="btn">Options</button>
  </div>
</form>
<h4>Search form</h4>

<form class="bs-docs-example form-search">
  <div class="input-append">
    <input type="text" class="span2 search-query">
    <button class="btn" type="submit">Search</button>
  </div>
  <div class="input-prepend">
    <button class="btn" type="submit">Search</button>
    <input type="text" class="span2 search-query">
  </div>
</form>

<h4>Control sizing</h4>


<form style="padding-bottom: 15px;" class="bs-docs-example">
  <div class="controls docs-input-sizes">
    <input type="text" placeholder=".input-mini" class="input-mini">
    <input type="text" placeholder=".input-small" class="input-small">
    <input type="text" placeholder=".input-medium" class="input-medium">
    <input type="text" placeholder=".input-large" class="input-large">
    <input type="text" placeholder=".input-xlarge" class="input-xlarge">
    <input type="text" placeholder=".input-xxlarge" class="input-xxlarge">
  </div>
</form>


<h4>Uneditable inputs</h4>


<form class="bs-docs-example">
  <span class="input-xlarge uneditable-input">Some value here</span>
</form>

<h3>Form actions</h3>

<form class="bs-docs-example">
  <div class="form-actions">
    <button class="btn btn-primary" type="submit">Save changes</button>
    <button class="btn" type="button">Cancel</button>
  </div>
</form>

<h3>Help text</h3>

<form class="bs-docs-example form-inline">
  <input type="text"> <span class="help-inline">Inline help text</span>
</form>

<h4>Block help</h4>

<form class="bs-docs-example form-inline">
  <input type="text">
  <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
</form>


<h3>Form control states</h3>


<h4>Disabled inputs <code>.disabled</code></h4>


<form class="bs-docs-example form-inline">
  <input type="text" disabled="" placeholder="Disabled input here…" id="disabledInput" class="input-xlarge">
</form>

<h4>Validation states</h4>

<form class="bs-docs-example form-horizontal">
  <div class="control-group warning">
    <label for="inputWarning" class="control-label">Input with warning</label>

    <div class="controls">
      <input type="text" id="inputWarning">
      <span class="help-inline">Something may have gone wrong</span>
    </div>
  </div>
  <div class="control-group error">
    <label for="inputError" class="control-label">Input with error</label>

    <div class="controls">
      <input type="text" id="inputError">
      <span class="help-inline">Please correct the error</span>
    </div>
  </div>
  <div class="control-group info">
    <label for="inputError" class="control-label">Input with info</label>

    <div class="controls">
      <input type="text" id="inputError">
      <span class="help-inline">Username is taken</span>
    </div>
  </div>
  <div class="control-group success">
    <label for="inputSuccess" class="control-label">Input with success</label>

    <div class="controls">
      <input type="text" id="inputSuccess">
      <span class="help-inline">Woohoo!</span>
    </div>
  </div>
</form>

</section>

<section id="buttons">
  <div class="page-header">
    <h2>Buttons</h2>
  </div>

  <h3>Default buttons</h3>

  <div class="bs-docs-example">
    <button class="btn" type="button">Default</button>
    <button class="btn btn-primary" type="button">Primary</button>
    <button class="btn btn-info" type="button">Info</button>
    <button class="btn btn-success" type="button">Success</button>
    <button class="btn btn-warning" type="button">Warning</button>
    <button class="btn btn-danger" type="button">Danger</button>
    <button class="btn btn-inverse" type="button">Inverse</button>
    <button class="btn btn-link" type="button">Link</button>
  </div>
  <h3>Button sizes</h3>

  <div class="bs-docs-example">
    <p>
      <button class="btn btn-large btn-primary" type="button">Large button</button>
      <button class="btn btn-large" type="button">Large button</button>
    </p>
    <p>
      <button class="btn btn-primary" type="button">Default button</button>
      <button class="btn" type="button">Default button</button>
    </p>
    <p>
      <button class="btn btn-small btn-primary" type="button">Small button</button>
      <button class="btn btn-small" type="button">Small button</button>
    </p>
    <p>
      <button class="btn btn-mini btn-primary" type="button">Mini button</button>
      <button class="btn btn-mini" type="button">Mini button</button>
    </p>
  </div>

  <div class="bs-docs-example">
    <div style="max-width: 400px; margin: 0 auto 10px;" class="well">
      <button class="btn btn-large btn-block btn-primary" type="button">Block level button</button>
      <button class="btn btn-large btn-block" type="button">Block level button</button>
    </div>
  </div>

  <h3>Disabled state</h3>

  <h4>Anchor element</h4>

  <p class="bs-docs-example">
    <a class="btn btn-large btn-primary disabled" href="#">Primary link</a>
    <a class="btn btn-large disabled" href="#">Link</a>
  </p>

  <h4>Button element</h4>

  <p class="bs-docs-example">
    <button disabled="disabled" class="btn btn-large btn-primary disabled" type="button">Primary button</button>
    <button disabled="" class="btn btn-large" type="button">Button</button>
  </p>


</section>
<section id="navs">
  <div class="page-header">
    <h2>Nav: tabs, pills, and lists</h2>
  </div>

  <h3>Basic tabs</h3>

  <div class="bs-docs-example">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Messages</a></li>
    </ul>
  </div>

  <h3>Basic pills</h3>

  <div class="bs-docs-example">
    <ul class="nav nav-pills">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Messages</a></li>
    </ul>
  </div>

  <h3>Disabled state</h3>

  <div class="bs-docs-example">
    <ul class="nav nav-pills">
      <li><a href="#">Clickable link</a></li>
      <li><a href="#">Clickable link</a></li>
      <li class="disabled"><a href="#">Disabled link</a></li>
    </ul>
  </div>

  <h3>Stacked tabs</h3>

  <div class="bs-docs-example">
    <ul class="nav nav-tabs nav-stacked">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Messages</a></li>
    </ul>
  </div>

  <h3>Stacked pills</h3>

  <div class="bs-docs-example">
    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Messages</a></li>
    </ul>
  </div>


  <h3>Tabs with dropdowns</h3>

  <div class="bs-docs-example">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Help</a></li>
      <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
  </div>

  <h3>Pills with dropdowns</h3>

  <div class="bs-docs-example">
    <ul class="nav nav-pills">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Help</a></li>
      <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
  </div>


  <h3>Example nav list</h3>

  <div class="bs-docs-example">
    <div style="max-width: 340px; padding: 8px 0;" class="well">
      <ul class="nav nav-list">
        <li class="nav-header">List header</li>
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li><a href="#">Applications</a></li>
        <li class="nav-header">Another list header</li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Settings</a></li>
        <li class="divider"></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
    <!-- /well -->
  </div>

  <h3>Tabbable example</h3>

  <div class="bs-docs-example">
    <div style="margin-bottom: 18px;" class="tabbable">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab1">Section 1</a></li>
        <li><a data-toggle="tab" href="#tab2">Section 2</a></li>
        <li><a data-toggle="tab" href="#tab3">Section 3</a></li>
      </ul>
      <div style="padding-bottom: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
        <div id="tab1" class="tab-pane active">
          <p>I'm in Section 1.</p>
        </div>
        <div id="tab2" class="tab-pane">
          <p>Howdy, I'm in Section 2.</p>
        </div>
        <div id="tab3" class="tab-pane">
          <p>What up girl, this is Section 3.</p>
        </div>
      </div>
    </div>
    <!-- /tabbable -->
  </div>

</section>
<section id="breadcrumbs">
  <div class="page-header">
    <h2>Breadcrumbs</h2>
  </div>

  <div class="bs-docs-example">
    <ul class="breadcrumb">
      <li class="active">Home</li>
    </ul>
    <ul class="breadcrumb">
      <li><a href="#">Home</a> <span class="divider">/</span></li>
      <li class="active">Library</li>
    </ul>
    <ul style="margin-bottom: 5px;" class="breadcrumb">
      <li><a href="#">Home</a> <span class="divider">/</span></li>
      <li><a href="#">Library</a> <span class="divider">/</span></li>
      <li class="active">Data</li>
    </ul>
  </div>

</section>

<section id="pagination">
  <div class="page-header">
    <h2>Pagination</h2>
  </div>
  <div class="bs-docs-example">
    <div class="pagination pagination-centered">
      <ul>
        <li class="disabled"><a href="#">«</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">»</a></li>
      </ul>
    </div>
  </div>

</section>
<section id="labels-badges">
  <div class="page-header">
    <h2>Labels and badges</h2>
  </div>
  <h3>Labels</h3>

  <div class="bs-docs-example">
    <span class="label">Default</span>
    <span class="label label-success">Success</span>
    <span class="label label-warning">Warning</span>
    <span class="label label-important">Important</span>
    <span class="label label-info">Info</span>
    <span class="label label-inverse">Inverse</span>
  </div>
  <h3>Badges</h3>

  <div class="bs-docs-example">
    <span class="badge">1</span>
    <span class="badge badge-success">2</span>
    <span class="badge badge-warning">4</span>
    <span class="badge badge-important">6</span>
    <span class="badge badge-info">8</span>
    <span class="badge badge-inverse">10</span>
  </div>


</section>


<section id="thumbnails">
  <div class="page-header">
    <h2>Thumbnails</h2>
  </div>

  <h3>Default thumbnails</h3>

  <div class="row-fluid">
    <ul class="thumbnails">
      <li class="span3">
        <a class="thumbnail" href="#">
          <img alt="" src="http://placehold.it/260x180">
        </a>
      </li>
      <li class="span3">
        <a class="thumbnail" href="#">
          <img alt="" src="http://placehold.it/260x180">
        </a>
      </li>
      <li class="span3">
        <a class="thumbnail" href="#">
          <img alt="" src="http://placehold.it/260x180">
        </a>
      </li>
      <li class="span3">
        <a class="thumbnail" href="#">
          <img alt="" src="http://placehold.it/260x180">
        </a>
      </li>
    </ul>
  </div>

  <h3>Highly customizable</h3>
  <div class="row-fluid">
    <ul class="thumbnails">
      <li class="span4">
        <div class="thumbnail">
          <img alt="400x200" src="http://placehold.it/200x400"/>
          <div class="caption">
            <h3>Thumbnail label</h3>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
            <p><a href="#" class="btn btn-primary">Action</a> <a href="#" class="btn">Action</a></p>
          </div>
        </div>
      </li>
      <li class="span4">
        <div class="thumbnail">
          <img alt="400x200" src="http://placehold.it/200x400"/>
          <div class="caption">
            <h3>Thumbnail label</h3>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
            <p><a href="#" class="btn btn-primary">Action</a> <a href="#" class="btn">Action</a></p>
          </div>
        </div>
      </li>
      <li class="span4">
        <div class="thumbnail">
          <img alt="400x200" src="http://placehold.it/200x400"/>
          <div class="caption">
            <h3>Thumbnail label</h3>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget qua.</p>
            <p><a href="#" class="btn btn-primary">Action</a> <a href="#" class="btn">Action</a></p>
          </div>
        </div>
      </li>
    </ul>
  </div>

</section>

<section id="alerts">
  <div class="page-header">
    <h2>Alerts</h2>
  </div>

  <div class="bs-docs-example">
    <div class="alert">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <strong>Warning!</strong> Best check yo self, you're not looking too good.
    </div>
    <div class="alert alert-block">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <h4>Warning!</h4>

      <p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo
        cursus magna, vel scelerisque nisl consectetur et.</p>
    </div>
    <div class="alert alert-error">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <strong>Oh snap!</strong> Change a few things up and try submitting again.
    </div>
    <div class="alert alert-success">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <strong>Well done!</strong> You successfully read this important alert message.
    </div>
    <div class="alert alert-info">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
    </div>
  </div>

</section>
<section id="progress">
  <div class="page-header">
    <h2>Progress bars</h2>
  </div>


  <h3>Basic</h3>

  <div class="bs-docs-example">
    <div class="progress">
      <div style="width: 60%;" class="bar"></div>
    </div>
  </div>

  <h3>Striped <code>.progress-striped</code></h3>

  <div class="bs-docs-example">
    <div class="progress progress-striped">
      <div style="width: 20%;" class="bar"></div>
    </div>
  </div>

  <h3>Animated <code>.progress-striped</code> <code>.active</code></h3>

  <p>Add <code>.active</code> to to animate the stripes right to left. Not available in all versions of IE.</p>

  <div class="bs-docs-example">
    <div class="progress progress-striped active">
      <div style="width: 45%" class="bar"></div>
    </div>
  </div>

  <h3>Stacked</h3>

  <div class="bs-docs-example">
    <div class="progress">
      <div style="width: 35%" class="bar bar-success"></div>
      <div style="width: 20%" class="bar bar-warning"></div>
      <div style="width: 10%" class="bar bar-danger"></div>
    </div>
  </div>

  <h3>Additional colors</h3>

  <div class="bs-docs-example">
    <div style="margin-bottom: 9px;" class="progress progress-info">
      <div style="width: 20%" class="bar"></div>
    </div>
    <div style="margin-bottom: 9px;" class="progress progress-success">
      <div style="width: 40%" class="bar"></div>
    </div>
    <div style="margin-bottom: 9px;" class="progress progress-warning">
      <div style="width: 60%" class="bar"></div>
    </div>
    <div class="progress progress-danger">
      <div style="width: 80%" class="bar"></div>
    </div>
  </div>


</section>

<section id="misc">
  <div class="page-header">
    <h2>Miscellaneous</h2>
  </div>

  <h3>Wells</h3>

  <div class="bs-docs-example">
    <div class="well">
      Look, I'm in a well!
    </div>
  </div>
  <h3>Well options</h3>

  <div class="bs-docs-example">
    <div class="well well-large">
      Look, I'm in a well!
    </div>
  </div>
  <div class="bs-docs-example">
    <div class="well well-small">
      Look, I'm in a well!
    </div>
  </div>

</section>

<section id="code">
  <div class="page-header">
    <h2>Code</h2>
  </div>

  <h3>Inline</h3>

  <div class="bs-docs-example">
    For example, <code>&lt;section&gt;</code> should be wrapped as inline.
  </div>
  <h3>Basic block</h3>

  <p>Use <code>&lt;pre&gt;</code> for multiple lines of code. Be sure to escape any angle brackets in the code for
    proper rendering.</p>

  <div class="bs-docs-example">
    <pre>&lt;p&gt;Sample text here...&lt;/p&gt;</pre>
  </div>
</section>
</div>
<!-- /#content -->

<?php get_footer(); ?>