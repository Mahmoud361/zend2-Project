<?php

namespace CustomMustache\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Mustache\View\Renderer;

use Zend\Authentication\AuthenticationService;
//use Users\Entity\Role;
use Zend\Session\Container; // We need this when using sessions
use Zend\View\Helper\ServerUrl;

/**
 * Renderer Factory
 *
 * Prepare Renderer service factory
 *
 *
 *
 * @package customMustache
 * @subpackage service
 */

class RendererFactory implements FactoryInterface
{

    protected $translator;

    private function setTranslator($translatorHandler)
    {
        $this->translator = $translatorHandler;
    }

    /**
     * Prepare Renderer service
     *
     *
     * @uses AuthenticationService
     * @uses \Mustache_Engine
     * @uses Renderer
     *
     * @access public
     * @param ServiceLocatorInterface $serviceLocator
     * @return Renderer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $config     = $serviceLocator->get('Configuration');
        $theme = defined('CURRENT_THEME') ? CURRENT_THEME : 'certiport';
        $theme = rtrim($theme,'/');
//        $menuConfig = $config[$theme]['menus_html_config'];
//        $adminMenuConfig = $config[$theme]['admin_menus_html_config'];
        //$adminBackMenuConfig = $config[$theme]['admin_back_menus_html_config'];
        $config     = $config['mustache'];
        $isAdminUser = false;

        // set isProduction according to current environment
       // $config['helpers']['isProduction'] = (APPLICATION_ENV == "production" ) ? true : false;

        $auth = new AuthenticationService();
        $storage = $auth->getIdentity();

        $config['helpers']['primaryMenu'] = '';

//        $this->setTranslator($serviceLocator->get('translatorHandler'));

//        $config['helpers']["translate"] = $serviceLocator->get('translatorHelper');

        //$forceFlush = !$config['helpers']['isProduction'];
        //$cmsCacheHandler = $serviceLocator->get('cmsCacheHandler');
      //  $menuView = $serviceLocator->get('cmsMenuView');

        //$menuView->loadConfig($menuConfig);

        // TODO: Implement a better way to do this, allowing menu item hierarchy to be respected
        $path = $serviceLocator->get('request')->getUri()->getPath();
       // $menuView->setActivePath($path);


        //$menusArray = $cmsCacheHandler->getCachedCMSData($forceFlush);






        //$menu['primaryMenu'] = $this->generatePrimaryMenu($menuView, $menuConfig, $cmsCacheHandler, $menusArray);



        //$config['helpers']['primaryMenu'] = $menu['primaryMenu'];




        $chatSessionContiner = new Container('chat');


        if ($auth->hasIdentity()) {

            $roles = $storage['roles'];
            $config['helpers']['loggedInUsername'] = $storage['username'];
            $config['helpers']['loggedInUserId'] = $storage['id'];
            if (!is_null($chatSessionContiner) && $chatSessionContiner->chatStarted) {
                $config['helpers']['chatStarted'] = $chatSessionContiner->chatStarted;
                $config['helpers']['minimized'] = $chatSessionContiner->minimized;
            }


            if (isset($roles) && in_array(Role::ADMIN_ROLE, $roles)) {
                $isAdminUser = true;


//                $menu['adminMenu'] = $this->generateAdminMenu($menuView, $adminMenuConfig, $cmsCacheHandler, $menusArray);
//                $menu['adminBackMenu'] = $this->generateAdminMenu($menuView, $adminBackMenuConfig, $cmsCacheHandler, $menusArray);

                //$config['helpers']['adminMenu'] = $menu['adminMenu'];
               // $config['helpers']['adminBackMenu'] = $menu['adminBackMenu'];

                $config['helpers']['isAdminUser'] = $isAdminUser;
            }

//            $menu['manageMenu'] = $this->generateManagementMenu($menuView, $adminMenuConfig, $storage);
//            $menu['manageBackMenu'] = $this->generateManagementMenu($menuView, $adminBackMenuConfig, $storage);


            //$config['helpers']['manageMenu'] = $menu['manageMenu'];
            //$config['helpers']['manageBackMenu'] = $menu['manageBackMenu'];
        }









        // add current language helper
        /* @var $applicationLocale \Translation\Service\Locale\Locale */
//        $applicationLocale = $serviceLocator->get('applicationLocale');
//        $currentLocale = $applicationLocale->getCurrentLocale();
//        $config['helpers']['currentLocale'] = $currentLocale;
//        $config['helpers']['locale_ar'] = ( $currentLocale == \Translation\Service\Locale\Locale::LOCALE_AR_AR);
//        $config['helpers']['locale_en'] = ( $currentLocale == \Translation\Service\Locale\Locale::LOCALE_EN_US);
        //$config['helpers']['googleMapsApiKey'] = $serviceLocator->get('Configuration')['google']['maps']['api_key'];

