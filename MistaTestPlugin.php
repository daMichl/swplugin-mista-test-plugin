<?php

namespace MistaTestPlugin;

use Shopware\Bundle\AttributeBundle\Service\CrudService;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Shopware-Plugin MistaTestPlugin.
 */
class MistaTestPlugin extends Plugin
{
    /**
     * @param InstallContext $context
     */
    public function install(InstallContext $context)
    {
        $this->addCustomArticleAttributes();;
        $context->scheduleClearCache(InstallContext::CACHE_LIST_DEFAULT);
    }

    /**
     * @param UninstallContext $context
     */
    public function uninstall(UninstallContext $context)
    {
        $this->removeCustomArticleAttributes();
        $context->scheduleClearCache(InstallContext::CACHE_LIST_DEFAULT);
    }

    private function addCustomArticleAttributes() {
        /** @var CrudService $crudService */
        $crudService = $this->container->get('shopware_attribute.crud_service');

        $crudService->update('s_articles_attributes', 'my_attribute', 'boolean', [
            'label' => 'My Attribute',
            'supportText' => 'Voll das geile Testattribut yoooo!!!!',

            //attribute will be displayed in the backend module
            'displayInBackend' => true,

            //numeric position for the backend view, sorted ascending
            'position' => 100,

            //user can modify the attribute in the free text field module
            'custom' => true,
        ]);

        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
    }

    private function removeCustomArticleAttributes() {
        /** @var CrudService $crudService */
        $crudService = $this->container->get('shopware_attribute.crud_service');

        $crudService->delete('s_articles_attributes', 'my_attribute');

        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
    }

}
