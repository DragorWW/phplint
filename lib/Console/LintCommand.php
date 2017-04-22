<?php
namespace PhpLint\Console;

use PhpLint\Config\Configuration;
use PhpLint\ConfigLoader;
use PhpLint\Finder;
use PhpLint\PhpLint;
use PhpLint\Reporter;
use PhpParser\Node;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\FileLocator;


class LintCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('phplint')
            ->setHelp('This command allows you to create a user...')
            ->setDescription('Outputs \'Hello World\'')
            ->setDefinition(
                new InputDefinition([
                    new InputArgument('patch', InputArgument::OPTIONAL, 'file.js [file.js] [dir]', './'),
                    // Basic configuration:
                    new InputOption('config', 'c', InputOption::VALUE_OPTIONAL, 'Use configuration from this file or shareable config'),
                    new InputOption('ext', null, InputOption::VALUE_OPTIONAL, 'Specify PHP file extensions', '.php'),
                    //Caching:
                    new InputOption('cache', null, InputOption::VALUE_OPTIONAL, 'Only check changed files', false),
                    new InputOption('cache-location', null, InputOption::VALUE_OPTIONAL, 'Path to the cache file or directory'),
                    //Specifying rules and plugins:
                    new InputOption('rulesdir', null, InputOption::VALUE_OPTIONAL, 'Use additional rules from this directory'),
                    //Ignoring files:
                    new InputOption('ignore-path', null, InputOption::VALUE_OPTIONAL, 'Specify path of ignore file'),
                    new InputOption('no-ignore', null, InputOption::VALUE_OPTIONAL, 'Disable use of ignore files and patterns'),
                    new InputOption('ignore-pattern', null, InputOption::VALUE_OPTIONAL, 'Pattern of files to ignore (in addition to those in .phplintignore)'),
                    //Using stdin:
                    new InputOption('stdin', null, InputOption::VALUE_OPTIONAL, 'Lint code provided on <STDIN>', false),
                    new InputOption('stdin-filename', null, InputOption::VALUE_OPTIONAL, 'Specify filename to process STDIN as'),
                    //Handling warnings:
                    //new InputOption('quiet', null, InputOption::VALUE_OPTIONAL, 'Report errors only', false),
                    new InputOption('max-warnings', null, InputOption::VALUE_OPTIONAL, 'Number of warnings to trigger nonzero exit code', -1),
                    //Output:
                    new InputOption('output-file', 'o', InputOption::VALUE_OPTIONAL, 'Number of warnings to trigger nonzero exit code', -1),
                    //Miscellaneous:
                    new InputOption('init', null, InputOption::VALUE_OPTIONAL, 'Run config initialization wizard', false),
                    new InputOption('fix', null, InputOption::VALUE_OPTIONAL, 'Automatically fix problems'),
                    new InputOption('debug', null, InputOption::VALUE_OPTIONAL, 'Output debugging information'),
                    new InputOption('no-inline-config', null, InputOption::VALUE_OPTIONAL, 'Prevent comments from changing config or rules'),
                ])
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configLoader = new ConfigLoader();
        $logger = new ConsoleLogger($output);
        $logger->info('I love Tony Vairelles\' hairdresser.');
        $finder = new Finder($input->getArgument('patch'), $input->getOption('ext'), $input->getOption('ignore-path'), $input->getOption('ignore-pattern'));


        $locator = new FileLocator(getcwd());
        $yamlUserFiles = $locator->locate('.phplint.yaml', null, true);
        $config = Yaml::parse(
            file_get_contents($yamlUserFiles)
        );

        $yamlConfiguration = new Configuration();
        $processor = new Processor();
        $configuration = $processor->processConfiguration(
            $yamlConfiguration,
            [$config]
        );

        $phpLint = new PhpLint();

        foreach ($configuration['rules'] as $ruleName => $params ) {
            // TODO: check is rule exist
            $rule = '\PhpLint\Rules\\' . ucfirst($ruleName);

            $phpLint->setRule(new $rule);
        }
        foreach ($finder->files() as $file) {
            $phpLint->validate($file);
        }
        $reportList = Reporter::getInstance()->getReport();
        $reportByFile = [];
//    foo.php
//      0:0  warning  File ignored because of your .eslintignore file. Use --no-ignore to override.
//
//    ✖ 1 problem (0 errors, 1 warning)
        $io = new SymfonyStyle($input, $output);
        foreach ($reportList as $report) {
            if (!isset($reportByFile[$report['file']])) {
                $reportByFile[$report['file']] = [];
            }
            $reportByFile[$report['file']][] = $report;
        }
        foreach ($reportByFile as $file => $reports) {
            $io->note($file);
            foreach ($reports as $report) {
                /**
                 * @var Node
                 */
                $node = $report['node'];

                $io->writeln($node->getAttribute('startLine') . ':' . $node->getAttribute('startTokenPos') . ' error ' . $report['message'] . ' ' . $report['rule']);
            }
        }

        if (count($reportList)) {
            return 1;
        }
    }
}