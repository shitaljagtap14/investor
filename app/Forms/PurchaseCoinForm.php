<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PurchaseCoinForm extends Form
{
    public function buildForm()
    {
        $purchase = $this->getData('purchase');

        $this->add('reword_point', 'text', [
            'label' => 'Reword Point',
            'rules' => 'required|numeric',
            'value' => @$purchase->reword_point,
            'attr'  => ['placeholder' => 'Reword Point']
        ])
            ->add('additional_point', 'text', [
                'label' => 'Additional Point',
                'rules' => 'required|numeric',
                'value' => @$purchase->additional_point,
                'attr'  => ['placeholder' => 'Additional Point']
            ])
            ->add('amount', 'text', [
                'label' => 'Amount',
                'rules' => 'required|numeric',
                'value' => @$purchase->amount,
                'attr'  => ['placeholder' => 'Amount']
            ])
            ->add('Save', 'submit', [
                'label' => 'Save',
                'attr' => ['class' => 'btn btn-primary'],
                'wrapper' => ['class' => "form-options form-group"]
            ]);
    }
}
