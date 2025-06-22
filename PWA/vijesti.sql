-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2025 at 10:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vijesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `lozinka`, `admin`) VALUES
(1, 'Luka', '$2y$10$izruojTKvYmrmLDqtGwSU.f6Tk7qjGV4bmVDquWu7yUIGw1Sml45e', 1),
(3, 'MAto', '$2y$10$Qfa55KKaLap05isTi3Wz6.bHGep3voDPr8L25WdhqlGwy/pifNvgS', 1),
(4, 'pero98', '$2y$10$zyQ1qrDQexCAkk/RD6Ea2eeBjqWWsE6UXyCYVIPjcrJrQrdA3yw.G', 1),
(5, 'iva11', '$2y$10$7vm29KQ0KEMx4MSOtrWkWeYdlHetOwBq0rJTwajluTUEq5Z7kOSCa', 0),
(8, 'neko', '$2y$10$OqPkSAC7Cyc4e2kCKTzvhOlMEmNWDb.OTZM320hYbC2DyduDU8w2m', 1),
(9, 'pero99', '$2y$10$r1JGVXGQrthjmUtzLJR5ke49Nmr0/hleWv1OWW1.t1JMTjkfV0yxW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) DEFAULT NULL,
  `sazetak` text DEFAULT NULL,
  `tekst` text DEFAULT NULL,
  `kategorija` varchar(100) DEFAULT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `prikazati` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `naslov`, `sazetak`, `tekst`, `kategorija`, `slika`, `prikazati`) VALUES
