-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jul 2020 pada 07.03
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final-project-sanbercode`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`id`, `isi`, `pertanyaan_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '<p>After some time and some experience, the right answer to this question would be API Gateway. Microservices are complex enough on their own, and storing any files, small or large, would rather be a waste of networking, bandwith etc. and would just introduce latency issues and degrade performance as well as UX.</p>\r\n\r\n<p>I&#39;ll leave this out here just so people can hear this, as neither approach would be wrong, while the API Gateway choice just provides more practical benefits and thus is more appropriate. If this question was targetting data or files that are stored within a DB, microservice and it&#39;s DB would be the obvious choice.</p>\r\n\r\n<p>If you have the convenience to add an file server to your whole stack, then sure, that would be the correct approach, but that as well introduces more complexity and other stuff described above.</p>', 2, 1, '2020-07-11 00:07:11', '2020-07-11 00:07:11'),
(2, '<p><strong>API Gateway</strong></p>\r\n\r\n<p>The purpose of gateway is to redirect the requests and handle cross cutting concerns like authentication , logging etc. It shouldn&#39;t be doing more than that. Gateway has to be highly available and any problem to gateway means you can&#39;t access associated services.</p>\r\n\r\n<p><strong>File Upload</strong></p>\r\n\r\n<p>The file upload should be handled by microservice itself. Your gateway will only be used to pass and get the stream. Depending on nature of your system and if you are using cloud store you can use of pattern like &quot;valet key&quot;.&nbsp;<a href=\"https://docs.microsoft.com/en-us/azure/architecture/patterns/valet-key\">https://docs.microsoft.com/en-us/azure/architecture/patterns/valet-key</a></p>', 2, 3, '2020-07-11 00:08:32', '2020-07-11 00:08:32'),
(5, '<p>test editor content in ferdy</p>', 4, 3, '2020-07-11 07:23:22', '2020-07-11 07:23:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_jumlah_vote`
--

CREATE TABLE `jawaban_jumlah_vote` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_vote_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jawaban_jumlah_vote`
--

INSERT INTO `jawaban_jumlah_vote` (`id`, `jawaban_id`, `jumlah_vote_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2020-07-12 03:30:42', '2020-07-12 03:30:42'),
(2, 2, 4, '2020-07-12 03:31:15', '2020-07-12 03:31:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_komentar`
--

CREATE TABLE `jawaban_komentar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `komentar_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jawaban_komentar`
--

INSERT INTO `jawaban_komentar` (`id`, `jawaban_id`, `komentar_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2020-07-11 00:31:25', '2020-07-11 00:31:25'),
(2, 1, 6, '2020-07-11 00:43:36', '2020-07-11 00:43:36'),
(3, 2, 7, '2020-07-11 09:43:58', '2020-07-11 09:43:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_vote`
--

CREATE TABLE `jawaban_vote` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `vote_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jawaban_vote`
--

INSERT INTO `jawaban_vote` (`id`, `jawaban_id`, `vote_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2020-07-12 03:30:42', '2020-07-12 03:30:42'),
(2, 2, 2, '2020-07-12 03:31:15', '2020-07-12 03:31:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jumlah_vote`
--

CREATE TABLE `jumlah_vote` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `up` int(11) NOT NULL DEFAULT 0,
  `down` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jumlah_vote`
--

INSERT INTO `jumlah_vote` (`id`, `up`, `down`, `created_at`, `updated_at`) VALUES
(1, 3, 0, '2020-07-12 03:18:22', '2020-07-12 03:18:22'),
(2, 3, 0, '2020-07-12 03:23:14', '2020-07-12 03:23:14'),
(3, 3, 0, '2020-07-12 03:30:42', '2020-07-12 03:30:42'),
(4, 1, 0, '2020-07-12 03:31:15', '2020-07-12 03:31:15'),
(5, 1, 0, '2020-07-12 03:58:38', '2020-07-12 03:58:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jumlah_vote_pertanyaan`
--

CREATE TABLE `jumlah_vote_pertanyaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_vote_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jumlah_vote_pertanyaan`
--

INSERT INTO `jumlah_vote_pertanyaan` (`id`, `pertanyaan_id`, `jumlah_vote_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-07-12 03:18:22', '2020-07-12 03:18:22'),
(2, 4, 2, '2020-07-12 03:23:14', '2020-07-12 03:23:14'),
(3, 4, 5, '2020-07-12 03:58:38', '2020-07-12 03:58:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `isi`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'mungkin maksud kamu adalah ini', 3, '2020-07-10 16:40:57', '2020-07-10 16:40:57'),
(2, 'ya benar, tks atas jawabannya', 1, '2020-07-10 23:47:12', '2020-07-10 23:47:12'),
(5, 'apakah ini benar jawaban 1??', 3, '2020-07-11 00:31:24', '2020-07-11 00:31:24'),
(6, 'ya benar, lihat sumber berikut ,,', 1, '2020-07-11 00:43:36', '2020-07-11 00:43:36'),
(7, 'harusnya seperti ini pak', 2, '2020-07-11 09:43:58', '2020-07-11 09:43:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_pertanyaan`
--

CREATE TABLE `komentar_pertanyaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `komentar_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `komentar_pertanyaan`
--

INSERT INTO `komentar_pertanyaan` (`id`, `pertanyaan_id`, `komentar_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2020-07-10 16:40:57', '2020-07-10 16:40:57'),
(2, 2, 2, '2020-07-10 23:47:12', '2020-07-10 23:47:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_09_081223_create_pertanyaan_table', 1),
(5, '2020_07_09_081439_create_tag_table', 1),
(6, '2020_07_09_081507_create_pertanyaan_tag_table', 1),
(7, '2020_07_09_081551_create_jawaban_table', 1),
(8, '2020_07_09_081655_create_komentar_table', 1),
(9, '2020_07_09_081733_create_pertanyaan_has_komentar_table', 1),
(10, '2020_07_09_081859_create_jawaban_has_komentar_table', 1),
(11, '2020_07_09_081947_create_vote_table', 1),
(12, '2020_07_09_082045_create_vote_has_user_table', 1),
(13, '2020_07_09_082130_create_pertanyaan_has_vote_table', 1),
(14, '2020_07_09_082213_create_jawaban_has_vote_table', 1),
(15, '2020_07_09_122037_create_jawaban_tag_table', 1),
(16, '2020_07_10_233405_add_user_id_to_komentar_table', 2),
(17, '2020_07_11_101202_create_jumlah_votes_table', 3),
(18, '2020_07_11_101259_create_pertanyaan_jumlah_vote_table', 3),
(19, '2020_07_11_101313_create_jawaban_jumlah_vote_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `judul`, `isi`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'salah satu alasan mengapa mereka seperti itu ??', '<p>I have a issue with my service. I want to start a python script at boot (it takes more or less 20 seconds to complete this script) and I want to execute it every 2 minutes. So I create this service</p>\r\n\r\n<p>When I launch the script with &quot;sudo python /home/dev/Configuration-Folder/daemons/configureTimeScript.py&quot; it works very well but when I restart Ubuntu (16.04), the service won&#39;t start and shows me that it is inactive (dead)...</p>\r\n\r\n<p>Can you give me some tips to solve this issue?</p>\r\n\r\n<p>Thank you</p>', 1, '2020-07-10 05:10:55', '2020-07-10 05:10:55'),
(2, 'Larahub Sanbarcode ??', '<p>I have a issue with my service. I want to start a python script at boot (it takes more or less 20 seconds to complete this script) and I want to execute it every 2 minutes. So I create this service:</p>\r\n\r\n<pre>\r\n<code>[Unit]\r\nDescription=Set and check time and date of the board\r\n\r\n[Service]\r\nType=simple\r\nRestart=always\r\nRestartSec=120\r\nUser=root\r\nGroup=root\r\nExecStart=/usr/bin/python /home/dev/Configuration-Folder/daemons/configureTimeScript.py\r\n\r\n[Install]\r\nWantedBy=multi-user.target</code></pre>\r\n\r\n<p>When I launch the script with &quot;sudo python /home/dev/Configuration-Folder/daemons/configureTimeScript.py&quot; it works very well but when I restart Ubuntu (16.04), the service won&#39;t start and shows me that it is inactive (dead)...</p>\r\n\r\n<p>Can you give me some tips to solve this issue?</p>\r\n\r\n<p>Thank you</p>', 1, '2020-07-10 05:11:40', '2020-07-10 05:11:40'),
(3, 'SanberCode PHP ??', '<p>The field under validation must be a value preceding the given date. The dates will be passed into the PHP&nbsp;<code>strtotime</code>&nbsp;function. In addition, like the&nbsp;<a href=\"https://laravel.com/docs/6.x/validation#rule-after\"><code>after</code></a>&nbsp;rule, the name of another field under validation may be supplied as the value of&nbsp;<code>date</code>.</p>', 3, '2020-07-10 05:26:25', '2020-07-10 05:26:25'),
(4, 'User Test', '<p>I have added the following routes to my Django Rest framework project, the url is matching well and returns the list view for orders and inventories however it does not match for detail view&nbsp;<code>order/&lt;int:order_no&gt;</code>&nbsp;and&nbsp;<code>inventory/&lt;int:pk&gt;</code></p>\r\n\r\n<p><code>localhost:8000/FD/orders/</code>&nbsp;work but localhost:8000/FD/order/1/ does not match and returns</p>\r\n\r\n<pre>\r\n<code>Using the URLconf defined in FriendsDigital.urls, Django tried these  \r\nURL patterns, in this order:  \r\n \r\n1. admin/  \r\n2. ^rest-auth/  \r\n3. ^FD/ ^inventories/$ [name=&#39;inventory_list&#39;]   \r\n4. ^FD/  ^inventory/&lt;int:pk&gt;/ [name=&#39;inventory_edit&#39;]  \r\n5. ^FD/ ^orders/ [name=&#39;orders_list&#39;]  \r\n6. ^FD/ ^order/&lt;int:order_no&gt;/ [name=&#39;order_update&#39;]  \r\n\r\nThe current path, FD/order/1/, didn&#39;t match any of these</code></pre>\r\n\r\n<p>the same issue is for inventory</p>', 2, '2020-07-11 06:25:49', '2020-07-11 06:25:49'),
(5, 'Fastest way to duplicate an array in JavaScript - slice vs. \'for\' loop', '<p>in order to duplicate an array in JavaScript: which of the following is faster to use?</p>\r\n\r\n<h3>Slice method</h3>\r\n\r\n<pre>\r\n<code>var dup_array = original_array.slice();</code></pre>\r\n\r\n<h3><code>For</code>&nbsp;loop</h3>\r\n\r\n<pre>\r\n<code>for(var i = 0, len = original_array.length; i &lt; len; ++i)\r\n   dup_array[i] = original_array[i];</code></pre>\r\n\r\n<hr />\r\n<p>I know both ways do only a&nbsp;<strong>shallow copy</strong>: if original_array contains references to objects, objects won&#39;t be cloned, but only the references will be copied, and therefore both arrays will have references to the same objects. But this is not the point of this question.</p>\r\n\r\n<p>I&#39;m asking only about speed.</p>', 3, '2020-07-12 02:55:07', '2020-07-12 02:55:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan_tag`
--

CREATE TABLE `pertanyaan_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pertanyaan_tag`
--

INSERT INTO `pertanyaan_tag` (`id`, `pertanyaan_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-07-10 05:10:55', '2020-07-10 05:10:55'),
(2, 1, 2, '2020-07-10 05:10:55', '2020-07-10 05:10:55'),
(3, 1, 3, '2020-07-10 05:10:55', '2020-07-10 05:10:55'),
(4, 2, 2, '2020-07-10 05:11:40', '2020-07-10 05:11:40'),
(5, 2, 3, '2020-07-10 05:11:40', '2020-07-10 05:11:40'),
(6, 2, 4, '2020-07-10 05:11:40', '2020-07-10 05:11:40'),
(7, 3, 1, '2020-07-10 05:26:25', '2020-07-10 05:26:25'),
(8, 3, 2, '2020-07-10 05:26:25', '2020-07-10 05:26:25'),
(9, 3, 4, '2020-07-10 05:26:25', '2020-07-10 05:26:25'),
(10, 4, 1, '2020-07-11 06:25:49', '2020-07-11 06:25:49'),
(11, 4, 3, '2020-07-11 06:25:49', '2020-07-11 06:25:49'),
(12, 5, 2, '2020-07-12 02:55:07', '2020-07-12 02:55:07'),
(13, 5, 3, '2020-07-12 02:55:07', '2020-07-12 02:55:07'),
(14, 5, 4, '2020-07-12 02:55:07', '2020-07-12 02:55:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan_vote`
--

CREATE TABLE `pertanyaan_vote` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `vote_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pertanyaan_vote`
--

INSERT INTO `pertanyaan_vote` (`id`, `pertanyaan_id`, `vote_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-07-12 03:18:22', '2020-07-12 03:18:22'),
(2, 4, 1, '2020-07-12 03:23:14', '2020-07-12 03:23:14'),
(3, 4, 3, '2020-07-12 03:58:38', '2020-07-12 03:58:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE `tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tag`
--

INSERT INTO `tag` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'php', NULL, NULL),
(2, 'laravel', '2020-07-10 04:47:51', '2020-07-10 04:47:51'),
(3, 'javascript', '2020-07-10 04:48:00', '2020-07-10 04:48:00'),
(4, 'html', '2020-07-10 04:48:08', '2020-07-10 04:48:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `foto`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'restu', 'restulomboe0117@gmail.com', '19919.jpg', NULL, '$2y$10$U3CBXmk3ecI6kuNIt1G02.VzSe3rOzC0/d8w371laHnNd3nFTdbQa', NULL, '2020-07-09 06:42:14', '2020-07-09 06:42:14'),
(2, 'test', 'test@yahoo.com', '59677.jpeg', NULL, '$2y$10$OYJBkaKVedEbpneQdsXHk.La.cHbYvYQf1AIvwv.k52BM1VOkDMQi', 'J9gcjxJUw8Ew1pTUkRpGevAfjSrmFS8f7QMfmEYy3ApkAo797eTRe1lxnCnh', '2020-07-09 06:43:51', '2020-07-09 06:43:51'),
(3, 'ferdy', 'ferdy@gmail.com', '81483.png', NULL, '$2y$10$JhiKc51K6cwO/0cVIH/7wukEenUfyxtqLBawWKoRBXYFxNOSGAdAa', NULL, '2020-07-10 02:32:20', '2020-07-10 02:32:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_vote`
--

CREATE TABLE `user_vote` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vote_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_vote`
--

INSERT INTO `user_vote` (`id`, `vote_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2020-07-12 03:18:22', '2020-07-12 03:18:22'),
(2, 2, 2, '2020-07-12 03:30:42', '2020-07-12 03:30:42'),
(3, 3, 1, '2020-07-12 03:58:38', '2020-07-12 03:58:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vote`
--

CREATE TABLE `vote` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vote`
--

INSERT INTO `vote` (`id`, `point`, `created_at`, `updated_at`) VALUES
(1, 40, '2020-07-12 03:18:22', '2020-07-12 03:18:22'),
(2, 40, '2020-07-12 03:30:42', '2020-07-12 03:30:42'),
(3, 30, '2020-07-12 03:58:38', '2020-07-12 03:58:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban_jumlah_vote`
--
ALTER TABLE `jawaban_jumlah_vote`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban_komentar`
--
ALTER TABLE `jawaban_komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban_vote`
--
ALTER TABLE `jawaban_vote`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jumlah_vote`
--
ALTER TABLE `jumlah_vote`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jumlah_vote_pertanyaan`
--
ALTER TABLE `jumlah_vote_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar_pertanyaan`
--
ALTER TABLE `komentar_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pertanyaan_tag`
--
ALTER TABLE `pertanyaan_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pertanyaan_vote`
--
ALTER TABLE `pertanyaan_vote`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_vote`
--
ALTER TABLE `user_vote`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jawaban_jumlah_vote`
--
ALTER TABLE `jawaban_jumlah_vote`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jawaban_komentar`
--
ALTER TABLE `jawaban_komentar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jawaban_vote`
--
ALTER TABLE `jawaban_vote`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jumlah_vote`
--
ALTER TABLE `jumlah_vote`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jumlah_vote_pertanyaan`
--
ALTER TABLE `jumlah_vote_pertanyaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `komentar_pertanyaan`
--
ALTER TABLE `komentar_pertanyaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan_tag`
--
ALTER TABLE `pertanyaan_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan_vote`
--
ALTER TABLE `pertanyaan_vote`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_vote`
--
ALTER TABLE `user_vote`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `vote`
--
ALTER TABLE `vote`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
