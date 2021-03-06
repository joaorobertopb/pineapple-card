<?php

namespace PineappleCard\Application\Transaction\Create;

use PineappleCard\Domain\Transaction\TransactionId;

class CreateTransactionResponse
{
    private TransactionId $transactionId;

    public function __construct(TransactionId $transactionId)
    {
        $this->transactionId = $transactionId;
    }

    public function __toString()
    {
        return json_encode(['id' => $this->transactionId->id()]);
    }
}
