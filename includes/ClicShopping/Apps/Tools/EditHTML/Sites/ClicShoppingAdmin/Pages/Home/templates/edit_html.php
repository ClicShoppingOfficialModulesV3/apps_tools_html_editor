<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @licence MIT - Portion of osCommerce 2.4
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  use ClicShopping\OM\HTML;
  use ClicShopping\OM\Registry;
  use ClicShopping\OM\CLICSHOPPING;

  use ClicShopping\Apps\Tools\EditHTML\Classes\ClicShoppingAdmin\EditHTMLAdmin;

  $CLICSHOPPING_Template = Registry::get('TemplateAdmin');
  $CLICSHOPPING_Language = Registry::get('Language');
  $CLICSHOPPING_EditHTML = Registry::get('EditHTML');

  $CLICSHOPPING_Page = Registry::get('Site')->getPage();

  $action = $_GET['action'] ?? '';

  $directory_selected = null;
  if (isset($_POST['directory_html'])) $directory_selected = $_POST['directory_html'];
  if (isset($_GET['directory_html'])) $directory_selected = $_GET['directory_html'];

  $filename_selected = null;
  if (isset($_POST['filename'])) $filename_selected = $_POST['filename'];
  if (isset($_GET['filename'])) $filename_selected = $_GET['filename'];


  $file = CLICSHOPPING::getConfig('dir_root', 'Shop') . $CLICSHOPPING_Template->getDynamicTemplateDirectory() . '/modules/' . $directory_selected . '/content/' . $filename_selected;

  if (is_file($file)) {
    $code = file_get_contents($file);
  } else {
    $code = null;
  }
?>
<div class="contentBody">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-block headerCard">
        <div class="row">

          <span
            class="col-md-1 logoHeading"><?php echo HTML::image($CLICSHOPPING_Template->getImageDirectory() . 'categories/edit_html.png', $CLICSHOPPING_EditHTML->getDef('heading_title'), '40', '40'); ?></span>
          <span
            class="col-md-4 pageHeading"><?php echo '&nbsp;' . $CLICSHOPPING_EditHTML->getDef('heading_title'); ?></span>
          <?php
            if (empty($action)) {
              $form_action = 'directory';
              ?>
              <span class="col-md-2 text-center">
                <?php echo HTML::form('directory', $CLICSHOPPING_EditHTML->link('EditHTML&action=' . $form_action), 'post', 'enctype="multipart/form-data"') . HTML::selectMenu('directory_html', EditHTMLAdmin::getDirectoryHtml(), $directory_selected, 'onchange="this.form.submit();"'); ?>
                  </form>
              </span>
              <?php
            } else {
              ?>

              <span class="col-md-2 text-center">
<?php echo HTML::form('edit_file_html', $CLICSHOPPING_EditHTML->link('EditHTML&action=directory')) . HTML::selectMenu('directory_html', EditHTMLAdmin::getDirectoryHtml(), $directory_selected, 'onchange="this.form.submit();"') . '      ' . HTML::selectMenu('filename', EditHTMLAdmin::getFilenameHtml(), $filename_selected, 'onchange="this.form.submit();"'); ?>
                  </form>
              </span>

              <span class="col-md-5 text-end">
<?php
  echo HTML::form('areahtml', $CLICSHOPPING_EditHTML->link('EditHTML&Update'), 'post', 'enctype="multipart/form-data"');
  echo HTML::button($CLICSHOPPING_EditHTML->getDef('button_update'), null, null, 'success') . ' ';
  if (!empty($action)) {
    echo HTML::button($CLICSHOPPING_EditHTML->getDef('button_cancel'), null, $CLICSHOPPING_EditHTML->link('EditHTML'), 'danger');
  }
?>
              </span>
              <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="separator"></div>
  <?php
    if ($action == 'directory') {
      ?>
      <div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/codemirror.min.css"/>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/mode/css/css.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/addon/selection/active-line.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/codemirror.min.js"></script>

        <style>.CodeMirror {
            background: #f8f8f8;
          }</style>
        <style type="text/css">
          .CodeMirror {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            height: auto;
          }

          .CodeMirror-scroll {
            overflow-y: hidden;
            overflow-x: auto;
          }
        </style>
        <?php
          echo HTML::hiddenField('directory_html', $directory_selected);
          echo HTML::hiddenField('filename', $filename_selected);
          echo HTML::textAreaField('code', $code, '', '', 'id="code"');
        ?>
      </div>
      <?php
    }
  ?>
  <div class="separator"></div>
  <div class="alert alert-info">
    <div><?php echo HTML::image($CLICSHOPPING_Template->getImageDirectory() . 'icons/help.gif', $CLICSHOPPING_EditHTML->getDef('title_help_edit_html')) . ' ' . $CLICSHOPPING_EditHTML->getDef('title_help_edit_html') ?></div>
    <div class="separator"></div>
    <div><?php echo $CLICSHOPPING_EditHTML->getDef('text_help_edit_html'); ?></div>
  </div>
</div>

<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true,
        viewportMargin: Infinity
    });
</script>