<?php
/*
This file is part of Mayfly.

Mayfly is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Foobar is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Foobar.  If not, see <http://www.gnu.org/licenses/>.

*/
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Monitoring extends Command {

        /**
         * The console command name.
         *
         * @var string
         */
        protected $name = 'rsabackend:monitoring';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Command description.';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
                parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function fire()
        {
		$num = Pregen::Where('valid_untill','>',date('Y-m-d H:i:s'))->count();
		if ($num < 25)
		{
			echo "Critical - Pregenned keys to low:  ";
			echo $num . " in queue\n";
			exit(2);
		}
		if ($num < 75)
		{
			echo "Warning - Pregenned keys to low:  ";
			echo $num . " in queue\n";
			exit(1);
		} else {
			echo "OK:      ";
			echo $num . " in queue\n";
			exit(0);
		}
        }

        /**
         * Get the console command arguments.
         *
         * @return array
         */
        protected function getArguments()
        {
                return array(
                );
        }

        /**
         * Get the console command options.
         *
         * @return array
         */
        protected function getOptions()
        {
                return array(
                );
        }

}
