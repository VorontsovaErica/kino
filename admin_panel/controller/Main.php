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
    
     //создаем функцию, в которой передаем данные id фильма, затем возвращаем результат выполнения удаления строки.
    public function deleteFilm(int $id_f): bool
    {
        return ($this->db->prepare("DELETE FROM films WHERE id_f = ?"))->execute([$id_f]);
    }

    //создаем функцию, в которой передаем данные id сеанса, затем возвращаем результат выполнения удаления строки.
    public function deleteSessions(int $id_s): bool
    {
        return ($this->db->prepare("DELETE FROM sessions WHERE id_s = ?"))->execute([$id_s]);
    }

    //создаем функцию, в которой передаем данные id новости, затем возвращаем результат выполнения удаления строки.
    public function deleteNews(int $id_n): bool
    {
        return ($this->db->prepare("DELETE FROM News WHERE id_n = ?"))->execute([$id_n]);
    }

    /**
     * Запрос на добавление данных (Фильмы, Сессии, Новости)
     */
    
     //создаем функцию, в которой передаем данные id фильма, затем возвращаем результат выполнения удаления строки.
    public function createFilms($name, $id_jenre, $duration, $description, $release_date)
    {
        $result = $this->db->prepare("INSERT INTO films (name, id_jenre, duration, description, release_date) VALUES (:name, :id_jenre, :duration, :description, :release_date)");
        return $result->execute([
            ':name' => $name,
            ':id_jenre' => $id_jenre,
            ':duration' => $duration,
            ':description' => $description,
            ':release_date' => $release_date
        ]);
    }

}