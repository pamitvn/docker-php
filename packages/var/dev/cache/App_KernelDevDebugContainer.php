<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerEDJnDyx\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerEDJnDyx/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerEDJnDyx.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerEDJnDyx\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerEDJnDyx\App_KernelDevDebugContainer([
    'container.build_hash' => 'EDJnDyx',
    'container.build_id' => '7b0e4686',
    'container.build_time' => 1678366335,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerEDJnDyx');
