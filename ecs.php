use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
  // A. standalone rule
    //$services = $containerConfigurator->services();
    //$services->set(ArraySyntaxFixer::class)
    //    ->call('configure', [[
    //        'syntax' => 'short',
    //    ]]);

    // B. full sets
    //$parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SETS, [SetList::SYMPLIFY,]);
    //$parameters->set(Option::SETS, [SetList::CLEAN_CODE, SetList::PSR_12]);
};
};
