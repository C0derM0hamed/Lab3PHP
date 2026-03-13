<?php

class Student
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM students ORDER BY id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM students WHERE id = ?');
        $stmt->execute([$id]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        return $student ?: null;
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM students WHERE username = ?');
        $stmt->execute([$username]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        return $student ?: null;
    }

    public function create(array $data): void
    {
        $sql = 'INSERT INTO students (first_name, last_name, address, country, gender, skills, username, password, department, profile_picture)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['address'],
            $data['country'],
            $data['gender'],
            $data['skills'],
            $data['username'],
            $data['password'],
            $data['department'],
            $data['profile_picture'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        if ($data['profile_picture'] !== null) {
            $sql = 'UPDATE students SET first_name = ?, last_name = ?, address = ?, country = ?, gender = ?, username = ?, skills = ?, department = ?, profile_picture = ? WHERE id = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['first_name'],
                $data['last_name'],
                $data['address'],
                $data['country'],
                $data['gender'],
                $data['username'],
                $data['skills'],
                $data['department'],
                $data['profile_picture'],
                $id,
            ]);
            return;
        }

        $sql = 'UPDATE students SET first_name = ?, last_name = ?, address = ?, country = ?, gender = ?, username = ?, skills = ?, department = ? WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['address'],
            $data['country'],
            $data['gender'],
            $data['username'],
            $data['skills'],
            $data['department'],
            $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM students WHERE id = ?');
        $stmt->execute([$id]);
    }
}
