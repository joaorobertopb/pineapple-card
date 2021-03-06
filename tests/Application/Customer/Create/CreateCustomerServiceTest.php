<?php

namespace Tests\Application\Customer\Create;

use PHPUnit\Framework\TestCase;
use PineappleCard\Application\Customer\Create\CreateCustomerRequest;
use PineappleCard\Application\Customer\Create\CreateCustomerService;
use PineappleCard\Domain\Customer\Exception\EmailAlreadyExistsException;
use PineappleCard\Infrastructure\Persistence\InMemory\CustomerInMemoryRepository;

class CreateCustomerServiceTest extends TestCase
{
    private CustomerInMemoryRepository $repository;

    private CreateCustomerService $service;

    public function setUp(): void
    {
        $this->repository = new CustomerInMemoryRepository();
        $this->service = new CreateCustomerService($this->repository);
    }

    public function testShouldRaiseExceptionWhenEmailAlreadyExists()
    {
        $request = (new CreateCustomerRequest())
            ->setPayDay(5)
            ->setLimit(100)
            ->setEmail('test@test.com')
            ->setEncodedPassword('123456');


        $this->expectException(EmailAlreadyExistsException::class);


        $this->service->execute($request);
        $this->service->execute($request);
    }

    public function testShouldCreateCustomer()
    {
        $request = (new CreateCustomerRequest())
            ->setPayDay(5)
            ->setLimit(100)
            ->setEmail('test@test.com')
            ->setEncodedPassword('123456');


        $this->service->execute($request);


        $this->assertEquals(1, $this->repository->totalItens());
    }
}
