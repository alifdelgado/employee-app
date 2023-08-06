<?php

namespace App\Forms;

use App\Models\Country;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class CreateStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.states.store'))
            ->method('POST')
            ->class('p-4 space-y-3 bg-white border rounded shadow');
    }

    public function fields(): array
    {
        return [
            Text::make('name')
                ->rules(['required', 'max:100', 'min:3'])
                ->label(__('Name state'))
                ->placeholder(__('Name state')),
            Select::make('country_id')
                ->rules(['required'])
                ->label('Choose a country')
                ->placeholder(__('Choose a country'))
                ->options(Country::pluck('name', 'id')->toArray()),
            Submit::make()
                ->label(__('Submit')),
        ];
    }
}
