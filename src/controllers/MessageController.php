<?php

namespace TestPhp\Controllers;

use \PDO;
use TestPhp\Common\Connector;
use TestPhp\Common\TwilioService;

class MessageController
{
	protected $db;

	public function __construct($db = NULL)
	{

		$this->db = $db ?? new Connector();
	}

	public function saveMessage($data)
	{
		$phoneList = explode(",", $data['to']);

		foreach ($phoneList as $phone) {
			$sql = 'INSERT INTO messages (message_to, body,created_at) VALUES(?,?,?)';
			$args = [$phone, $data['message'], date('Y-m-d H:i:s')];

			$this->db->run($sql, $args);

			$data['id'] = $this->db->lastInsertId();

			$this->sendMessage($phone, $data);
		}


		return $data ? $data : [];
	}

	public function getLatestMessages($sort = "id", $direction = "asc"): array
	{
		$sorting = 'ORDER BY ' . $sort . ' ' . $direction;
		$sql = 'SELECT DISTINCT m.id, m.message_to, m.body, ms.confirmation_code  FROM messages AS m
		INNER JOIN messages_sent AS ms ON ms.message_id = m.id ' . $sorting;
		$response = $this->db->run($sql)->fetchAll(PDO::FETCH_ASSOC);
		return $response ? $response : [];
	}

	private function sendMessage($phone, $data)
	{
		$res = TwilioService::sendMessage($phone, $data);
		$sql = "INSERT INTO messages_sent (message_id,sent_at,confirmation_code) VALUES(?,?,?)";
		$args = [$data['id'], $res['sent_at'], $res['sid']];

		$this->db->run($sql, $args);
	}
}
