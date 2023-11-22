<?php

namespace App\Repository;

use App\Entity\Mots;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mots>
 *
 * @method Mots|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mots|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mots[]    findAll()
 * @method Mots[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mots::class);
    }

    /**
     * Generate a random word of a given length.
     *
     * @param int $length The length of the word to generate.
     * @return string The generated word.
     */
    public function generateRandomWord(int $length = 8): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $word = '';
        for ($i = 0; $i < $length; $i++) {
            $word .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $word;
    }

    /**
     * Create and persist a random word to the database.
     *
     * @param int $length The length of the word to generate.
     * @return Mots The persisted word entity.
     */
    public function createAndPersistRandomWord(int $length = 8): Mots
    {
        $wordValue = $this->generateRandomWord($length);

        $word = new Mots();
        $word->setValue($wordValue); // Assuming you have a setValue method in Mots entity

        $this->_em->persist($word);
        $this->_em->flush();

        return $word;
    }
}
