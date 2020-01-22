<?php

namespace MistaTestPlugin;

use Shopware\Bundle\AttributeBundle\Service\CrudService;
use Shopware\Bundle\AttributeBundle\Service\TypeMapping;
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
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('mista_test_plugin.plugin_dir', $this->getPath());
        parent::build($container);
    }

    /**
     * @param InstallContext $context
     */
    public function install(InstallContext $context)
    {
        $this->addCustomArticleAttributes();;
    }

    /**
     * @param UninstallContext $context
     */
    public function uninstall(UninstallContext $context)
    {
        $this->removeCustomArticleAttributes();
    }
    
    private function addCustomArticleAttributes() {
        /** @var CrudService $crudService */
        $crudService = $this->container->get('shopware_attribute.crud_service');

        $crudService->update('s_articles_attributes', 'my_attribute', TypeMapping::TYPE_BOOLEAN);

        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
    }

    private function removeCustomArticleAttributes() {
        /** @var CrudService $crudService */
        $crudService = $this->container->get('shopware_attribute.crud_service');

        $crudService->delete('s_user_attributes', 'my_attribute');

        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
    }

}
