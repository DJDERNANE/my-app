<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmenuItemResource\Pages;
use App\Filament\Resources\SubmenuItemResource\RelationManagers;
use App\Models\SubmenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubmenuItemResource extends Resource
{
    protected static ?string $model = SubmenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Submenu Items';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('icon')
                    ->required()
                    ->image()
                    ->directory('submenu-icons')
                    ->disk('public') ,
                Forms\Components\FileUpload::make('picture')
                    ->required()
                    ->image()
                    ->directory('submenu-pictures')
                    ->disk('public') ,
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('link')
                    ->label('Link')
                    ->maxLength(255),
                Forms\Components\Select::make('parent')
                    ->label('Parent')
                    ->options([
                        'solutions' => 'Solutions',
                    ])
                    ->placeholder('Select a parent'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('icon')
                    ->square(),
                Tables\Columns\ImageColumn::make('picture')
                    ->square(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            RelationManagers\PageRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubmenuItems::route('/'),
            'create' => Pages\CreateSubmenuItem::route('/create'),
            'view' => Pages\ViewSubmenuItem::route('/{record}'),
            'edit' => Pages\EditSubmenuItem::route('/{record}/edit'),
        ];
    }
}
