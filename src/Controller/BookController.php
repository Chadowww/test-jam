<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\GenderRepository;
use App\Service\ConnectionDbService;
use App\Service\FilterDataService;

/**
 * Controller de nos routes
 */
class BookController
{
    /**
     * @var BookRepository
     */
    private $bookRepository;
    /**
     * @var GenderRepository
     */
    private $genderRepository;
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * ajout de dépendances
     */
    public function __construct()
    {
        $this->bookRepository = new BookRepository(new ConnectionDbService());
        $this->genderRepository = new GenderRepository(new ConnectionDbService());
        $this->authorRepository = new AuthorRepository(new ConnectionDbService());
    }

    /**
     * @param string $viewFile
     * @param array $data
     * @return void
     */
    private function view(string $viewFile, array $data = [])
    {
        extract($data);
        require_once __DIR__ . '../../template/' . $viewFile . '.php';
    }

    /**
     * @return void
     * Retourne la liste des livres
     */
    public function getBookList()
    {
        ob_start();
//        si le filtre est activé
        if (isset($_POST['authors']) || isset($_POST['genders'])) {
            $data = new FilterDataService();
            $data = $data->dataBuilder($_POST);
            $this->view('bookList', ['books' => $this->bookRepository->filter($data),]);
        } else {
            $this->view('bookList', ['books' => $this->bookRepository->list(),]);

            $this->view('filterForm', [
                'authors' => $this->authorRepository->list(),
                'genders' => $this->genderRepository->list(),
            ]);
        }
        $content = ob_get_clean();

        $this->view('layout', ['content' => $content]);
    }

    /**
     * @return void
     * Retourne les détails d'un livre
     */
    public function getDetailsBook(int $id)
    {
        $this->view('modalContent', ['book' => $this->bookRepository->read($id),]);
    }

    /**
     * @return void
     * supprime un livre
     */
    public function deleteBook(int $id)
    {
        $this->bookRepository->delete($id);
    }
}