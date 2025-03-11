<?php

namespace Blaspsoft\SocialitePlus\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'socialiteplus:install')]
class InstallCommand extends Command
{
    use InstallVue, InstallReact;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socialiteplus:install {stack : The stack that should be installed (vue, react)}
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Socialite Plus package';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        if ($this->argument('stack') === 'vue') {
            return $this->installVue();
        } elseif ($this->argument('stack') === 'react') {
            return $this->installReact();
        }

        $this->components->error('Invalid stack. Supported stacks are [vue], [react].');
        
        return 1;
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  bool  $asDev
     * @return bool
     */
    protected function requireComposerPackages(array $packages, $asDev = false)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            $packages,
            $asDev ? ['--dev'] : [],
        );

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            }) === 0;
    }
}
