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

  namespace ClicShopping\Apps\Tools\EditHTML\Sites\ClicShoppingAdmin\Pages\Home\Actions;

  use ClicShopping\OM\Registry;

  class EditHTML extends \ClicShopping\OM\PagesActionsAbstract
  {
    public function execute()
    {
      $CLICSHOPPING_EditHTML = Registry::get('EditHTML');

      $this->page->setFile('edit_html.php');
      $this->page->data['action'] = 'EditHTML';

      $CLICSHOPPING_EditHTML->loadDefinitions('Sites/ClicShoppingAdmin/main');
    }
  }