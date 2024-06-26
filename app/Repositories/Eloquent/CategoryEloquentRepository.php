<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Presenter\PaginationPresenter;
use Core\Domain\Entity\Category as EntityCategory;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class CategoryEloquentRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function insert($entity): EntityCategory
    {
        $response = $this->model->create([
            'id' => $entity->id,
            'name' => $entity->name,
            'description' => $entity->description,
            'is_active' => $entity->isActive,
            'created_at' => $entity->createdAt(),
        ]);

        return $this->toCategory($response);
    }


    public function findById(string $id): EntityCategory
    {
        if (!$category = $this->model->find($id)) {
            throw new NotFoundException();
        }

        return $this->toCategory($category);
    }
    public function findAll(string $filter = '', $order = 'DESC'): array
    {
        $categories = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('name', 'LIKE', "%{$filter}%");
                }
            })
            ->orderBy('id', $order)
            ->get();
        return $categories->toArray();
    }
    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {

        return new PaginationPresenter;
    }
    public function update(EntityCategory $category): EntityCategory
    {
        return new EntityCategory(
            name: $category->name,
        );
    }
    public function delete(string $id): bool
    {
        return true;
    }

    private function toCategory(object $entity): EntityCategory
    {
        return new EntityCategory(
            id: $entity->id,
            name: $entity->name,
            description: $entity->description,
            isActive: $entity->is_active,
        );
    }
}
