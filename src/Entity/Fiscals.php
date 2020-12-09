<?php

namespace App\Entity;

use App\Repository\FiscalsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FiscalsRepository::class)
 */
class Fiscals
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    private $fnumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */

    public function getFnumber()
    {
        return $this->fnumber;
    }

    /**
     * @param mixed $fnumber
     */

    public function setFnumber($fnumber): void
    {
        $this->fnumber = $fnumber;
    }
}
