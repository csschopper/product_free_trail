<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

class ProductFreeTrailPackage extends Package {
	protected $pkgHandle = 'product_free_trail';
     protected $appVersionRequired = '5.3.0';
     protected $pkgVersion = '1.0';

     public function getPackageDescription() {
         return t("Install the Product Free Trail form block.");
     }

     public function getPackageName() {
          return t("Product Trail Form");
     }
     
     public function install() {
          $pkg = parent::install();
     
			Loader::model('collection_types');
			Loader::model('collection_attributes');
			Loader::model('package');
        
          // install block 
         BlockType::installBlockTypeFromPackage('trial_form', $pkg); 
        
         
         //add single page
        Loader::model('single_page');
        $fcPage=Page::getByPath('/dashboard/Product Form'); 
		if( !intval($fcPage->cID) ){ 
				$fcPage=SinglePage::add('/dashboard/Product Form', $pkg);
		}
		$fcPage->update(array('cName'=>t('Product Form'), 'cDescription'=>t('Product Form .'))); 
		
        $fcSocialPage=Page::getByPath('/dashboard/Product Form/Trail Form Registration'); 
		if( !intval($fcSocialPage->cID) ){ 
				$fcSocialPage=SinglePage::add('/dashboard/Product Form/Trail Form Registration', $pkg);
		}
		$fcSocialPage->update(array('cName'=>t('Trail Form Registration'), 'cDescription'=>t('Trail Form Registration.'))); 
       
         
     }
     public function uninstall(){
		parent::uninstall();
	}
}	

?>
