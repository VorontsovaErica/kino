<?php

class Main
{

    private $db;

    /**
     * Подключение к БД
     */
    public function __construct()
    {
        $this->db = new PDO('mysql:host=10.100.3.80;dbname=20313_kino', '20313', 'sblbvy');
    }

    /**
     * Запрос на удаление данных (Фильмы, Сессии, Новости)
     */
    
    public function deleteFilm(int $id_f): bool
    {
        return ($this->db->prepare("DELETE FROM films WHERE id_f = ?"))->execute([$id_f]);
    }

    public function deleteSessions(int $id_s): bool
    {
        return ($this->db->prepare("DELETE FROM sessions WHERE id_s = ?"))->execute([$id_s]);
    }

    public function deleteNews(int $id_n): bool
    {
        return ($this->db->prepare("DELETE FROM News WHERE id_n = ?"))->execute([$id_n]);
    }

    
}