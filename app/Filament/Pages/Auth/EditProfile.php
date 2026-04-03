<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return parent::form($schema)
            ->components([
                Section::make('Foto Profil')
                    ->description('Ubah foto profil yang ditampilkan di dashboard.')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Foto')
                            ->image()
                            ->avatar()
                            ->disk('public')
                            ->directory('avatars')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
    }
}
