<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerOdwjmQd\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerOdwjmQd/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerOdwjmQd.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerOdwjmQd\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerOdwjmQd\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'OdwjmQd',
    'container.build_id' => 'cc73d3b6',
    'container.build_time' => 1614379419,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerOdwjmQd');