<?php

$assets = "/packages/cvcnetwork/beanstalkconsole";
$url = URL::current();

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Beanstalk console</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Le styles -->
  <link href="<?php print $assets; ?>/css/bootstrap.css" rel="stylesheet">

  <style type="text/css">
    body {
      padding:80px 10px 40px 10px;
    }

    .sidebar-nav {
      padding:9px 0;
    }
  </style>

  <script>
    var url = "?server=<?php echo $server?>";
    var contentType = "<?php echo isset($contentType)?$contentType:''?>";
  </script>

  <link href="<?php print $assets; ?>/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="<?php print $assets; ?>/css/customer.css" rel="stylesheet">
  <link href="<?php print $assets; ?>/highlight/styles/magula.css" rel="stylesheet">

  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body data-spy="scroll" data-target=".subnav" data-offset="50">

<!-- Header Line -->
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="">Beanstalk console</a>

      <div class="btn-toolbar pull-right" style="margin: 0px; padding: 0px; height: 40px">
        <?php if (empty($tube)): ?>
          <div class="btn-group" style="margin: 0px 21px 0px 0px;">
            <a class="btn btn-small" href="#" id="autoRefresh"><i class="icon-refresh"></i></a>
          </div>
        <?php endif; ?>
        <div class="btn-group">
          <a class="btn btn-info" id="addServer" href="#"><i class="icon-plus-sign icon-white"></i> Add server</a>
          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-leaf"></i> Server<span class="caret"></span>
          </a>
          <ul class="dropdown-menu" id="listServers">
            <?php foreach ($config['servers'] as $item): ?>
              <li><a href="<?php $url; ?>?server=<?php echo $item ?>"><?php echo $item ?></a></li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>

      <div class="nav-collapse">
        <ul class="nav">
          <?php if (!empty($server)): ?>
            <li class="active"><a href="<?php $url; ?>?server=<?php echo $server ?>"><?php echo $server ?></a>
            </li><?php endif; ?>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
<div id="subnavServer" class="subnav subnav-fixed" style="display:none;">
  <div class="pull-right form-inline" style="padding: 4px 25px 0px 0px">
    <input class="input-xlarge focused" id="server" name="server" type="text" placeholder="server"> :
    <input class="input-small focused" id="port" name="port" type="text" placeholder="port">
    <button type="submit" id="saveServer" class="btn btn-primary">Add</button>
  </div>
</div>
<!-- End Header Line -->


<?php if (!empty($errors)): ?>
  <h2>Errors</h2>
  <?php foreach ($errors as $item): ?>
    <p><?php echo $item ?></p>
  <?php endforeach; ?>
  <a href="<?php $url; ?>"><< back</a>
