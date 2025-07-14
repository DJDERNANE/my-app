<?php

namespace App\Filament\Resources\SubmenuItemResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageRelationManager extends RelationManager
{
    protected static string $relationship = 'page';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Title')
                    ->placeholder('Enter the page title'),
                
                Forms\Components\TextInput::make('subtitle')
                    ->maxLength(255)
                    ->label('Subtitle')
                    ->placeholder('Enter the page subtitle (optional)'),
                
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->directory('pages')
                    ->label('Image')
                    ->helperText('Upload an image for this page. Recommended size: 1920x1080 pixels.'),
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
                    ->label('Title')
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable()
                    ->sortable()
                    ->label('Subtitle'),
                
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),
                
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
                Tables\Filters\Filter::make('has_image')
                    ->label('Has Image')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('image')),
                Tables\Filters\Filter::make('no_image')
                    ->label('No Image')
                    ->query(fn (Builder $query): Builder => $query->whereNull('image')),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
            ])
            ->paginated(false); // Disable pagination for one-to-one relationship
    }
} 