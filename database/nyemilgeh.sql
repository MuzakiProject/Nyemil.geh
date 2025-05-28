-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk nyemilgeh
CREATE DATABASE IF NOT EXISTS `nyemilgeh` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `nyemilgeh`;

-- membuang struktur untuk table nyemilgeh.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.admin: ~0 rows (lebih kurang)
REPLACE INTO `admin` (`id`, `username`, `password`) VALUES
	(1, 'ownerNG12', 'nyemil14y5m9L');

-- membuang struktur untuk table nyemilgeh.admin_activity_log
CREATE TABLE IF NOT EXISTS `admin_activity_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int DEFAULT NULL,
  `action_type` enum('INSERT','DELETE','UPDATE','CREATE') NOT NULL,
  `target_table` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `admin_activity_log_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.admin_activity_log: ~0 rows (lebih kurang)

-- membuang struktur untuk table nyemilgeh.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.cart_items: ~0 rows (lebih kurang)

-- membuang struktur untuk table nyemilgeh.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `total_payment` decimal(12,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `shipping_address` text,
  `courier` varchar(50) DEFAULT NULL,
  `shipping_cost` decimal(12,2) DEFAULT NULL,
  `service` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_telp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.orders: ~6 rows (lebih kurang)
REPLACE INTO `orders` (`id`, `user_id`, `total_payment`, `status`, `shipping_address`, `courier`, `shipping_cost`, `service`, `no_telp`, `created_at`) VALUES
	(35, 1, 11000.00, 'pending', 'Jl. Untung Suropati. Gg Somad no.9, Bandar Lampung, Lampung', 'JNT Express', 0.00, 'Pesan Antar', '082812121244', '2025-05-25 11:05:39'),
	(36, 1, 11000.00, 'pending', 'Jl. Untung Suropati. Gg Somad no.9, Bandar Lampung, Lampung', 'JNT Express', 0.00, 'Pesan Antar', '082812121244', '2025-05-25 18:09:31');

-- membuang struktur untuk table nyemilgeh.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.order_items: ~6 rows (lebih kurang)
REPLACE INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(28, 35, 1, 1, 11000.00),
	(29, 36, 2, 1, 11000.00);

-- membuang struktur untuk table nyemilgeh.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `raw_response` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.payments: ~0 rows (lebih kurang)

-- membuang struktur untuk table nyemilgeh.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `productname` varchar(150) DEFAULT NULL,
  `description` text,
  `price` decimal(12,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `weight` int DEFAULT NULL,
  `image_product` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.products: ~9 rows (lebih kurang)
REPLACE INTO `products` (`id`, `productname`, `description`, `price`, `stock`, `weight`, `image_product`, `created_at`) VALUES
	(1, 'Basreng Pedas - BBQ', 'Bayangkan kerenyahan basreng yang pecah di mulut, diikuti dengan rasa pedas yang menantang dan aroma smoky BBQ yang khas. Itulah sensasi yang akan kamu dapatkan dari Basreng Pedas - BBQ kami. Lebih dari sekadar camilan pedas, ini adalah perpaduan rasa yang bikin nagih dan tak terlupakan!<br />\r\n<br />\r\n🔥 Cita Rasa Unik – Perpaduan gurihnya bakso goreng dengan rasa BBQ yang manis-pedas, bikin lidah bergoyang!<br />\r\n🥓 Aroma BBQ yang Menggoda – Setiap gigitan membawa aroma panggangan BBQ yang khas dan menggoda selera.<br />\r\n🌶️ Level Pedas Pas – Pedasnya tidak menyiksa, tapi cukup bikin ketagihan dan susah berhenti ngemil.<br />\r\n💯 Tanpa Pengawet – Dibuat dari bahan pilihan, diolah secara higienis, dan tahan lama meskipun tanpa bahan pengawet.<br />\r\n<br />\r\nBerat bersih: 100 gram<br />\r\nKemasan: Plastik ziplock – praktis dan bisa ditutup kembali agar tetap renyah', 11000.00, 100, 100, 'basrengbbq.png', '2025-05-18 00:50:25'),
	(2, 'Basreng Pedas - Daun jeruk', 'Bayangkan kerenyahan basreng yang pecah di mulut, diikuti dengan rasa pedas yang menggigit namun tetap nikmat, dan sentuhan aroma segar daun jeruk yang membangkitkan semangat. Itulah sensasi yang akan kamu dapatkan dari Basreng Pedas - Daun Jeruk kami. Lebih dari sekadar camilan pedas, ini adalah pengalaman rasa yang tak terlupakan. Siap menemani harimu dengan kelezatan yang bikin nagih!<br />\r\n<br />\r\n✅ Renyah dan gurih<br />\r\n✅ Sensasi pedas yang nampol<br />\r\n✅ Wangi daun jeruk yang menyegarkan<br />\r\n✅ Cocok untuk teman nonton, kerja, atau kumpul bareng teman<br />\r\n<br />\r\nBerat Bersih: 100g<br />\r\nTingkat Kepedasan: 🌶️🌶️ (sedang)', 11000.00, 100, 100, 'basrengjeruk.png', '2025-05-17 07:38:34'),
	(3, 'Basreng Asin - Original', 'Rasakan sensasi renyah di setiap gigitan Basreng Asin - Original. Basreng berkualitas tinggi kami diproses dengan sempurna untuk menghasilkan tekstur yang kriuk dan rasa asin gurih yang pas di lidah. Cocok untuk segala suasana.<br />\r\n<br />\r\n✅ Tekstur renyah, tidak keras<br />\r\n✅ Rasa original yang pas di lidah<br />\r\n✅ Cocok untuk segala usia<br />\r\n✅ Nikmat disantap kapan saja dan di mana saja<br />\r\n<br />\r\nBerat Bersih: 100g<br />\r\nTanpa MSG tambahan – aman untuk anak-anak', 11000.00, 100, 100, 'basrengori.png', '2025-05-17 07:49:39'),
	(4, 'Keripik Singkong - Original', 'Rasakan kelezatan Keripik Singkong - Original yang sesungguhnya! Kami hanya menggunakan singkong berkualitas terbaik yang diolah dengan hati-hati untuk menghasilkan keripik yang renyah, gurih, dan memiliki cita rasa singkong alami yang khas.<br />\r\n<br />\r\n✅ Tanpa bahan pengawet<br />\r\n✅ Gurih alami dari singkong pilihan<br />\r\n✅ Camilan sehat, cocok untuk semua umur<br />\r\n✅ Pas buat teman ngopi, ngeteh, atau nonton<br />\r\n<br />\r\nBerat Bersih: 100gr', 10000.00, 100, 100, 'singkong-prod.png', '2025-05-17 07:54:57'),
	(5, 'Keripik Singkong - Balado', 'Manjakan lidahmu dengan Keripik Singkong - Balado! Keripik singkong tipis yang renyah berpadu sempurna dengan balutan bumbu balado merah merona yang pedas, manis, dan gurih. Setiap gigitan memberikan ledakan rasa yang tak terlupakan. Cocok untuk teman santai, nonton, atau sebagai oleh-oleh khas.<br />\r\n<br />\r\n✅ Pedas manis seimbang, nggak bikin enek<br />\r\n✅ Tekstur renyah dan tidak berminyak<br />\r\n✅ Dibuat dari bahan alami tanpa pengawet<br />\r\n✅ Cocok untuk camilan harian atau oleh-oleh<br />\r\n<br />\r\nBerat Bersih: 100g<br />\r\nKomposisi: Singkong, Cabai, Bawang, Gula, Garam, Minyak Nabati', 10000.00, 100, 100, 'singkong-prodblado.png', '2025-05-17 08:03:10'),
	(6, 'Keripik Pisang - Original', 'Kriuk renyah dan manis alami! Itulah yang akan Anda rasakan dari Keripik Pisang - Original kami. Irisan pisang tipis yang digoreng hingga kering sempurna menghasilkan tekstur yang memuaskan dengan rasa manis alami pisang yang lezat dan bikin ketagihan.<br />\r\n<br />\r\n✅ Rasa manis alami, tanpa pemanis buatan<br />\r\n✅ Renyah dan tidak berminyak<br />\r\n✅ Cocok untuk camilan sehat anak-anak dan dewasa<br />\r\n✅ Tanpa pengawet dan pewarna<br />\r\n<br />\r\nBerat Bersih: 100g<br />\r\nKomposisi: Pisang, Gula, Minyak Nabati', 12000.00, 100, 100, 'pisangori.png', '2025-05-17 08:16:45'),
	(7, 'Keripik Pisang - Coklat', 'Bayangkan kerenyahan keripik pisang yang bertemu dengan kelembutan dan manisnya cokelat yang meleleh di lidah. Itulah yang akan kamu rasakan dari Keripik Pisang - Coklat kami. Lebih dari sekadar camilan, ini adalah perpaduan sempurna antara buah dan cokelat yang bikin harimu makin manis!<br />\r\n<br />\r\n✅ Coklat lumer, rasa manis pas di lidah<br />\r\n✅ Camilan kekinian dengan cita rasa klasik<br />\r\n✅ Tanpa pengawet, aman untuk semua usia<br />\r\n✅ Cocok buat teman nonton, kerja, atau hadiah<br />\r\n<br />\r\nBerat Bersih: 120g<br />\r\nKomposisi: Pisang, Gula, Minyak Nabati, Coklat Bubuk/Cair', 15000.00, 100, 100, 'pisangcoklat.png', '2025-05-17 08:19:57'),
	(8, 'Keripik Pisang - Matcha', 'Nikmati harmoni rasa yang tak terduga dari Keripik Pisang - Matcha! Keripik pisang tipis yang renyah berpadu sempurna dengan lapisan bubuk matcha premium yang memberikan rasa manis lembut pisang dan sedikit pahit yang elegan serta aroma yang menenangkan. Cocok untuk menemani waktu santai atau sebagai camilan yang membangkitkan semangat.<br />\r\n<br />\r\n✅ Matcha asli, rasa earthy yang khas<br />\r\n✅ Tekstur renyah, manisnya pas<br />\r\n✅ Tanpa bahan pengawet &amp; pewarna buatan<br />\r\n✅ Cocok untuk teman ngopi, belajar, atau me time<br />\r\n<br />\r\nBerat Bersih: 100g<br />\r\nKomposisi: Pisang, Gula, Minyak Nabati, Bubuk Matcha', 17000.00, 100, 100, 'pisangmatcha.png', '2025-05-17 08:23:45');

-- membuang struktur untuk table nyemilgeh.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.users: ~0 rows (lebih kurang)
REPLACE INTO `users` (`id`, `username`, `email`, `password`, `google_id`, `address`, `no_telp`, `created_at`) VALUES
	(1, 'Ahmad Hosam M', 'ahmadhosam2k@gmail.com', '$2y$12$OtViTsQcX1a.SE0bLvcHZukbLPMCU/r3PTNenRbi3JeUWDu6MPCI6', NULL, NULL, '082812121244', '2025-05-18 03:21:17');

-- membuang struktur untuk table nyemilgeh.user_activity_log
CREATE TABLE IF NOT EXISTS `user_activity_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `action_type` enum('ORDER','CANCEL','UPDATE') NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel nyemilgeh.user_activity_log: ~0 rows (lebih kurang)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
