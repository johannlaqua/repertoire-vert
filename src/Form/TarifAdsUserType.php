<?php
namespace App\Form;


use App\Entity\Ads;
use App\Entity\Cssstyle;
use App\Entity\Location;
use App\Entity\Pages;
use App\Entity\TarifAds;
use App\Entity\TarifAdsUser;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TarifAdsUserType extends AbstractType
{
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tarif', EntityType::class, [
                'class' =>TarifAds::class,
                'choice_label' => function($tarif){
                    $this->session->set('adstarifuser', $tarif->getPrice());
                    return $tarif->getType();

                }
            ])
            ->add('adv', EntityType::class, [
                'class' =>Ads::class,
                'choice_label' => 'slogan'
            ])
            ->add('Ajouter',SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TarifAdsUser::class,
        ]);
    }
}