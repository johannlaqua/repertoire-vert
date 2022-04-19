<?php

namespace App\Factory;

use App\Entity\Marchandise;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Marchandise>
 *
 * @method static Marchandise|Proxy createOne(array $attributes = [])
 * @method static Marchandise[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Marchandise|Proxy find(object|array|mixed $criteria)
 * @method static Marchandise|Proxy findOrCreate(array $attributes)
 * @method static Marchandise|Proxy first(string $sortedField = 'id')
 * @method static Marchandise|Proxy last(string $sortedField = 'id')
 * @method static Marchandise|Proxy random(array $attributes = [])
 * @method static Marchandise|Proxy randomOrCreate(array $attributes = [])
 * @method static Marchandise[]|Proxy[] all()
 * @method static Marchandise[]|Proxy[] findBy(array $attributes)
 * @method static Marchandise[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Marchandise[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Marchandise|Proxy create(array|callable $attributes = [])
 */
final class MarchandiseFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
      $array = array(
        'Tomate',
        'Banane',
        'Carotte',
        'Asperge',
        'Panais',
        'Oignon',
        'Betterave',
        'Céleri',
        'Navet'
      );
      $item = self::faker()->randomElement($array);
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'name' => $item,
            'slug' => $item,
            'description' => self::faker()->realText($maxNbChars = 50, $indexSize = 2),
            'certification' => self::faker()->sentence($nbWords = 3, $variableNbWords = true),
            'wantevaluation' => self::faker()->boolean(),
            'gaearecommanded' => self::faker()->boolean(),
            'creationdate' => self::faker()->datetime(),
            'type' => 'Légume',
            'origin' => self::faker()->country(),
            'price' => self::faker()->numberBetween(1,50),
            'currency' => 'CHF',
            'quantity' => self::faker()->numberBetween(1,5),
            'updated_date' => self::faker()->dateTime(),
            'volumeunit' => 'ml',
            'weightunit' => 'kg'
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Marchandise $marchandise) {})
        ;
    }

    protected static function getClass(): string
    {
        return Marchandise::class;
    }
}
