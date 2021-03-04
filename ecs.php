<?php declare(strict_types=1);

use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    // requiring void return typehints could be confusing for PHP-beginners
    $parameters->set(Option::SKIP, [VoidReturnFixer::class]);

    $containerConfigurator->import(__DIR__ . '/vendor/lmc/coding-standard/ecs.php');
};
