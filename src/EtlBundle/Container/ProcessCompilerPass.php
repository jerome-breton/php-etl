<?php
namespace EtlBundle\Container;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ProcessCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('jbreton_php_etl.process_lister')) {
            return;
        }

        $definition = $container->findDefinition(
            'jbreton_php_etl.process_lister'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'jbreton_php_etl.process'
        );

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addProcess',
                array(new Reference($id))
            );
        }
    }
}