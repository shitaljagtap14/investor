<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SubscriptionForm extends Form
{
    public function buildForm()
    {
        $subscription = $this->getData('subscription');
        $packages = [
            'member'    => 'Member',
            'silver'    => 'Silver',
            'gold'      => 'Gold',
            'platinum'  => 'Platinum',
            'diamond'   => 'Diamond',
            'other'     => 'Other'
        ];
        $this->add('package', 'select', [
            'label' => 'Package Name',
            'choices' => $packages,
            'selected' => @$subscription->package,
            'empty_value' => '=== Select Package ==='
        ])
            ->add('subscription_amt', 'text', [
                'label' => 'Subscription Amount',
                'rules' => 'required|numeric',
                'value' => @$subscription->amount,
                'attr'  => ['placeholder' => 'Subscription Amount']
            ])
            ->add('reward_point', 'text', [
                'label' => 'Reward Point',
                'rules' => 'required|numeric',
                'value' => @$subscription->reward_point,
                'attr'  => ['placeholder' => 'Reward Point']
            ])
            ->add('bonus_point', 'text', [
                'label' => 'Bonus Point',
                'rules' => 'required|numeric',
                'value' => @$subscription->bonus_point,
                'attr'  => ['placeholder' => 'Bonus Point']
            ])
            ->add('extra_point', 'text', [
                'label' => 'Extra Point',
                'rules' => 'required|numeric',
                'value' => @$subscription->extra_point,
                'attr'  => ['placeholder' => 'Extra Point']
            ])
            ->add('active_status', 'select', [
                'label' => 'Select Option',
                'choices' => [
                    'active' => 'Active',
                    'suspend' => 'Suspend'
                ],
                'rules' => 'required',
                "selected" => @$subscription->status,
                'empty_value' => '=== Select Option ==='
            ])
            ->add('status_level', 'text', [
                'label' => 'Status Level',
                'rules' => 'required',
                'value' => @$subscription->status_level,
                'attr'  => ['placeholder' => 'Status Level']
            ])
            ->add('interest', 'hidden', [
                'rules' => 'required',
                'value' => @$subscription->interest
            ])
            ->add('Save', 'submit', [
                'label' => 'Save',
                'attr' => ['class' => 'btn btn-primary'],
                'wrapper' => ['class' => "form-options form-group"]
            ]);
    }
}
