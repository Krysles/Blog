<?php
namespace App\Controller;

class Page extends \App\Core\Controller
{
    public function read()
    {
        $page = new \App\Model\Page();
        if ($this->request->existParam('get', 'id')) {
            if (!$page->isValid($this->request->getParam('get', 'id'))) {
                $this->request->getSession()->setAttribut('flash', $page->getMessage());
                $page->setPage(1);
            }
        } else {
            $page->setPage(1);
        }
        
        $title = $page->getTitle();
        
        $tickets = $page->getTickets();

        $ticketsNoPublish = $page->getBook()->getTicketsNoPublish();

        $lastTickets = $page->getBook()->getTickets(0, 10);

        $paginator = new \App\Model\Paginator($page);

        $this->generateView(array(
            'title' => $title,
            'tickets' => $tickets,
            'ticketsNoPublish' => $ticketsNoPublish,
            'lastTickets' => $lastTickets,
            'paginator' => $paginator->generate()
        ));
    }
}