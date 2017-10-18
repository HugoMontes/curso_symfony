<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\CursoRepository")
 */
class Curso
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="costo", type="float")
     */
    private $costo;

    /**
     * @ORM\OneToMany(targetEntity="Estudiante", mappedBy="curso")
     */
    private $estudiantes;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Curso
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set costo
     *
     * @param float $costo
     *
     * @return Curso
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get costo
     *
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estudiantes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add estudiante
     *
     * @param \AdminBundle\Entity\Estudiante $estudiante
     *
     * @return Curso
     */
    public function addEstudiante(\AdminBundle\Entity\Estudiante $estudiante)
    {
        $this->estudiantes[] = $estudiante;

        return $this;
    }

    /**
     * Remove estudiante
     *
     * @param \AdminBundle\Entity\Estudiante $estudiante
     */
    public function removeEstudiante(\AdminBundle\Entity\Estudiante $estudiante)
    {
        $this->estudiantes->removeElement($estudiante);
    }

    /**
     * Get estudiantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstudiantes()
    {
        return $this->estudiantes;
    }
}
