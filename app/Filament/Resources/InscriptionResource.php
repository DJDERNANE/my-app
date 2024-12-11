<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscriptionResource\Pages;
use App\Filament\Resources\InscriptionResource\RelationManagers;
use App\Models\Inscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;

class InscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('family_name'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\TextInput::make('contry'),
                Forms\Components\TextInput::make('city'),
                Forms\Components\Select::make('age_group')
                ->options([
                    'under_18' => 'under 18',
                    'children' => '18-24',
                    'young_adult' => '25-34',
                    'adult' => '35-44',
                    'older' => 'older than 45',
                    ]),

                Forms\Components\Select::make('level')
                ->options([
                    'beginner' => 'Beginner',
                    'intermediate' => 'Intermediate',
                    'advanced' => 'Advanced',
                    'idontknow' => 'I don\'t know',
                    ]),

                Forms\Components\Select::make('status')
                ->options([
                    'student' => 'Student',
                    'employed' => 'Employed',
                    'unemployed' => 'Unemployed',
                    'self-employed' => 'Self-employed',
                    'freelancer' => 'Freelancer',
                    'other' => 'Other',
                    ]),
                
               
                Textarea::make('message'),
                Forms\Components\CheckboxList::make('availability')
                ->options([
                    'weekdays_morning' => 'Weekdays (morning)',
                    'weekdays_afternoon' => 'Weekdays (afternoon)',
                    'weekends_morning' => 'Weekends (morning)', 
                    'weekends_afternoon' => 'Weekends (afternoon)', 

                ]) ->afterStateUpdated(fn ($state, $set) => $set('availability', json_encode($state)))
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                // Tables\Columns\TextColumn::make('family_name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('contry'),
                // Tables\Columns\TextColumn::make('city'),
                // Tables\Columns\TextColumn::make('age_group'),
                // Tables\Columns\TextColumn::make('level'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscriptions::route('/'),
            'create' => Pages\CreateInscription::route('/create'),
            'edit' => Pages\EditInscription::route('/{record}/edit'),
        ];
    }
}
