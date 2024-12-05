<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $item_code = null;

    #[ORM\Column(length: 255)]
    private ?string $item_name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 65, scale: 2)]
    private ?string $item_price = null;

    #[ORM\Column]
    private ?int $item_category_id = null;

    #[ORM\Column(length: 255)]
    private ?string $item_image = null;

    #[ORM\Column(type: TYPES::TEXT, nullable: true)]
    private ?string $item_description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getItemCode(): ?string
    {
        return $this->item_code;
    }

    public function setItemCode(string $item_code): static
    {
        $this->item_code = $item_code;

        return $this;
    }

    public function getItemName(): ?string
    {
        return $this->item_name;
    }

    public function setItemName(string $item_name): static
    {
        $this->item_name = $item_name;

        return $this;
    }

    public function getItemPrice(): ?string
    {
        return $this->item_price;
    }

    public function setItemPrice(string $item_price): static
    {
        $this->item_price = $item_price;

        return $this;
    }

    public function getItemCategoryId(): ?int
    {
        return $this->item_category_id;
    }

    public function setItemCategoryId(int $item_category_id): static
    {
        $this->item_category_id = $item_category_id;

        return $this;
    }

    public function getItemImage(): ?string
    {
        return $this->item_image;
    }

    public function setItemImage(string $item_image): static
    {
        $this->item_image = $item_image;

        return $this;
    }

    public function getItemDescription(): ?string
    {
        return $this->item_description;
    }

    public function setItemDescription(?string $item_description): static
    {
        $this->item_description = $item_description;

        return $this;
    }
}
