<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\page;
use App\Models\submenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Pages';

    protected static ?string $modelLabel = 'Page';

    protected static ?string $pluralModelLabel = 'Pages';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Information')
                    ->description('Enter the basic information for this page.')
                    ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Title')
                    ->placeholder('Enter the page title'),
                
                TextInput::make('subtitle')
                    ->maxLength(255)
                    ->label('Subtitle')
                    ->placeholder('Enter the page subtitle (optional)'),
                
                
                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->directory('pages')
                    ->label('Image')
                    ->helperText('Upload an image for this page. Recommended size: 1920x1080 pixels.'),
                
                Select::make('submenu_id')
                    ->label('Submenu Item')
                    ->options(submenuItem::all()->pluck('title', 'id'))                  
                    ->required()
                    ->relationship('submenuItem', 'title')
                    ->helperText('Select the submenu item this page belongs to.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Title')
                    ->weight('bold'),
                
                TextColumn::make('subtitle')
                    ->searchable()
                    ->sortable()
                    ->label('Subtitle'),
                
                
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),
                
                TextColumn::make('submenuItem.title')
                    ->searchable()
                    ->sortable()
                    ->label('Submenu Item')
                    ->badge()
                    ->color('primary'),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created At'),
                
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Updated At'),
            ])
            ->filters([
                SelectFilter::make('submenu_id')
                    ->label('Filter by Submenu')
                    ->options(submenuItem::all()->pluck('title', 'id'))
                    ->relationship('submenuItem', 'title'),
                Tables\Filters\Filter::make('has_image')
                    ->label('Has Image')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('image')),
                Tables\Filters\Filter::make('no_image')
                    ->label('No Image')
                    ->query(fn (Builder $query): Builder => $query->whereNull('image')),
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
            RelationManagers\SubmenuItemRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
