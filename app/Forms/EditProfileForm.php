<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EditProfileForm extends Form
{
    public function buildForm()
    {
        $editData = $this->getData('user');

        $this->add('first_name', 'text', [
            'label' => 'First Name',
            'rules' => 'required|string',
            'value' => @$purchase_coin->first_name,
            'attr'  => ['placeholder' => 'First Name']
        ])
            ->add('last_name', 'text', [
                'label' => 'Last Name',
                'rules' => 'required|string',
                'value' => @$purchase_coin->last_name,
                'attr'  => ['placeholder' => 'Last Name']
            ])
            ->add('name', 'text', [
                'label' => 'Name',
                'rules' => 'required|string',
                'value' => @$purchase_coin->name,
                'attr'  => ['placeholder' => 'Name']
            ])
            ->add('email', 'text', [
                'label' => 'Amount',
                'rules' => 'required|numeric',
                'value' => @$purchase_coin->email,
                'attr'  => ['placeholder' => 'Email']
            ])
            ->add('password', 'text', [
                'label' => 'Password',
                'rules' => 'required|numeric',
                'value' => @$purchase_coin->password,
                'attr'  => ['placeholder' => 'Password']
            ])
            ->add('Save', 'submit', [
                'label' => 'Save',
                'attr' => ['class' => 'btn btn-primary'],
                'wrapper' => ['class' => "form-options form-group"]
            ]);
    }
    }
}
