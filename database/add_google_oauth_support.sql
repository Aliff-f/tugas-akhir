-- Tambahkan kolom google_id ke tabel users untuk mendukung Google OAuth login
-- Jalankan query ini di phpMyAdmin atau MySQL client Anda

ALTER TABLE `users`
ADD COLUMN `google_id` VARCHAR(255) NULL DEFAULT NULL AFTER `profile_picture`,
ADD UNIQUE KEY `google_id` (`google_id`);

-- Ubah kolom gender menjadi nullable (karena Google tidak selalu memberikan gender)
ALTER TABLE `users`
MODIFY COLUMN `gender` ENUM('male', 'female', 'other') NULL DEFAULT NULL;

-- Ubah kolom password menjadi nullable (karena Google login tidak perlu password)
ALTER TABLE `users`
MODIFY COLUMN `password` VARCHAR(255) NULL DEFAULT NULL;
