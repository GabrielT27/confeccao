<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Pages\ViewRole;
use App\Filament\Resources\Roles\Schemas\RoleForm;
use App\Filament\Resources\Roles\Schemas\RoleInfolist;
use App\Filament\Resources\Roles\Tables\RolesTable;
use Spatie\Permission\Models\Role;
use BackedEnum;
use Dom\Text;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;


class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    // MÉTODO CORRIGIDO - APENAS UM RETURN
public static function canAccess(): bool
{
    return auth()->user()?->hasRole('Admin') ?? false;
}

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Cargos_e_Permissões';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('permissions')
                    ->label('Permissões de Acesso')
                    ->multiple()
                    ->relationship('permissions', 'name')
                    ->preload()
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RoleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome do Cargo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('permissions.name')
                    ->label('Permissões')
                    ->badge()
                    ->searchable(),
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
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'view' => ViewRole::route('/{record}'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}