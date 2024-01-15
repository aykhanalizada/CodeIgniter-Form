<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
           'id'=>[
               'type'=>'INT',
               'auto_increment' => true,
           ],
            'name'=>[
                'type'=>"VARCHAR",
                'constraint'=>100,
            ],
            'surname'=>[
                'type'=>"VARCHAR",
                'constraint'=>100,
            ],
            'birthday'=>[
                'type'=>"DATE",
                'null'=>true
            ],
            'email'=>[
                'type'=>"VARCHAR",
                'constraint'=>255,
            ],
            'password'=>[
                'type'=>"VARCHAR",
                'constraint'=>255,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => null,
                'null'=>true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' =>null,
                'on update' => 'CURRENT_TIMESTAMP',
                'null'=>true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');


    }

    public function down()
    {
        $this->forge->dropTable('users');

    }
}
