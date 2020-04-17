<?php

namespace App\Http\Controllers;

use App\Service\MovieServiceInterface;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $movieService;

    public function __construct(MovieServiceInterface $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index($title)
    {
        $this->movieService->getFilm($title);
    }
}
