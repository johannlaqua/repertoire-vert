<?php

namespace App\Factory;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Company>
 *
 * @method static Company|Proxy createOne(array $attributes = [])
 * @method static Company[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Company|Proxy find(object|array|mixed $criteria)
 * @method static Company|Proxy findOrCreate(array $attributes)
 * @method static Company|Proxy first(string $sortedField = 'id')
 * @method static Company|Proxy last(string $sortedField = 'id')
 * @method static Company|Proxy random(array $attributes = [])
 * @method static Company|Proxy randomOrCreate(array $attributes = [])
 * @method static Company[]|Proxy[] all()
 * @method static Company[]|Proxy[] findBy(array $attributes)
 * @method static Company[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Company[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CompanyRepository|RepositoryProxy repository()
 * @method Company|Proxy create(array|callable $attributes = [])
 */
final class CompanyFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
      $companyName = self::faker()->company();
      $date = new \DateTime();
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'role' => 'ROLE_COMPANY',
            'token' => self::faker()->unique()->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
            'emailValidated' => self::faker()->boolean(),
            'actived' => false,
            'name' => $companyName,
            'image' => 'https://lorempixel.com/800/600/city/',
            'niveau' => 'N.' . self::faker()->numberBetween($min=0, $max=3),
            'influencezone' => self::faker()->numberBetween($min=10, $max=130) . 'km',
            'street' => self::faker()->streetName(),
            'streetnumber' => self::faker()->buildingNumber(),
            'postcode' => self::faker()->numberBetween(1000, 10000),
            'city' => self::faker()->city(),
            'region' => self::faker()->state(),
            'country' => "Suisse",
            'phone' => self::faker()->phoneNumber(),
            'wantevaluation' => self::faker()->boolean(),
            'description' => self::faker()->realText($maxNbChars = 200, $indexSize = 2),
            'vision' => self::faker()->realText($maxNbChars = 200, $indexSize = 2),
            'socialreason' => $companyName,
            'slug' => self::faker()->slug(),
            'latitude' => self::faker()->latitude($min = 40, $max = 50),
            'longtitude' => self::faker()->longitude($min = 0, $max = 10),
            'activated' => true,
            'certification' => self::faker()->sentence($nbWords = 3, $variableNbWords = true),
            'urlwebsite' => 'https://' . $companyName . '.com',
            'urlfacebook' => 'https://facebook.com/' . $companyName,
            'urltwitter' => 'https://twitter.com/' . $companyName,
            'urllinkedin' => 'https://linkedin.com/' . $companyName,
            'starting_date' => $date,
            'inscription_date' => $date
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Company $company) {})
        ;
    }

    protected static function getClass(): string
    {
        return Company::class;
    }
}
