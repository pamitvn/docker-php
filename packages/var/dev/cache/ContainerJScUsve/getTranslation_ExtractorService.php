<?php

namespace ContainerJScUsve;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTranslation_ExtractorService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'translation.extractor' shared service.
     *
     * @return \Symfony\Component\Translation\Extractor\ChainExtractor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 5).'/vendor/symfony/translation/Extractor/ExtractorInterface.php';
        include_once \dirname(__DIR__, 5).'/vendor/symfony/translation/Extractor/ChainExtractor.php';
        include_once \dirname(__DIR__, 5).'/vendor/symfony/translation/Extractor/AbstractFileExtractor.php';
        include_once \dirname(__DIR__, 5).'/vendor/symfony/translation/Extractor/PhpAstExtractor.php';
        include_once \dirname(__DIR__, 5).'/vendor/symfony/twig-bridge/Translation/TwigExtractor.php';

        $container->privates['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();

        $instance->addExtractor('php', new \Symfony\Component\Translation\Extractor\PhpAstExtractor(new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['translation.extractor.visitor.trans_method'] ??= new \Symfony\Component\Translation\Extractor\Visitor\TransMethodVisitor());
            yield 1 => ($container->privates['translation.extractor.visitor.translatable_message'] ??= new \Symfony\Component\Translation\Extractor\Visitor\TranslatableMessageVisitor());
            yield 2 => ($container->privates['translation.extractor.visitor.constraint'] ??= new \Symfony\Component\Translation\Extractor\Visitor\ConstraintVisitor());
        }, 3)));
        $instance->addExtractor('twig', new \Symfony\Bridge\Twig\Translation\TwigExtractor(($container->privates['twig'] ?? $container->load('getTwigService'))));

        return $instance;
    }
}
