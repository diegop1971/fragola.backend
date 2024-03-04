<?php

declare(strict_types=1);

namespace src\frontoffice\Cart\Application\Update;

use src\frontoffice\Cart\Domain\ProductId;
use src\frontoffice\Cart\Domain\ProductQty;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\frontoffice\Cart\Application\Update\CartUpdater;
use src\frontoffice\Cart\Application\Update\UpdateCartCommand;

final class UpdateCartCommandHandler implements CommandHandler
{
    private $productId;
    private $productQty;

    public function __construct(
                            private CartUpdater $cartUpdater
                        ) {
        $this->cartUpdater = $cartUpdater;
    }

    public function __invoke(UpdateCartCommand $updateCartCommand)
    {
        $this->productId = new ProductId($updateCartCommand->productId());

        $this->productQty = new ProductQty($updateCartCommand->productQty());

        $this->cartUpdater->__invoke(
                                $this->productId, 
                                $this->productQty,
                            );
    }
}
