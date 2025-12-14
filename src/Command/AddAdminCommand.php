<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Faker\Factory;

#[AsCommand(
    name: 'addAdmin',
    description: 'Adds an admin',
)]
class AddAdminCommand extends Command
{
    public function __construct(private EntityManagerInterface $em, private UserRepository $userRepository)
    {
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $user = new User();
        $user->setEmail('admin');
        $user->setPassword(password_hash('1', PASSWORD_BCRYPT));
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $this->em->persist($user);
        $this->em->flush();
        return Command::SUCCESS;
    }
}
