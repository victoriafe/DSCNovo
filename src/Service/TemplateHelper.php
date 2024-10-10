<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

readonly class TemplateHelper
{
    public function __construct(private Environment $twig)
    {
    }

    public function renderCrud(string $name, string $subject, $entity, FormInterface $form, bool $isEdit = false): Response
    {
        $renderedContent = $this->twig->render('crud.html.twig', [
            'name' => $name,
            'subject' => $subject,
            'isEdit' => $isEdit,
            'entity' => $entity,
            'form' => $form->createView(),
        ]);

        return new Response($renderedContent);
    }
}
