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

    public function deleteHalls(int $id_h): bool
    {
        return ($this->db->prepare("DELETE FROM halls WHERE id_h = ?"))->execute([$id_h]);
    }

    public function deleteStock(int $id_stock): bool
    {
        return ($this->db->prepare("DELETE FROM stocks WHERE id_stock = ?"))->execute([$id_stock]);
    }

    public function deleteJenre(int $id_j): bool
    {
        return ($this->db->prepare("DELETE FROM jenre WHERE id_j = ?"))->execute([$id_j]);
    }

    /**
     * Запрос на добавление данных (Фильмы, Сессии, Новости)
     */
    
     //создаем функцию, в которой передаем данные id фильма, затем возвращаем результат выполнения удаления строки.
    public function createFilms($name, $id_jenre, $duration, $description, $release_date, $photo)
    {
        $result = $this->db->prepare("INSERT INTO films (name, id_jenre, duration, description, release_date, photo) VALUES (:name, :id_jenre, :duration, :description, :release_date, :photo)");
        return $result->execute([
            ':name' => $name,
            ':id_jenre' => $id_jenre,
            ':duration' => $duration,
            ':description' => $description,
            ':release_date' => $release_date,
            ':photo' => $photo
        ]);
    }

    public function createNews($header, $text, $photos)
    {
        $result = $this->db->prepare("INSERT INTO News (header, text, photos) VALUES (:header, :text, :photos)");
        return $result->execute([
            ':header' => $header,
            ':text' => $text,
            ':photos' => $photos
        ]);
    }

    public function createSessions($date, $time, $id_films, $id_halls)
    {
        $result = $this->db->prepare("INSERT INTO sessions (date, time, id_films, id_halls) VALUES (:date, :time, :id_films, :id_halls)");
        return $result->execute([
            ':date' => $date,
            ':time' => $time,
            ':id_films' => $id_films,
            ':id_halls' => $id_halls
        ]);
    }

    public function createHalls($name_h)
    {
        $result = $this->db->prepare("INSERT INTO halls (name_h) VALUES (:name_h)");
        return $result->execute([
            ':name_h' => $name_h
        ]);
    }

    public function createStocks($name, $text, $images)
    {
        $result = $this->db->prepare("INSERT INTO stocks (name, text, images) VALUES (:name, :text, :images)");
        return $result->execute([
            ':name' => $name,
            ':text' => $text,
            ':images' => $images
        ]);
    }

    public function createJenre($name_j)
    {
        $result = $this->db->prepare("INSERT INTO jenre (name_j) VALUES (:name_j)");
        return $result->execute([
            ':name_j' => $name_j
        ]);
    }

}