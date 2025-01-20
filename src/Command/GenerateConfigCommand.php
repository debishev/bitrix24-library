<?php

namespace Debishev\Bitrix24Library\Command;



use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Debishev\Bitrix24Library\DependencyInjection\Configuration;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'bitrix24:generate-config',
    description: 'Generates the default configuration file for Bitrix24LibraryBundle.',
)]
class GenerateConfigCommand extends Command
{

    public function __construct(
        private readonly KernelInterface $kernel
    )
    {
        parent::__construct();

    }


    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filesystem = new Filesystem();
        $configPath = $this->kernel->getProjectDir() . '/config/packages/bitrix24_library.yaml';

        $output->writeln('Start WRITE CONFIG file ');

        // Проверяем, существует ли файл конфигурации
//        if ($filesystem->exists($configPath)) {
//            $output->writeln('Configuration file already exists.');
//            return Command::SUCCESS;
//        }

        $fileConfiguration = new Configuration();

        $processor = new Processor();


        $config = $processor->processConfiguration($fileConfiguration, []);



        // Преобразуем массив в YAML
        $yamlConfig = Yaml::dump(['bitrix24_library' => $config], 4);

        // Записываем конфигурацию в файл
        $filesystem->dumpFile($configPath, $yamlConfig);

        $output->writeln('Configuration file generated successfully ');
        return Command::SUCCESS;
    }


}