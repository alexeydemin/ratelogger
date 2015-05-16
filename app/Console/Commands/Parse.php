<?php namespace tinkoff\Console\Commands;

use Illuminate\Console\Command;
use tinkoff\Parser;

class Parse extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse data from tinkoff.ru website';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parser = new Parser();
        $parser->parse();
    }

}
