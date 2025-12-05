<?php
class Connection {
    private static $instance = null;

    public static function getInstance() {
        if (!self::$instance) {
            try {
                $host = 'localhost';
                $dbname = 'OFICINA';
                $user = 'root';
                $pass = 'Charlo2025@';

                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user,
                    $pass
                );

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Erro ao conectar ao MySQL: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
?>
