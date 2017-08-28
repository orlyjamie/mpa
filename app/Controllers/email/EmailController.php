<?php

namespace App\Controllers\Email;

use Slim\Router;
use Slim\Views\Twig;
use Slim\Flash\Messages as Flash;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \DrewM\MailChimp\MailChimp;

class EmailController
{
    protected $router;
    protected $view;
    protected $flash;
    protected $mailchimp;

    public function __construct(Router $router, Twig $view, Flash $flash, Mailchimp $mailchimp )
    {
        $this->router = $router;
        $this->view = $view;
        $this->flash = $flash;
        $this->mailchimp = $mailchimp;
    }

    public function index(Request $request, Response $response)
    {
        $emailLists = $this->mailchimp->get('lists');

        return $this->view->render($response, 'emails/email.lists.index.twig', [
            'lists' => $emailLists,
            'js_script' => 'test'
        ]);
    }

    public function getList($id, Request $request, Response $response)
    {
        $list = $this->mailchimp->get("lists/$id/members?count=100");

        //dump($list);

        return $this->view->render($response, 'emails/email.list.twig', [
            'list' => $list,
            'js_script' => 'test'
        ]);
    }

    public function getCampaigns(Request $request, Response $response)
    {
        $campaigns = $this->mailchimp->get("campaigns");

        return $this->view->render($response, 'emails/email.campaigns.twig', [
            'campaigns' => $campaigns,
            'js_script' => 'test'
        ]);
    }

    public function getTemplates(Request $request, Response $response)
    {
        $templates = $this->mailchimp->get("templates/161982");

        return $this->view->render($response, 'emails/email.templates.twig', [
            'templates' => $templates,
            'js_script' => 'test'
        ]);
    }

    public function getCampaignContent($id, Request $request, Response $response)
    {
        $content = $this->mailchimp->get("campaigns/$id/content");

        return $this->view->render($response, 'emails/email.campaign.content.twig', [
            'content' => $content,
            'js_script' => 'test'
        ]);
    }

    public function newRecipient(Request $request, Response $response, Mailchimp $mailchimp)
    {


        return $this->view->render($response, 'emails/email.new.recipient.twig', [
            'list' => $list,
            'js_script' => 'test'
        ]);
    }

}