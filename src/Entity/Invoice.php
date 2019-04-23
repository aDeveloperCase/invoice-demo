<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     * @Assert\Type("datetime")
     */
    private $invoiceDate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\Type("integer")
     */
    private $invoiceNumber;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\InvoiceDetail", mappedBy="invoice", cascade={"persist"})
     */
    private $invoiceDetail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="invoice")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(\DateTimeInterface $invoiceDate): self
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(int $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getInvoiceDetail(): ?InvoiceDetail
    {
        return $this->invoiceDetail;
    }

    public function setInvoiceDetail(?InvoiceDetail $invoiceDetail): self
    {
        $this->invoiceDetail = $invoiceDetail;
        $invoiceDetail->setInvoice($this);

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
