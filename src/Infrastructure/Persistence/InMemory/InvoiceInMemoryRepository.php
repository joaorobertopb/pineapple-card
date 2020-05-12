<?php

namespace PineappleCard\Infrastructure\Persistence\InMemory;

use PineappleCard\Domain\Customer\CustomerId;
use PineappleCard\Domain\Invoice\Invoice;
use PineappleCard\Domain\Invoice\InvoiceRepository;
use PineappleCard\Domain\Invoice\ValueObject\Period;
use Tightenco\Collect\Support\Collection;

class InvoiceInMemoryRepository implements InvoiceRepository
{
    private Collection $items;

    public function __construct()
    {
        $this->items = new Collection();
    }

    public function create(Invoice $invoice): Invoice
    {
        $this->items->push($invoice);

        return $invoice;
    }

    public function byPeriod(CustomerId $customerId, Period $period): ?Invoice
    {
        // TODO: Implement byPeriod() method.
    }
}
