<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceDetailRepository")
 */
class InvoiceDetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Invoice", inversedBy="invoiceDetail")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $invoice;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull
     * @Assert\Type("string")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotNull
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type("float")
     * @Assert\NotNull
     */
    private $amount;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type("float")
     * @Assert\NotNull
     */
    private $VATAmount;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type("float")
     * @Assert\NotNull
     */
    private $totalAmountAndVAT;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getVATAmount(): ?float
    {
        return $this->VATAmount;
    }

    public function setVATAmount(float $VATAmount): self
    {
        $this->VATAmount = $VATAmount;

        return $this;
    }

    public function getTotalAmountAndVAT(): ?float
    {
        return $this->totalAmountAndVAT;
    }

    public function setTotalAmountAndVAT(float $totalAmountAndVAT): self
    {
        $this->totalAmountAndVAT = $totalAmountAndVAT;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

}
