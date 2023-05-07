<?php
class Pagination
{
    // Numéro de pagination
    protected string $page;
    // Elements par page
    protected string $NombreItemsParPage;

    public function __construct()
    {
        $this->page = 1;
        $this->NombreItemsParPage = 20;
    }

    public function getPage(): string
    {
        return $this->page;
    }

    public function getNombreItemsParPage(): string
    {
        return $this->NombreItemsParPage;
    }

    public function setPage(string $page)
    {
        $this->page = $page;
    }

    public function setNombreItemsParPage(int $NombreItemsParPage)
    {
        $this->NombreItemsParPage = $NombreItemsParPage;
    }

    public function queryPages()
    {
        if ($this->page > 0 and $this->NombreItemsParPage > 0) {
            $start = $this->NombreItemsParPage * ($this->page - 1);

            return "LIMIT $start,{$this->NombreItemsParPage}";
        } else {
            return "";
        }
    }
}
