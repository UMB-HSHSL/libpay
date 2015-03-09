<?php
class Migration_init extends CI_Migration
{
    public function up()
    {
        $this->db->query('CREATE TABLE `charge` (
            `id` serial primary key,
            `stripe_id` varchar(255) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->db->query('CREATE TABLE `charge_field` (
            `id` serial primary key,
            `charge_id` bigint(20) unsigned NOT NULL,
            `charge_field` varchar(255) NOT NULL,
            `charge_value` text NOT NULL,
            KEY `charge_field_charge_id` (`charge_id`),
            CONSTRAINT `charge_field_charge_id` FOREIGN KEY (`charge_id`) REFERENCES `charge` (`id`) ON DELETE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8
        ');

    }

    public function down()
    {
        $this->dbforge->drop_table('charge_field');
        $this->dbforge->drop_table('charge');
    }
}

