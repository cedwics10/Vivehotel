<?php
class Pagination
{
    // Numéro de pagination
    private int $pageActuelle;
    // Elements par page
    private int $NombreItemsParPage;
    // Nombre de pages
    private int $nombrePages;
    // Nombre de page visibles dans la pagination
    private int $pagesVisibles = 10;

    public function __construct(int $nombrePages, int $pageActuelle = 1, int $NombreItemsParPage = 20)
    {
        if ($nombrePages > 1)
            $this->nombrePages = $nombrePages;

        $this->NombreItemsParPage = $NombreItemsParPage;
        $this->pageActuelle = $pageActuelle;
    }

    public function getPage(): string
    {
        return $this->pageActuelle;
    }

    public function getNombreItemsParPage(): string
    {
        return $this->NombreItemsParPage;
    }

    public function setPage(int $pageActuelle)
    {
        if ($pageActuelle >= 1)
            $this->pageActuelle = $pageActuelle;
    }

    public function setNombrePage(int $nombrePages)
    {
        if ($nombrePages >= 1)
            $this->nombrePages = $nombrePages;
    }

    public function setNombreItemsParPage(int $NombreItemsParPage)
    {
        if ($NombreItemsParPage >= 1)
            $this->NombreItemsParPage = $NombreItemsParPage;
    }

    public function queryPages()
    {
        $start = $this->NombreItemsParPage * ($this->pageActuelle - 1);

        return "LIMIT {$start},{$this->NombreItemsParPage}";
    }

    private function thereAreVeryFewPges()
    {
        $this->nombrePages < $this->pagesVisibles;
    }

    private function arrayAtFirstPages()
    {
        echo 'début';
        $page_range = range(1, $this->nombrePages);
        return array_merge(
            array_slice($page_range, 0, floor($this->pagesVisibles / 2)),
            ['...'],
            array_slice($page_range, $this->nombrePages - floor($this->pagesVisibles / 2), floor($this->pagesVisibles / 2))
        );
    }

    private function arrayLastPages()
    {
        $page_range = range(1, $this->nombrePages);
        return array_merge(
            array_slice($page_range, 0, floor($this->pagesVisibles / 2)),
            ['...'],
            array_slice($page_range, $this->nombrePages - ceil($this->pagesVisibles / 2), ceil($this->pagesVisibles / 2))
        );
    }

    private function arrayInMiddlePages()
    {
        $page_range = range(1, $this->nombrePages);
        $halfVisiblePages = floor($this->pagesVisibles / 2);
        $startPage = $this->pageActuelle - $halfVisiblePages - 1;
        echo '4';

        return array_merge(
            [1, '...'],
            array_slice(
                $page_range,
                $startPage,
                $this->pagesVisibles
            ),
            ['...', $this->nombrePages]
        );
    }


    private function currentPageInBeginning()
    {
        $this->pageActuelle < $this->pagesVisibles;
    }

    private function currentPageInTheEnd()
    {
        $this->pageActuelle >= $this->nombrePages - $this->pagesVisibles / 2;
    }


    public function arrayPages()
    {
        if ($this->nombrePages == 1)
            return [];

        if ($this->thereAreVeryFewPges()) {
            return range(1, $this->nombrePages);
        }

        if ($this->currentPageInBeginning()) {
            return $this->arrayAtFirstPages();
        }

        if ($this->currentPageInTheEnd()) {
            return $this->arrayLastPages();
        }

        return $this->arrayInMiddlePages();
    }
}
