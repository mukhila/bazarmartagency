<?php

// app/Console/Commands/ImportProductsFromXlsx.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ImportProductsFromXlsx extends Command
{
    protected $signature = 'products:import {path=products.xlsx}';
    protected $description = 'Import products from storage/app/{path}';

    public function handle(): int
    {
        $path = storage_path('app/'.$this->argument('path'));
        if (!file_exists($path)) {
            $this->error("File not found: $path");
            return self::FAILURE;
        }
        Excel::import(new ProductsImport, $path);
        $this->info('Products imported successfully.');
        return self::SUCCESS;
    }
}

