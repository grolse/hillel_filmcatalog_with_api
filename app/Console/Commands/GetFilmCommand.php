<?php

namespace App\Console\Commands;

use App\Service\OmdbApiServiceInterface;
use Illuminate\Console\Command;

class GetFilmCommand extends Command
{
    private $omdbApiService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'film:get {film_title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get film by tilte';

    /**
     * Create a new command instance.
     *
     * @param OmdbApiServiceInterface $apiService
     */
    public function __construct(OmdbApiServiceInterface $apiService)
    {
        $this->omdbApiService = $apiService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $title = $this->argument('film_title');
            $data = $this->omdbApiService->searchFilmByTitle($title);
            dd($data);
        } catch (\Exception $e) {
            $this->output->error($e->getMessage());
        }
    }
}
