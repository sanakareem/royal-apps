<?php

namespace App\Console\Commands;

use App\Services\Api\AuthorService;
use Illuminate\Console\Command;

class AddAuthorCommand extends Command
{
    protected $signature = 'author:add {first_name} {last_name} {birthday}';
    protected $description = 'Add a new author';

    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        parent::__construct();
        $this->authorService = $authorService;
    }

    public function handle()
    {
        try {
            $data = [
                'first_name' => $this->argument('first_name'),
                'last_name' => $this->argument('last_name'),
                'birthday' => $this->argument('birthday'),
            ];

            $this->authorService->createAuthor($data);
            $this->info('Author created successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to create author: ' . $e->getMessage());
        }
    }
}