        // add current host url
        $serverUrl = new ServerUrl();
        $config['helpers']['serverDomain'] = $serverUrl->getHost();

        /** @var $pathResolver \Zend\View\Resolver\TemplatePathStack */
        $pathResolver = clone $serviceLocator->get('ViewTemplatePathStack');
        $pathResolver->setDefaultSuffix($config['suffix']);

        /** @var $resolver \Zend\View\Resolver\AggregateResolver */
        $resolver = $serviceLocator->get('ViewResolver');
        $resolver->attach($pathResolver, 2);

        $engine = new \Mustache_Engine($this->setConfigs($config, $serviceLocator));

        $renderer = new Renderer();
        $renderer->setEngine($engine);
        $renderer->setSuffix(isset($config['suffix']) ? $config['suffix'] : 'mustache' );
        $renderer->setSuffixLocked((bool) $config['suffixLocked']);
        $renderer->setResolver($resolver);

        return $renderer;
    }

//    private

    /**
     * Prepare config array
     *
     *
     * @uses \Mustache_Loader_FilesystemLoader
     *
     * @access private
     * @param array $config
     * @return array configuration array for mustache
     */
    private function setConfigs(array $config, $translator)
    {
        $options = array("extension" => ".phtml");
        if (isset($config["partials_loader"])) {
            $path = $config["partials_loader"];
            if (is_array($config["partials_loader"])) {
                $path = $config["partials_loader"][0];
            }
            $config["partials_loader"] = new \Mustache_Loader_FilesystemLoader($path, $options);
        }

        if (isset($config["loader"])) {
            $config["loader"] = new \Mustache_Loader_FilesystemLoader($config["loader"][0], $options);
        }
        return $config;
    }



    // the follow 3 methods need to be refactored and moved to one of the menus classes
    // suggestion to make them as one method

//    private function generatePrimaryMenu($menuView, $config, $cmsCacheHandler, $menusArray)
//    {
//        $menusViewArray = array();
//
//        $menuView->loadConfig($config);
//        $menusViewArray = $menuView->prepareMenuView(
//            $menusArray[$cmsCacheHandler->getKey(CacheHandler::MENUS_KEY)],
//            /* $menuTitleUnderscored = */ Menu::PRIMARY_MENU_UNDERSCORED,
//            /* $divId = */ "",
//            /* $divClass = */ "");
//
//        return $menusViewArray[Menu::PRIMARY_MENU_UNDERSCORED] ? $menusViewArray[Menu::PRIMARY_MENU_UNDERSCORED] : '';
//    }
//    private function generateAdminMenu($menuView, $config, $cmsCacheHandler, $menusArray)
//    {
//        $menusViewArray = array();
//
//        $menuView->loadConfig($config);
//        $menusViewArray = $menuView->prepareMenuView(
//            $menusArray[$cmsCacheHandler->getKey(CacheHandler::MENUS_KEY)],
//            Menu::ADMIN_MENU_UNDERSCORED,
//            Menu::ADMIN_MENU_UNDERSCORED,
//            Menu::ADMIN_MENU_UNDERSCORED);
//
//        return $menusViewArray[Menu::ADMIN_MENU_UNDERSCORED] ? $menusViewArray[Menu::ADMIN_MENU_UNDERSCORED] : '';
//
//    }
    private function generateManagementMenu($menuView, $config, $storage)
    {
        $menusViewArray = array();

        $menuView->loadConfig($config);
        $menusViewArray = $menuView->prepareMenuView(
            array(Menu::MANAGE_MENU_UNDERSCORED => $storage[Menu::MANAGE_MENU_UNDERSCORED]),
            /* $menuTitleUnderscored = */ Menu::MANAGE_MENU_UNDERSCORED,
            /* $divId = */ "manageMenu",
            /* $divClass = */ "navbar-collapse collapse");

        return $menusViewArray[Menu::MANAGE_MENU_UNDERSCORED] ? $menusViewArray[Menu::MANAGE_MENU_UNDERSCORED] :'';
    }



}
