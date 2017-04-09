<?php
namespace App\Model;

class Paginator {

    public $page;
    public $url = '/page/';
    public $adjacent = 1;
    public $previousPage;
    public $nextPage;
    public $beforeLastPage;
    public $pagination;

    public function __construct(\App\Model\Page $page)
    {
        $this->page = $page;
    }
    
    public function getPage() { return $this->page; }
    
    public function setPage(Page $page) { $this->page = $page; }
    
    public function generate()
    {
        $this->previousPage = $this->page->getPage() - 1;
        $this->nextPage = $this->page->getPage() + 1;
        $this->beforeLastPage = $this->page->getNbPages() -1;
        $this->pagination = '';

        // Si on a plus d'une page au total
        if ($this->page->getNbPages() > 1) {
            $this->pagination .= "<div class=\"pagination box text-center\">\n";
            $this->pagination .= "<ul>\n";
            // Si la page courante est supérieure à 1
            if ($this->page->getPage() > 1) {
                // Création du bouton précédent
                $this->pagination .= "<li><a href=\"{$this->url}{$this->previousPage}\" class=\"btn\"><</a></li>";
            } else {
                // Création du bouton précédent disabled
                $this->pagination .= "<li><a href=\"{$this->url}{$this->previousPage}\" class=\"btn disabled\"><</a></li>";
            }
            // Si on a plus de 8 pages au total, pas de troncature
            if ($this->page->getNbPages() < 6 + ($this->adjacent * 2)) {
                for ($i = 1; $i <= $this->page->getNbPages(); $i++) {
                    if ($i == $this->page->getPage()) {
                        $this->pagination .= "<li><a href=\"{$this->url}{$i}\" class=\"btn active\">{$i}</a></li>";
                    } else {
                        $this->pagination .= "<li><a href=\"{$this->url}{$i}\" class=\"btn\">{$i}</a></li>";
                    }
                }
            } else { // troncature
                // troncature de la fin
                if ($this->page->getPage() < 3 + ($this->adjacent * 2)) {
                    for ($i = 1; $i < 3 + ($this->adjacent * 2); $i++) {
                        if ($i == $this->page->getPage()) {
                            $this->pagination .= "<li><a href=\"{$this->url}{$i}\" class=\"btn active\">{$i}</a></li>";
                        } else {
                            $this->pagination .= "<li><a href=\"{$this->url}{$i}\" class=\"btn\">{$i}</a></li>";
                        }
                    }
                    $this->pagination .= '&hellip;';
                    $this->pagination .= "<li><a href=\"{$this->url}{$this->beforeLastPage}\" class=\"btn\">{$this->beforeLastPage}</a></li>";
                    $this->pagination .= "<li><a href=\"{$this->url}{$this->page->getNbPages()}\" class=\"btn\">{$this->page->getNbPages()}</a></li>";
                } elseif ((($this->adjacent * 2) + 1 < $this->page->getPage()) && ($this->page->getPage() + 1 < $this->page->getNbPages() - ($this->adjacent * 2))) {
                    $this->pagination .= "<li><a href=\"{$this->url}1\" class=\"btn\">1</a></li>";
                    $this->pagination .= "<li><a href=\"{$this->url}2\" class=\"btn\">2</a></li>";
                    $this->pagination .= '&hellip;';
                    for ($i = $this->page->getPage() - $this->adjacent; $i <= $this->page->getPage() + $this->adjacent; $i++) {
                        if ($i == $this->page->getPage()) {
                            $this->pagination .= "<li><a href=\"{$this->url}{$i}\" class=\"btn active\">{$i}</a></li>";
                        } else {
                            $this->pagination .= "<li><a href=\"{$this->url}{$i}\" class=\"btn\">{$i}</a></li>";
                        }
                    }
                    $this->pagination .= '&hellip;';
                    $this->pagination .= "<li><a href=\"{$this->url}{$this->beforeLastPage}\" class=\"btn\">{$this->beforeLastPage}</a></li>";
                    $this->pagination .= "<li><a href=\"{$this->url}{$this->page->getNbPages()}\" class=\"btn\">{$this->page->getNbPages()}</a></li>";
                } else {
                    $this->pagination .= "<li><a href=\"{$this->url}1\" class=\"btn\">1</a></li>";
                    $this->pagination .= "<li><a href=\"{$this->url}2\" class=\"btn\">2</a></li>";
                    $this->pagination .= '&hellip;';
                    for ($i = $this->page->getNbPages() - (2 + ($this->adjacent * 2)); $i <= $this->page->getNbPages(); $i++) {
                        if ($i == $this->page->getPage()) {
                            $this->pagination .= "<li><a href=\"{$this->url}{$i}\" class=\"btn active\">{$i}</a></li>";
                        } else {
                            $this->pagination .= "<li><a href=\"{$this->url}{$i}\" class=\"btn\">{$i}</a></li>";
                        }
                    }
                }
            }

            if ($this->page->getPage() == $this->page->getNbPages()) {
                // Création du bouton suivant disabled
                $this->pagination .= "<li><a href=\"{$this->url}{$this->nextPage}\" class=\"btn disabled\">></a></li>";
            } else {
                // Création du bouton suivant
                $this->pagination .= "<li><a href=\"{$this->url}{$this->nextPage}\" class=\"btn\">></a></li>";
            }
            $this->pagination .= "</ul>\n";
            $this->pagination .= "</div>\n";
        }


        //<li class="active"><a href="#" class="btn">1</a></li>


        return $this->pagination;
    }
    
    
    
    
}