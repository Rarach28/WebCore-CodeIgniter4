<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfileImageToUser extends Migration
{
	public function up()
	{
		$this->forge->addColumn('user',[
			'profile_image'=>[
				'type' => 'VARCHAR',
				'constraint' => '128',
			]

		]);
	}

	public function down()
	{
		$this->forge->dropColun('user','profile_image');
	}
}