<?php else: ?>
  <?php if (!$tube): ?>






    <!-- Table All Tube -->
    <div id="idAllTubes">

      <section id="summaryTable">
        <h2>Server's tubes statistics</h2>
        <br>
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <?php foreach (reset($tubesStats) as $item): ?>
              <th title="<?php echo $item['descr'] ?>"><?php echo $item['key'] ?></th>
            <?php endforeach; ?>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($tubesStats as $row): ?>
            <tr id="tube_<?php echo $row[0]['value'] ?>">
              <?php foreach ($row as $item): ?>
                <?php if ($item['key'] == 'name'): ?>
                  <td>
                    <a href="<?php $url; ?>?server=<?php echo $server ?>&tube=<?php echo $item['value'] ?>"><?php echo $item['value'] ?></a>
                  </td>
                <?php else: ?>
                  <td><?php echo $item['value'] ?></td>
                <?php endif ?>
              <?php endforeach; ?>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      </section>

    </div>
    <div id="idAllTubesCopy" style="display:none"></div>
    <!-- End Table All Tube -->

  <?php elseif (!in_array($tube, $tubes)): ?>

    <!-- Tube not found -->
    <?php echo sprintf('Tube "%s" not found or it is empty', $tube) ?>
    <br><br><a href="<?php $url; ?>?server=<?php echo $server ?>"> << back </a>
    <!-- End Tube not found -->

  <?php
  else: ?>

    <!-- Table current Tube -->

    <table class="table table-bordered table-striped styled">
      <?php $tubeStats = $console->interface->getTubeStats($tube); ?>
      <tr>
        <?php foreach ($tubeStats as $item): ?>
          <th title="<?php echo $item['descr'] ?>"><?php echo $item['key'] ?></th>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($tubeStats as $item): ?>
          <td><?php echo $item['value'] ?></td>
        <?php endforeach; ?>
      </tr>
    </table>

    <p>
      <b>Actions:</b>&nbsp;
      <a class="btn btn-small" href="<?php $url; ?>?server=<?php echo $server ?>&tube=<?php echo $tube ?>&action=kick&count=1"><i class="icon-play"></i>
        Kick 1 job</a>
      <a class="btn btn-small" href="<?php $url; ?>?server=<?php echo $server ?>&tube=<?php echo $tube ?>&action=kick&count=10"><i class="icon-forward"></i>
        Kick 10 jobs</a>
      <a class="btn btn-danger btn-small" href="<?php $url; ?>?server=<?php echo $server ?>&tube=<?php echo $tube ?>&action=delete&count=1"><i class="icon-trash icon-white"></i>
        Delete next ready job</a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-toggle="modal" class="btn btn-success btn-small" href="#" id="addJob"><i class="icon-plus-sign icon-white"></i>
        Add job</a>
    </p>

    <?php
    if (!empty($peek)):

      foreach ($peek as $state => $job):?>
        <hr/>
        <h3>Next job in "<?php echo $state ?>" state</h3>
        <?php if ($job): ?>

          <div class="row show-grid">
            <div class="span3">
              <table class="table">
                <thead>
                <tr>
                  <th>Stats:</th>
                  <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($job['stats'] as $key => $value): ?>
                  <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $value ?></td>
                  </tr>
                <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <div class="span9">
              <b>Job data:</b><br/>
              <pre><code><?php echo htmlspecialchars(trim(var_export($job['data'], true), "'"), ENT_COMPAT) ?></code></pre>
            </div>
          </div>
        <?php else: ?>
          <i>empty</i>
        <?php endif ?>
      <?php
      endforeach;

    endif;
    ?>
    <!-- End Table current Tube -->

  <?php endif; ?>


  <!-- Modal window add job -->
  <div class="modal hide" id="modalAddJob">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">×</button>
      <h3>Add new job</h3>
    </div>
    <div class="modal-body">
      <form class="form-horizontal">
        <fieldset>
          <div class="alert alert-error hide" id="tubeSaveAlert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong> Required fields are marked *
          </div>

          <div class="control-group">
            <label class="control-label" for="focusedInput">*Tube name</label>

            <div class="controls">
              <input class="input-xlarge focused" id="tubeName" type="text" value="<?php echo $tube ?>">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="textarea">*Data</label>

            <div class="controls">
              <textarea class="input-xlarge" id="tubeData" rows="3"></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Priority</label>

            <div class="controls">
              <input class="input-xlarge focused" id="tubePriority" type="text" value="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Delay</label>

            <div class="controls">
              <input class="input-xlarge focused" id="tubeDelay" type="text" value="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Ttr</label>

            <div class="controls">
              <input class="input-xlarge focused" id="tubeTtr" type="text" value="">
            </div>
          </div>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn" data-dismiss="modal">Close</a>
      <a href="#" class="btn btn-success" id="tubeSave">Save changes</a>
    </div>
    </fieldset>
    </form>
  </div>
  <!-- End Modal window add job -->
<?php endif; ?>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php print $assets; ?>/js/jquery.js"></script>
<script src="<?php print $assets; ?>/js/jquery.color.js"></script>
<script src="<?php print $assets; ?>/js/jquery.cookie.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-transition.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-alert.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-modal.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-dropdown.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-scrollspy.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-tab.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-tooltip.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-popover.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-button.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-collapse.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-carousel.js"></script>
<script src="<?php print $assets; ?>/js/bootstrap-typeahead.js"></script>

<script src="<?php print $assets; ?>/highlight/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script src="<?php print $assets; ?>/js/customer.js"></script>
</body>
</html>
