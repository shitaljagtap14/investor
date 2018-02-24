<?php

namespace App\Forms;

use App\Models\Subscription;
use Kris\LaravelFormBuilder\Form;

class SweepstakeForm extends Form
{
    public function buildForm()
    {
        $sweep = $this->getData('sweepstake');
        $subscriptions = Subscription::all();
        $options = [];
        foreach($subscriptions as $subscription) {
            $options[$subscription->id] = $subscription->status_level;
        }
        $this
            ->add('entry_level', 'select', [
                'label' => 'Entry Level',
                'choices' => $options,
                'rules'    => 'required',
                'selected' => @$sweep->id ? : '',
                'empty_value' => '=== Entry Level ===',
                'required' => TRUE,
            ])
            ->add('entry_point', 'text', [
                'label'    => 'Entry Point',
                'rules'    => 'required|numeric',
                'value'    => @$sweep->entry_point,
                'attr'     => ['placeholder' => 'Entry Point'],
                'required' => TRUE,
            ])
            ->add('Save', 'submit', [
                'label' => 'Save',
                'attr' => ['class' => 'btn btn-primary'],
                'wrapper' => ['class' => "form-options form-group"]
            ]);
    }
}
