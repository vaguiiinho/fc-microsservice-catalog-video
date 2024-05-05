<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTraid;

class Category
{
    use MethodsMagicsTraid;
    
    public function __construct(
        protected string $id = '',
        protected string $name,
        protected string $description,
        protected bool $isActive = true
    )
    {
        
    }
}