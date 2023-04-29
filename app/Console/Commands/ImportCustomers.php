<?php

namespace App\Console\Commands;

use App\Imports\CustomerImport;
use Illuminate\Console\Command;

/**
 * Class ImportCustomers
 *
 * @package App\Console\Commands
 */
class ImportCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers {--customers=100 : Minimum number of customers to import} {--nationality=AU : Nationality of customers to import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports customers from the Random User API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CustomerImport $customerImport)
    {

        $minCustomers = (int) $this->option('customers');
        $nationality = $this->option('nationality');

        if ($minCustomers < 100) {
            $this->error('Minimum number of customers should be greater than or equal to 100.');
            return;
        }

        if ($nationality != 'AU') {
            $this->error('Only australian nationality is allowed to be imported.');
            return;
        }

        $customerImport->fetchCustomers($nationality, $minCustomers);
        $this->output->success('Customers imported successfully.');

        return Command::SUCCESS;
    }
}
