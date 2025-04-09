-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 24, 2024 at 03:05 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perfumycompl`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `perfumy`
--

CREATE TABLE `perfumy` (
  `ID` int(4) NOT NULL,
  `Marka` varchar(20) NOT NULL,
  `Rodzaj` varchar(50) NOT NULL,
  `Typ` varchar(3) NOT NULL,
  `Cena` float NOT NULL,
  `Plec` varchar(1) NOT NULL,
  `Pojemnosc` int(3) NOT NULL,
  `Zdjecie` varchar(100) NOT NULL,
  `Strona` varchar(50) NOT NULL,
  `Opis` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `perfumy`
--

INSERT INTO `perfumy` (`ID`, `Marka`, `Rodzaj`, `Typ`, `Cena`, `Plec`, `Pojemnosc`, `Zdjecie`, `Strona`, `Opis`) VALUES
(1, 'DIOR', 'Sauvage', 'EDT', 499.99, 'M', 100, '../parfums/man/M_Dior_Sauvage.png', 'parfumes/sauvage.php', 'Zapach jak zaklęcie. Nuty ciepłego drzewa sandałowego i łagodnej fasoli Tonka rozjaśnione świeżością ostrej manadarynki. François Demachy, kreator perfum Dior, czerpał inspirację z dziewiczych obszarów dzikiej przyrody pod błękitnym niebem, gdzie intensywne aromaty trzaskającego ognia wznoszą się w powietrze.'),
(2, 'DIOR', 'Fahrenheit', 'EDT', 450.99, 'M', 100, '../parfums/man/M_Dior_Fahrenheit.png', 'parfumes/fahrenheit.php', 'Unikalna, wyróżniająca się kompozycja zapachowa, intensywna i czarująca. Świeże nuty sycylijskiej mandarynki i zaskakujące połączenie męskich akordów drzewnych i skórzanych z niespotykanym akordem fiołka. Kreatywność, wyróżnienie i charakter: kreacja Fahrenheit jest wyjątkowa - męska, ale subtelna. Dla mężczyzn kochających wolność.'),
(3, 'G. Armani', 'Acqua di Gio', 'EDT', 365.99, 'M', 100, '../parfums/man/M_Armani_AquaDiGio.png', 'parfumes/aqua.php', 'Niech Cię zobaczą! Pokaż światu swoją siłę, niezależność i pełen uroku seksapil. Czerp pewność siebie z zapachu Acqua di Gio Pour Homme, który zaakcentuje Twój męski charakter i siłę woli. Zostań mężczyzną, który się nie obawia stać w centrum uwagi i który docenia siebie takiego, jakim jest. Bądź mężczyzną, który nie boi się iść pod prąd.'),
(4, 'Hugo Boss', 'Bottled', 'EDT', 299.99, 'M', 100, '../parfums/man/M_HugoBoss_Bottled.png', 'parfumes/bootled.php', 'Pewny siebie, ambitny, gotowy na sukces. Określ wszystkie swoje cechy. Woda toaletowa Hugo Boss BOSS Bottled to idealny wybór dla mężczyzny XXI wieku. Wypróbuj i Ty ten ponadczasowy, elegancki zapach, który pokochały miliony mężczyzn na całym świecie!'),
(5, 'Hugo Boss', 'The Scent', 'EDT', 285.99, 'M', 100, '../parfums/man/M_HugoBoss_Scent.png', 'parfumes/scent.php', 'Woda toaletowa Boss The Scent jest jakby stworzona do wyrafinowanego uwodzenia. Atrakcyjny płyn w kolorze bursztynu ma w sobie szczyptę wyjątkowości. Ten jedyny w swoim rodzaju męski zapach pojawił się na rynku w 2015 r., a jego twarzą został charyzmatyczny aktor Theo James.'),
(6, 'Hugo Boss', 'XY', 'EDT', 209.99, 'M', 30, '../parfums/man/M_HugoBoss_XY.png', 'parfumes/xy.php', 'Woda toaletowa dla mężczyzn Hugo Boss XY to gwarantowana świeżość. Zapach skomponowany z myślą orzeźwienia i delikatności. Zamknięty w klasycznym flakonie sprawia, że chce się go używać non stop. Będzie Ci towarzyszył przez cały dzień.'),
(7, 'Bentley', 'Intense', 'EDP', 107.99, 'M', 100, '../parfums/man/M_Bentley_Intense.png', 'parfumes/intense.php', 'Podkreśl swoją męskość korzennym, seksownym zapachem. Dokładnie taka jest woda perfumowana Bentley for Men Intense, która uwydatni Twoje zalety i dostarczy Ci potrzebnej dawki pewności siebie. Gwarantujemy, że niejedna kobieta spyta Cię o ten interesujący zapach.'),
(8, 'D&G', 'The One', 'EDP', 477.95, 'M', 100, '../parfums/man/M_D&G_TheOne.png', 'parfumes/theone.php', 'Na początku pojawiają się nuty grejpfruta, kolendry i bazylii, które zapewniają promienne i eleganckie pierwsze wrażenie, umożliwiając odkrycie orientalno-pikantnej kompozycji. Gdy tylko wstępne nuty ustępują, pojawia się korzenne połączenie kardamonu z imbirem, wzbogacone o słodycz kwiatu pomarańczy. W ostatniej fazie rozwija się całe bogactwo zapachu dzięki tytoniowi, ambrze i drzewu cedrowemu, które zapewniają kompozycji długi finisz.'),
(9, 'CHANEL', 'No 5', 'EDP', 799.99, 'K', 100, '../parfums/woman/W_Chanel_No5.png', 'parfumes/no5.php', 'Perfumy przez wielkie P. Prawdziwa legenda wśród zapachów. Luksus ukryty w flakonie. To woda perfumowana Chanel No5, najsłynniejszy zapach wszechczasów, noszony także przez niezapomnianą gwiazdę filmową Marilyn Monroe.'),
(10, 'CHANEL', 'Chance', 'EDP', 599.99, 'K', 50, '../parfums/woman/W_Chanel_Chance.png', 'parfumes/chance.php', 'Kobieca, wyrafinowana i elegancka. Taka właśnie jest damska woda perfumowana Chanel Chance, która odzwierciedla ponadczasowy styl i dbałość o szczegóły. Jej kwiatowo-szyprowa kompozycja zapachowa nadaje się zarówno do noszenia na dzień, jak i na wyjątkowe okazje, pięknie podkreślając uroczysty charakter kreacji.'),
(11, 'DIOR', 'Jadore', 'EDP', 825.99, 'K', 100, '../parfums/woman/W_Dior_Jadore.png', 'parfumes/jadore.php', 'J\'adore Eau de Parfum to niezwykle szlachetny i kobiecy zapach od Dior stworzony w hołdzie dla miłości Christiana Diora do kwiatów. Główne nuty zapachowe tej kultowej kompozycji to kwiat Ylang-Ylang z wysp Como, róża damasceńska oraz jaśmin.'),
(12, 'Gucii', 'Bloom', 'EDP', 369.99, 'K', 100, '../parfums/woman/W_Gucci_Bloom.png', 'parfumes/bloom.php', 'Woda perfumowana Bloom ma czysto kwiatowy skład. Łączy w sobie akordy wiciokrzewu, tuberozy i jaśminu arabskiego, dzięki czemu zapach odznacza się wyrafinowaną elegancją i kobiecością. Kwiatowy aromat wzbogacono znanym ze zmysłowości korzeniem irysa, który dodaje kompozycji zapachowej głębi i uroku.'),
(13, 'Calvin Klein', 'CK One', 'EDT', 189.99, 'U', 300, '../parfums/unisex/U_CalvinKlein_CKOne.png', 'parfumes/ckone.php', 'Woda toaletowa uniseks Calvin Klein CK One to uosobienie młodzieńczej wolności, pomysłowości i wyjątkowości. Z tym zapachem możesz być naprawdę sobą!');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `perfumy`
--
ALTER TABLE `perfumy`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perfumy`
--
ALTER TABLE `perfumy`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
