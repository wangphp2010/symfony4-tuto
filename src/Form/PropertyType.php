<?php

//  src/Form/PropertyType.php
namespace App\Form;

use App\Entity\Property;
use App\Entity\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Picture;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            #给form加input   
            ->add('title') # 会调用 property.php  - > getTitle() 等 title 的相关函数
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            #给form加select标签
            ->add('heat', ChoiceType::class, ['choices' => $this->getChoices()  ]) # 相当于 html 的select -- option 
            // ->add('city',null,['label'=>'Ville']) #把文字city替换为ville
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'choice_label' => 'name',
                'required' => false ,
                'multiple' => true, #use App\Entity\Option;

            ])
             

           // ->add('imageFile', FileType::class, ['required' => false    ])
            
          //  ->add('picFile', FileType::class, ['required' => false , 'constraints' => array( new Picture() ),   ])
            
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('sold')
            //->add('created_at')
             
            #https://symfony.com/doc/current/forms.html#choice-fields
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms',
            # 需要在文件夹translations下建立 forms.fr.yaml 
            #查找config/packages/translations.yaml 文件中的default_locale: '%locale%' 对应的locale
            #修改config/packages/services.yaml 是否也是对应的locale 如 parameters: locale: 'en'改为'fr'(forms.fr.yaml)或 'cn'(forms.cn.yaml) 等等 用来自动替换label中的文字
        ]);
    }
    public function getChoices(): array
    {
        $choices = Property::HEAT;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
