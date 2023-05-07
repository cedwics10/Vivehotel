<?php
trait Pagination
{
    // Numéro de pagination
    protected int $pageActuelle;
    // Elements par page
    protected int $NombreItemsParPage;
    // Nombre de pages
    protected int $nombrePages;
    // Nombre de page visibles dans la pagination
    protected int $pagesVisibles = 10;

    public function setParams(int $nombreElements, int $NombreItemsParPage = 20, int $pageActuelle = 1)
    {
        $this->nombrePages = ceil($nombreElements / $NombreItemsParPage);

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

    private function thereAreVeryFewPges()
    {
        return $this->nombrePages < $this->pagesVisibles;
    }

    private function arrayAtFirstPages()
    {
        echo 'début';
        $page_range = range(1, $this->nombrePages);
        return array_merge(
            array_slice($page_range, 0, $this->pagesVisibles),
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
        return $this->pageActuelle < $this->pagesVisibles;
    }

    private function currentPageInTheEnd()
    {
        return $this->pageActuelle >= $this->nombrePages - $this->pagesVisibles / 2;
    }


    private function arrayPages()
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

    public function htmlPages($baseName = '')
    {
        $HTML = [];
        $arrayPages = $this->arrayPages();

        $key = 0;

        foreach ($arrayPages as $page) {
            $texte = $page;
            if ($page == '...')
                $page = round(($arrayPages[$key + 1] + $arrayPages[$key - 1]) / 2);
            $HTML[] = "<a style='text-decoration: none;' href='{$baseName}&page=$page'>$texte</a>";
            $key++;
        }

        return implode(' ', $HTML);
    }

    public function sqlPages()
    {
        $start = $this->NombreItemsParPage * ($this->pageActuelle - 1);

        return "LIMIT {$start},{$this->NombreItemsParPage}";
    }
}
