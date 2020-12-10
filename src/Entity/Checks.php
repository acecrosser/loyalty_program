<?php

namespace App\Entity;

use App\Repository\ChecksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChecksRepository::class)
 */
class Checks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $datetime;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $summa;

    /**
     * @ORM\Column(type="integer")
     */
    private $indef;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $fp;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getSumma()
    {
        return $this->summa;
    }

    /**
     * @param mixed $summa
     */
    public function setSumma($summa): void
    {
        $this->summa = $summa;
    }

    /**
     * @return mixed
     */
    public function getIndef()
    {
        return $this->indef;
    }

    /**
     * @param mixed $indef
     */
    public function setIndef($indef): void
    {
        $this->indef = $indef;
    }

    /**
     * @return mixed
     */
    public function getFp()
    {
        return $this->fp;
    }

    /**
     * @param mixed $fp
     */
    public function setFp($fp): void
    {
        $this->fp = $fp;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }
}
