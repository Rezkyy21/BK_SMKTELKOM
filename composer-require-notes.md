Please run the following to enable Excel import functionality:

composer require maatwebsite/excel

This will install `Maatwebsite\Excel` and provide the `Excel` facade used by
`App\Http\Controllers\Filament\SiswaImportController` and
`App\Imports\SiswaImport`.

If you prefer not to install it, the import endpoint will not work; the
`template` route still returns a CSV header-only template that can be used
manually.
