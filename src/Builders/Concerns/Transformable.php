<?php

declare(strict_types=1);

namespace BombenProdukt\Invoices\Builders\Concerns;

use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as Document;
use BombenProdukt\Invoices\Builders\InvoiceBuilder;
use BombenProdukt\Invoices\Data\Invoice;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

/** @mixin InvoiceBuilder */
trait Transformable
{
    public function toInvoice(): Invoice
    {
        return Invoice::make(
            identifier: $this->identifier,
            date: $this->date,
            dateFormat: $this->dateFormat,
            customer: $this->customer,
            vendor: $this->vendor,
            items: $this->items,
            discounts: $this->discounts,
        );
    }

    public function toHtml(): string
    {
        return View::make('invoices::invoice', [
            'dateFormat' => $this->dateFormat,
            'invoice' => $this->toInvoice(),
        ])->render();
    }

    public function toPdf(array $options = []): Document
    {
        return Pdf::setOptions($options)
            ->setPaper(config('invoices.paper.size'), config('invoices.paper.orientation'))
            ->loadHtml(\mb_convert_encoding($this->toHtml(), 'HTML-ENTITIES', 'UTF-8'));
    }

    public function toStream(): Response
    {
        return new Response($this->toHtml(), Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$this->getFileName().'"',
        ]);
    }

    public function toDownload(): Response
    {
        $html = $this->toHtml();

        return new Response($html, Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$this->getFileName().'"',
            'Content-Length' => \mb_strlen($html),
        ]);
    }

    private function getFileName(): string
    {
        return \sprintf(
            '%s_%s.pdf',
            $this->identifier,
            $this->date->format($this->dateFormat),
        );
    }
}