(14, 'Donna Vekić osvojila turnir u Berlinu', 'Hrvatska tenisačica Donna Vekić osvojila je WTA turnir u Berlinu pobijedivši u finalu Belindu Bencic sa 6:3, 7:5.', 'Donna Vekić ostvarila je jednu od najvećih pobjeda u karijeri osvajanjem prestižnog WTA turnira u Berlinu. U finalnom meču svladala je Švicarku Belindu Bencic u dva seta, pokazavši sjajnu formu i mentalnu stabilnost. &quot;Ponosna sam na svoj tim i na način na koji sam igrala cijeli tjedan&quot;, izjavila je Vekić nakon meča. Ovo je njezin peti WTA naslov u karijeri i odlična najava pred Wimbledon koji slijedi za dva tjedna.\r\n\r\nDonna Vekić ostvarila je jednu od najvećih pobjeda u karijeri osvajanjem prestižnog WTA turnira u Berlinu. U finalnom meču svladala je Švicarku Belindu Bencic u dva seta, pokazavši sjajnu formu i mentalnu stabilnost. &quot;Ponosna sam na svoj tim i na način na koji sam igrala cijeli tjedan&quot;, izjavila je Vekić nakon meča. Ovo je njezin peti WTA naslov u karijeri i odlična najava pred Wimbledon koji slijedi za dva tjedna.\r\n\r\nDonna Vekić ostvarila je jednu od najvećih pobjeda u karijeri osvajanjem prestižnog WTA turnira u Berlinu. U finalnom meču svladala je Švicarku Belindu Bencic u dva seta, pokazavši sjajnu formu i mentalnu stabilnost. &quot;Ponosna sam na svoj tim i na način na koji sam igrala cijeli tjedan&quot;, izjavila je Vekić nakon meča. Ovo je njezin peti WTA naslov u karijeri i odlična najava pred Wimbledon koji slijedi za dva tjedna.\r\n\r\n\r\n\r\n', 'sport', 'donna-vekic-453152421_899370345552785_1641218640831784394_n.jpeg', 'Da'),
(15, 'Rangers i Vitória Guimarães vode bitku za hrvatskog stopera iz Osijeka', 'Rangers i Vitória Guimarães vode bitku za hrvatskog stopera iz Osijeka', 'Luka Jelenić, 25-godišnji branič NK Osijeka, postao je vruća roba na europskom nogometnom tržištu. Prema izvještajima iz hrvatskih i britanskih medija, škotski Rangers ozbiljno razmatra mogućnost njegova dovođenja, a u utrci se istovremeno nalazi i Vitória Guimarães iz Portugala.\r\n\r\nJelenić je protekle sezone odigrao 40 utakmica za Osijek i zabilježio nekoliko ključnih nastupa, istaknuvši se pouzdanošću u obrani i izvanrednim zračnim duelima. Osijek je igrača doveo iz Varaždina prije dvije sezone za oko 800 tisuća eura, a sada ga procjenjuju na gotovo trostruko veću vrijednost. Prema neslužbenim informacijama, zainteresirani klubovi spremni su ponuditi i do 2,5 milijuna eura za braniča koji se nalazi i na širem popisu izbornika hrvatske reprezentacije.\r\n\r\nSportski direktor Osijeka izjavio je da klub neće žuriti s odlukom, ali da su otvoreni za razgovore. „Ako Luka ode, želimo da to bude transfer koji će biti dobar i za njega i za klub. On je zaslužio korak naprijed,“ poručio je. Pregovori bi se mogli intenzivirati tijekom srpnja, nakon povratka momčadi s priprema.', 'sport', '0000030058.jpg', 'Da'),
(16, 'Novak Đoković: “Zlato u Los Angelesu 2028. je moj glavni cilj”', 'Novak Đoković: “Zlato u Los Angelesu 2028. je moj glavni cilj”', 'Nakon osvajanja zlatne medalje na Olimpijskim igrama u Parizu 2024., Novak Đoković otvoreno je izjavio kako mu je glavni motiv i sportski cilj do kraja karijere — obrana tog zlata u Los Angelesu 2028. godine. Bit će to Igre na kojima će srpski tenisač imati 41 godinu, no, kako kaže, motivacije mu ne manjka.\r\n\r\nU razgovoru za Olympics.com s bivšim nogometnim izbornikom Slavenom Bilićem, Đoković je otkrio da olimpijsko zlato ima posebno mjesto u njegovom srcu. “Osvojiti zlato za svoju zemlju bilo je nešto što sam dugo sanjao. To je drugačije od Grand Slamova. U tom trenutku ne igrate samo za sebe, već i za cijelu naciju”, rekao je Đoković.\r\n\r\nĐoković je 2024. završio tzv. &quot;Zlatni Slam&quot;, postavši jedan od rijetkih tenisača u povijesti koji je osvojio sve najveće titule u karijeri — četiri Grand Slama, olimpijsko zlato, ATP Finale, Davis Cup i sve Masters 1000 turnire. Obrana naslova u Los Angelesu bila bi povijesni pothvat: samo je Britanac Andy Murray do sada uspio obraniti olimpijsko zlato u singlu (London 2012. i Rio 2016.).\r\n\r\nIako je u kasnoj fazi karijere, Đoković trenutačno nema ozbiljnijih ozljeda i kaže da će prilagoditi raspored kako bi u Los Angeles stigao u najboljoj formi. “Još imam goriva u teniskom motoru. Igram jer volim ovaj sport, ali i zato što vjerujem da još mogu pobjeđivati”, zaključio je.', 'sport', 'skysports-novak-djokovic-olympics_6647326.jpg', 'Da'),
(17, 'WWDC 2025: iOS 26 dobiva “Liquid Glass” dizajn i jači Apple Intelligence', 'Na WWDC-u 9. lipnja Apple je otkrio vizualni redizajn interfejsa, značajna AI poboljšanja te proširene mogućnosti za iPad i Mac.', 'Appleova WWDC konferencija 9.–13. lipnja donijela je najveći vizualni redizajn još od iOS 7: prelazak na „Liquid Glass“ dizajn spaja estetiku na iPhoneu, iPadu i Macu. Uz to, Apple Intelligence dobiva poboljšanu vizualnu inteligenciju i naprednije alate za dopisivanje \r\ntechradar.com\r\n.\r\n\r\niPadOS 26 donosi sofisticiranije višeprozorstvo i bolji AV toolkit, čime Apple cilja učiniti iPad konkurentnijim radnim mašinama. macOS Tahoe uvodi poboljšanu Spotlight pretragu i Continuity opcije. watchOS 12 donosi Workout Buddy, a visionOS i tvOS kompatibilnost s PlayStation VR kontrolerima \r\ntechradar.com\r\n. Apple razvojne verzije zatvara tijekom ljeta, s javnim objavama krajem godine.\r\n\r\nAppleova WWDC konferencija 9.–13. lipnja donijela je najveći vizualni redizajn još od iOS 7: prelazak na „Liquid Glass“ dizajn spaja estetiku na iPhoneu, iPadu i Macu. Uz to, Apple Intelligence dobiva poboljšanu vizualnu inteligenciju i naprednije alate za dopisivanje \r\ntechradar.com\r\n.\r\n\r\niPadOS 26 donosi sofisticiranije višeprozorstvo i bolji AV toolkit, čime Apple cilja učiniti iPad konkurentnijim radnim mašinama. macOS Tahoe uvodi poboljšanu Spotlight pretragu i Continuity opcije. watchOS 12 donosi Workout Buddy, a visionOS i tvOS kompatibilnost s PlayStation VR kontrolerima \r\ntechradar.com\r\n. Apple razvojne verzije zatvara tijekom ljeta, s javnim objavama krajem godine.', 'tehnologija', 'Tech-feature-images285.jpg', 'Da'),
(18, 'Android 16 dostupan za Pixel – nove funkcionalnosti za obavijesti i multitasking', ' Google je konačno objavio stabilnu verziju Androida 16 za Pixel uređaje, s real‑time notifikacijama, sigurnošću za slušna pomagala i podrškom za foldable multitasking.', ' Google je konačno objavio stabilnu verziju Androida 16 za Pixel uređaje, s real‑time notifikacijama, sigurnošću za slušna pomagala i podrškom za foldable multitasking.\r\n\r\nAndroid 16 je ovaj mjesec stigao na Google Pixel pametne telefone. Donosi real‑time obavijesti — korisne za praćenje dostave ili usluga uživo – te LE Audio podršku za slušna pomagala. Novi sigurnosni paket “Advanced Protection” štiti od lažnih aplikacija i spam poziva \r\nandroidcentral.com\r\n.\r\n\r\nZa korisnike preklopnih uređaja, Android 16 uvodi Desktop Windowing – mogućnost postavljanja više aktivnih prozora, slično desktop iskustvu. Također, Google je predstavio inteligentne AI kamere za nadolazeći Galaxy Z Fold 7, a procureli su i detalji novog Galaxy Watch 8 sata \r\nandroidcentral.com\r\n. Dodatno, tijekom prošlog tjedna dogodili su se značajni prekidi u ChatGPT i Googleovim servisima, što je naglasilo značaj stabilnosti i AI otpornosti\r\n\r\nAndroid 16 je ovaj mjesec stigao na Google Pixel pametne telefone. Donosi real‑time obavijesti — korisne za praćenje dostave ili usluga uživo – te LE Audio podršku za slušna pomagala. Novi sigurnosni paket “Advanced Protection” štiti od lažnih aplikacija i spam poziva \r\nandroidcentral.com\r\n.\r\n\r\nZa korisnike preklopnih uređaja, Android 16 uvodi Desktop Windowing – mogućnost postavljanja više aktivnih prozora, slično desktop iskustvu. Također, Google je predstavio inteligentne AI kamere za nadolazeći Galaxy Z Fold 7, a procureli su i detalji novog Galaxy Watch 8 sata \r\nandroidcentral.com\r\n. Dodatno, tijekom prošlog tjedna dogodili su se značajni prekidi u ChatGPT i Googleovim servisima, što je naglasilo značaj stabilnosti i AI otpornosti\r\n\r\nAndroid 16 je ovaj mjesec stigao na Google Pixel pametne telefone. Donosi real‑time obavijesti — korisne za praćenje dostave ili usluga uživo – te LE Audio podršku za slušna pomagala. Novi sigurnosni paket “Advanced Protection” štiti od lažnih aplikacija i spam poziva \r\nandroidcentral.com\r\n.\r\n\r\nZa korisnike preklopnih uređaja, Android 16 uvodi Desktop Windowing – mogućnost postavljanja više aktivnih prozora, slično desktop iskustvu. Također, Google je predstavio inteligentne AI kamere za nadolazeći Galaxy Z Fold 7, a procureli su i detalji novog Galaxy Watch 8 sata \r\nandroidcentral.com\r\n. Dodatno, tijekom prošlog tjedna dogodili su se značajni prekidi u ChatGPT i Googleovim servisima, što je naglasilo značaj stabilnosti i AI otpornosti\r\n', 'tehnologija', 'Android-1020x570.jpg', 'Da'),
(20, 'Jeleni trče oko šume', 'Snimka jelena koji trče oko šume', 'Snimka jelena koji trče oko šume. Snimka jelena koji trče oko šume. Snimka jelena koji trče oko šume.\r\nSnimka jelena koji trče oko šume. Snimka jelena koji trče oko šume. Snimka jelena koji trče oko šume.\r\n\r\nSnimka jelena koji trče oko šume. Snimka jelena koji trče oko šume. Snimka jelena koji trče oko šume.\r\nSnimka jelena koji trče oko šume. Snimka jelena koji trče oko šume. Snimka jelena koji trče oko šume.\r\nSnimka jelena koji trče oko šume. Snimka jelena koji trče oko šume. Snimka jelena koji trče oko šume.\r\nSnimka jelena koji trče oko šume. Snimka jelena koji trče oko šume. Snimka jelena koji trče oko šume.\r\n\r\nSnimka jelena koji trče oko šume. Snimka jelena koji trče oko šume. Snimka jelena koji trče oko šume.\r\n\r\n', 'sport', 'fallow-9620489_1280.jpg', 'Ne'),
(21, 'Android 16 konačno dostupan: Donosi multitasking za preklopne uređaje i sigurnosna poboljšanja', 'Google je objavio stabilnu verziju Androida 16 za Pixel uređaje. Novi operativni sustav donosi napredne opcije za multitasking, real-time obavijesti, sigurnost za slušna pomagala i brojne AI integracije.', 'Android 16 je nakon višemjesečnih beta testiranja službeno postao dostupan za korisnike Google Pixel uređaja. Nova verzija Androida stavlja naglasak na bolju prilagodbu korisničkom iskustvu, sigurnost i podršku za preklopne uređaje (foldables), čime Google dodatno proširuje funkcionalnosti u rastućem segmentu mobilnih uređaja.\r\n\r\nJedna od ključnih novosti je Desktop Windowing, sustav koji omogućuje korisnicima da na preklopnim telefonima (kao što su Galaxy Z Fold serije) imaju istovremeno više aktivnih prozora – slično iskustvu kao na stolnim računalima. Aplikacije se sada mogu slobodno pomicati i skalirati, čineći multitasking jednostavnijim i učinkovitijim.\r\n\r\nTakođer, Android 16 uvodi real-time notifikacije koje omogućuju prikaz ažuriranja u stvarnom vremenu — idealno za aplikacije koje prate dostavu, GPS usluge, sport ili komunikaciju uživo. Korisnicima koji koriste slušna pomagala sada je dostupna i LE Audio podrška, koja donosi bolju kvalitetu zvuka i manju potrošnju baterije.\r\n\r\nNa sigurnosnom planu, uveden je novi sustav zaštite pod nazivom Advanced Protection Mode, koji pruža dodatne slojeve obrane protiv malicioznih aplikacija, lažnih identiteta i prevara putem poziva ili poruka. Ovaj način rada posebno je koristan novinarima, aktivistima i ostalim korisnicima koji trebaju višu razinu privatnosti.\r\n\r\nAndroid 16 također poboljšava performanse uređaja zahvaljujući optimiziranom korištenju AI servisa u pozadini. Google Lens i Google Assistant dobivaju proširene mogućnosti, uključujući automatsko prepoznavanje sadržaja na ekranu te kontekstualne prijedloge radnji.\r\n\r\nSljedeći korak u implementaciji Androida 16 očekuje se u nadolazećim mjesecima, kada će proizvođači poput Samsunga, OnePlusa i Xiaomija započeti s prilagodbom sustava za svoje uređaje.\r\n\r\nZaključak:\r\nAndroid 16 jasno pokazuje Googleovu namjeru da Android pretvori u još fleksibilniju i sigurniju platformu. S posebnim naglaskom na preklopne uređaje i pametnu integraciju obavijesti i zaštite privatnosti, nova verzija pruža osjetno naprednije korisničko iskustvo.', 'tehnologija', 'Android-1020x570.jpg', 'Ne'),
(24, 'Samsung lansira Bespoke AI uređaje za dom u Indiji', 'Samsung 25. lipnja najavljuje novu liniju kućanskih uređaja iz serije Bespoke AI — hladnjaka, perilica i mikrovalnih pećnica', 'Samsung će 25. lipnja predstaviti 2025. generaciju Bespoke AI uređaja na indijskom tržištu. Novi hladnjaci, perilice i mikrovalne pećnice opremljeni su intuitivnim zaslonima, podrškom za prirodnu dvozračnu komunikaciju te integracijom u SmartThings ekosustav. Dodatnu zaštitu pruža Knox sigurnosni sloj.\r\n\r\nOsim inovacija na uređajima, Samsung uvodi i uslugu Samsung Finance+ za kupnju ovih uređaja na lakši kreditni ili obročni model. Cilj je učiniti AI uređaje pristupačnijima širem krugu korisnika, posebno u tržištima poput Indije\r\n\r\nSamsung će 25. lipnja predstaviti 2025. generaciju Bespoke AI uređaja na indijskom tržištu. Novi hladnjaci, perilice i mikrovalne pećnice opremljeni su intuitivnim zaslonima, podrškom za prirodnu dvozračnu komunikaciju te integracijom u SmartThings ekosustav. Dodatnu zaštitu pruža Knox sigurnosni sloj.\r\n\r\nOsim inovacija na uređajima, Samsung uvodi i uslugu Samsung Finance+ za kupnju ovih uređaja na lakši kreditni ili obročni model. Cilj je učiniti AI uređaje pristupačnijima širem krugu korisnika, posebno u tržištima poput Indije\r\n\r\nSamsung će 25. lipnja predstaviti 2025. generaciju Bespoke AI uređaja na indijskom tržištu. Novi hladnjaci, perilice i mikrovalne pećnice opremljeni su intuitivnim zaslonima, podrškom za prirodnu dvozračnu komunikaciju te integracijom u SmartThings ekosustav. Dodatnu zaštitu pruža Knox sigurnosni sloj.\r\n\r\nOsim inovacija na uređajima, Samsung uvodi i uslugu Samsung Finance+ za kupnju ovih uređaja na lakši kreditni ili obročni model. Cilj je učiniti AI uređaje pristupačnijima širem krugu korisnika, posebno u tržištima poput Indije', 'tehnologija', 'Samsung-smartphones.webp', 'Da');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
