<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubmenuItemRelationManager extends RelationManager
{
    protected static string $relationship = 'submenuItem';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Title'),
                
                Forms\Components\FileUpload::make('icon')
                    ->image()
                    ->directory('submenu-icons')
                    ->disk('public')
                    ->label('Icon'),
                
                Forms\Components\FileUpload::make('picture')
                    ->image()
                    ->directory('submenu-pictures')
                    ->disk('public')
                    ->label('Picture'),
                
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->label('Description'),
                
                Forms\Components\TextInput::make('link')
                    ->maxLength(255)
                    ->label('Link'),
                
                Forms\Components\Select::make('parent')
                    ->options([
                        'solutions' => 'Solutions',
                        'pages' => 'Pages',
                    ])
                    ->placeholder('Select a parent')
                    ->label('Parent'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Title'),
                
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Icon')
                    ->circular(),
                
                Tables\Columns\ImageColumn::make('picture')
                    ->label('Picture')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable()
                    ->label('Description'),
                
                Tables\Columns\TextColumn::make('link')
                    ->limit(30)
                    ->searchable()
                    ->label('Link'),
                
                Tables\Columns\TextColumn::make('parent')
                    ->searchable()
                    ->label('Parent'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created At'),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Updated At'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('parent')
                    ->options([
                        'solutions' => 'Solutions',
                        'pages' => 'Pages',
                    ])
                    ->label('Filter by Parent'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
} 