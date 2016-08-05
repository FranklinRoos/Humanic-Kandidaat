-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 aug 2016 om 21:18
-- Serverversie: 5.6.24
-- PHP-versie: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kandidaten`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bedrijf`
--

CREATE TABLE IF NOT EXISTS `bedrijf` (
  `id` int(11) NOT NULL,
  `aantal_medewerkers` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `bedrijf`
--

INSERT INTO `bedrijf` (`id`, `aantal_medewerkers`) VALUES
(1, 'micro'),
(2, 'klein'),
(3, 'middelgroot'),
(4, 'groot');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(5) NOT NULL,
  `user_id` int(5) unsigned NOT NULL,
  `user_inlognaam` varchar(25) NOT NULL,
  `contact_naam` varchar(50) NOT NULL,
  `contact_email` varchar(30) NOT NULL,
  `contact_subject` varchar(60) NOT NULL,
  `contact_bericht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `functie`
--

CREATE TABLE IF NOT EXISTS `functie` (
  `functie_id` int(3) NOT NULL,
  `functie_naam` varchar(50) NOT NULL,
  `functie_omschrijving` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `functie`
--

INSERT INTO `functie` (`functie_id`, `functie_naam`, `functie_omschrijving`) VALUES
(1, 'C# developer', 'beschrijving'),
(2, '.NET developer', 'beschrijving'),
(3, 'front-end developer', 'beschrijving'),
(4, 'back-end developer', 'beschrijving'),
(5, 'Java developer', 'beschrijving'),
(6, 'project manager', 'beschrijving'),
(7, 'functioneel ontwerper', 'beschrijving'),
(8, 'test coordinator', 'beschrijving'),
(9, 'product owner', 'beschrijving'),
(10, 'business analist', 'beschrijving');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mobiliteit`
--

CREATE TABLE IF NOT EXISTS `mobiliteit` (
  `id` int(3) NOT NULL,
  `soort` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `mobiliteit`
--

INSERT INTO `mobiliteit` (`id`, `soort`) VALUES
(1, 'rijbewijs'),
(2, 'auto');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nav`
--

CREATE TABLE IF NOT EXISTS `nav` (
  `nav_id` int(2) NOT NULL,
  `nav_naam` varchar(240) NOT NULL,
  `nav_url` varchar(80) NOT NULL,
  `nav_place` enum('header','footer') NOT NULL,
  `nav_show` enum('y','n') NOT NULL,
  `nav_parent_id` int(2) NOT NULL DEFAULT '0',
  `nav_taal` enum('nl','en') NOT NULL DEFAULT 'nl',
  `nav_auth` enum('usr','admin','ptr','bos') NOT NULL DEFAULT 'usr',
  `volgorde` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `nav`
--

INSERT INTO `nav` (`nav_id`, `nav_naam`, `nav_url`, `nav_place`, `nav_show`, `nav_parent_id`, `nav_taal`, `nav_auth`, `volgorde`) VALUES
(1, '<div class="nav">Home</div>', 'index.php', 'header', 'y', 0, 'nl', 'usr', 1),
(2, 'CV-Upload', 'application/modules/humanic-portal/cv-upload.php', 'header', 'n', 0, 'nl', 'usr', 4),
(3, 'Werkgevers', 'application/modules/humanic-portal/werkgever.php', 'header', 'n', 0, 'nl', 'usr', 5),
(4, 'Contact', 'http://humanicdevelopment.com/index.html#content5-12', 'footer', 'n', 0, 'nl', 'usr', 8),
(5, 'Over ons', 'http://humanicdevelopment.com/index.html#content5-12', 'header', 'y', 0, 'nl', 'usr', 9),
(6, 'Kandidaat-Registratie', 'application/modules/humanic-portal/register.php', 'header', 'y', 0, 'nl', 'usr', 3),
(7, 'Algemene Voorwaarden', 'alv.php', 'footer', 'n', 0, 'nl', 'usr', 10),
(8, 'Disclaimer', 'disclaimer.php', 'footer', 'n', 0, 'nl', 'usr', 11),
(9, 'Privacy Beleid', 'privacy.php', 'footer', 'n', 0, 'nl', 'usr', 12),
(10, 'Kandidaat-Login', 'application/modules/humanic-portal/login.php', 'header', 'y', 0, 'nl', 'usr', 2),
(11, 'Werkgever-Registratie', 'application/modules/humanic-portal/werkgever.php', 'header', 'y', 3, 'nl', 'usr', 6),
(12, 'Werkgever-Inloggen', 'application/modules/humanic-portal/login.php', 'header', 'n', 3, 'nl', 'usr', 7),
(13, 'ADMIN', 'application/modules/admin/indexAdmin.php', 'header', 'y', 0, 'nl', 'admin', 13),
(20, '<div class=adres>Programmeurs:</div> F.Roos(franklin_roos@hotmail.com), T v Hout(blackhout@upcmail.nl), B.Kijlstra(bartkijlstra@gmail.com), S.Unal(selahattin@xs4all.nl), R.de Wit(r.dewit@outlook.com)', '', 'footer', 'n', 0, 'nl', 'usr', 18),
(21, 'Mijn Gegevens', 'application/modules/humanic-portal/kandidaat.php', 'header', 'y', 0, 'nl', 'usr', 15),
(22, '<div class=adres1><div class=adres>Adres Gegevens</div><br/><div class=adresR>H.E.J. Wenkenbachweg 123<br/>1096 AM Amsterdam Nederland</div>\r\n\r\n', '', 'footer', 'y', 0, 'nl', 'usr', 17),
(23, '<div class=adres1><div class=adres>Contact</div><br/>\r\n<div class=adresR>Email: info@Humanic.cloud<br/>\r\nTel: +31(0)852736963</div>', '', 'footer', 'y', 0, 'nl', 'usr', 18),
(24, '', '', '', '', 0, 'nl', 'usr', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `navadmin`
--

CREATE TABLE IF NOT EXISTS `navadmin` (
  `navadmin_id` int(2) NOT NULL,
  `navadmin_naam` varchar(30) NOT NULL,
  `navadmin_url` varchar(60) NOT NULL,
  `navadmin_show` enum('y','n') NOT NULL,
  `navadmin_auth` enum('ptr','admin') NOT NULL DEFAULT 'admin',
  `navadmin_volgorde` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `navadmin`
--

INSERT INTO `navadmin` (`navadmin_id`, `navadmin_naam`, `navadmin_url`, `navadmin_show`, `navadmin_auth`, `navadmin_volgorde`) VALUES
(1, 'Home', 'index.php', 'y', 'ptr', 1),
(4, 'nav', 'application/modules/nav/nav.php', 'n', 'admin', 4),
(5, 'navadmin', 'application/modules/navadmin/navadmin.php', 'n', 'admin', 5),
(6, 'Users', 'application/modules/users/user.php', 'y', 'admin', 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nav_nl`
--

CREATE TABLE IF NOT EXISTS `nav_nl` (
  `nav_nl_id` int(2) NOT NULL,
  `nav_nl_naam` varchar(80) NOT NULL,
  `nav_nl_url` varchar(80) NOT NULL,
  `nav_nl_place` enum('header','footer') NOT NULL,
  `nav_nl_show` enum('y','n') NOT NULL,
  `nav_nl_parent_id` int(2) NOT NULL,
  `nav_nl_taal` enum('nl','en') NOT NULL,
  `nav_nl_auth` enum('usr','admin','ptr') NOT NULL DEFAULT 'usr',
  `volgorde` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `online_id` int(15) NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `online_ip` varchar(16) NOT NULL DEFAULT '0.0.0.0',
  `online_locatie` varchar(2555) NOT NULL DEFAULT '''''',
  `online_tijd` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `online`
--

INSERT INTO `online` (`online_id`, `user_id`, `online_ip`, `online_locatie`, `online_tijd`) VALUES
(1, 4, '0.0.0.0', '''''', 0),
(2, 5, '0.0.0.0', '''''', 0),
(3, 5, '0.0.0.0', '''''', 0),
(4, 5, '0.0.0.0', '''''', 0),
(5, 5, '0.0.0.0', '''''', 0),
(6, 5, '0.0.0.0', '''''', 0),
(7, 5, '0.0.0.0', '''''', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(2) NOT NULL,
  `page_nav_id` int(2) NOT NULL,
  `page_content` text NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_description` varchar(100) NOT NULL,
  `page_keywords` varchar(100) NOT NULL,
  `page_show` enum('y','n') NOT NULL,
  `page_taal` enum('en','nl') NOT NULL DEFAULT 'nl'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `pages`
--

INSERT INTO `pages` (`page_id`, `page_nav_id`, `page_content`, `page_title`, `page_description`, `page_keywords`, `page_show`, `page_taal`) VALUES
(1, 1, '<div id=introtext>\r\nHumanic Development is geboren vanuit de constatering dat Nederland veel digitaal talent bezit, maar dat werkzoekend talent slecht aansluiting vindt bij de ICT werkgevers die ook zoekende zijn.\r\n\r\nHet probleem is inmiddels voor werkgevers zo schrijnend, dat nieuwe kansrijke beroepen in de ICT al snel uitmonden in moeilijk vervulbare vacatures. Hierdoor stagneert groei en stijgen kosten.\r\n\r\nHet gat in de ICT arbeidsmarkt wordt alleen maar groter, als we niet van concurreren naar innoveren gaan. De innovatie die nu wereldwijd beschikbaar is vraagt om een andere oplossing en mentaliteit van werkgevers en werknemers.\r\n\r\nHet is onze missie om dit door innovatie gedreven gat te laten verkleinen en verdwijnen!\r\n</div>', '<div id=why>WHY</div>', 'why, onstaansgeschiedenis', '', 'y', 'nl'),
(2, 2, '\r\nWil jij instappen op een van onze leerwerk trajecten met baangarantie?\r\n\r\nOnderneem nu en start jouw Talent Journey.\r\n\r\n\r\n\r\nVul onderstaand formulier in!\r\n\r\nWij nemen binnen 2 werkdagen contact met jou op.', '<h4 class=instappen>Instappen werkzoekenden!<br/>\r\nRegistreren</h4>', 'inschrijfformulier', 'werkzoekenden, inschrijven', 'y', 'nl'),
(3, 3, 'Nieuw talent nodig om de marktvraag op te vangen?\r\n\r\nVind ICT-toptalenten via onze Talent Journeys!\r\n\r\n\r\n\r\nVul onderstaand formulier in!\r\n\r\nWij nemen binnen 2 werkdagen contact op.', 'Instappen werkgevers!', 'werkgevers pagina', 'nieuw talent, werkgevers, banen, marktvraag', 'y', 'nl'),
(4, 4, '', 'CONTACT FORM', 'contact formulier', '', 'y', 'nl'),
(6, 6, '', '<h1>Kandidaat Registratie Formulier<hr></h1>', 'kandidaat regisratie', 'kandidaat, registratie, humanicIC, c03logie', 'y', 'nl'),
(7, 7, '<h5>\r\nAlgemene Voorwaarden - neutrale versie<hr><br>\r\n\r\nInhoudsopgave:\r\n<ul>\r\n<li>Artikel   1 - Definities</li>\r\n<li>Artikel   2 - Identiteit van de ondernemer</li>\r\n<li>Artikel   3 - Toepasselijkheid</li>\r\n<li>Artikel   4 - Het aanbod</li>\r\n<li>Artikel   5 - De overeenkomst</li>\r\n<li>Artikel   6 - Herroepingsrecht</li>\r\n<li>Artikel   7 - Verplichtingen van de consument tijdens de bedenktijd</li>\r\n<li>Artikel   8 - Uitoefening van het herroepingsrecht door de consument en kosten daarvan</li>\r\n<li>Artikel   9 - Verplichtingen van de ondernemer bij herroeping</li>\r\n<li>Artikel 10 - Uitsluiting herroepingsrecht</li>\r\n<li>Artikel 11 - De prijs</li>\r\n<li>Artikel 12 - Nakoming en extra </li>\r\n<li>Artikel 13 - Levering en uitvoering</li>\r\n<li>Artikel 14 - Duurtransacties: duur, opzegging en verlenging</li>\r\n<li>Artikel 15 - Betaling</li>\r\n<li>Artikel 16 - Klachtenregeling</li>\r\n<li>Artikel 17 - Geschillen</li>\r\n<li>Artikel 18 - Aanvullende of afwijkende bepalingen</ul>\r\n\r\nArtikel 1 - Definities<hr><br>\r\nIn deze voorwaarden wordt verstaan onder:\r\n<ul>\r\n<li>1.	Aanvullende overeenkomst: een overeenkomst waarbij de consument producten, digitale inhoud en/of diensten verwerft in verband met een overeenkomst op afstand en deze zaken, digitale inhoud en/of diensten door de ondernemer worden geleverd of door een derde partij op basis van een afspraak tussen die derde en de ondernemer;</li>\r\n<li>2.	Bedenktijd: de termijn waarbinnen de consument gebruik kan maken van zijn herroepingsrecht;</li>\r\n<li>3.	Consument: de natuurlijke persoon die niet handelt voor doeleinden die verband houden met zijn handels-, bedrijfs-, ambachts- of beroepsactiviteit;</li>\r\n<li>4.	Dag: kalenderdag;</li>\r\n<li>5.	Digitale inhoud: gegevens die in digitale vorm geproduceerd en geleverd worden;</li>\r\n<li>6.	Duurovereenkomst: een overeenkomst die strekt tot de regelmatige levering van zaken, diensten en/of digitale inhoud gedurende een bepaalde periode;</li>\r\n<li>7.	Duurzame gegevensdrager: elk hulpmiddel - waaronder ook begrepen e-mail - dat de consument of ondernemer in staat stelt om informatie die aan hem persoonlijk is gericht, op te slaan op een manier die toekomstige raadpleging of gebruik gedurende een periode die is afgestemd op het doel waarvoor de informatie is bestemd, en die ongewijzigde reproductie van de opgeslagen informatie mogelijk maakt;</li>\r\n<li>8.	Herroepingsrecht: de mogelijkheid van de consument om binnen de bedenktijd af te zien van de overeenkomst op afstand;</li>\r\n<li>9.	Ondernemer: de natuurlijke of rechtspersoon die producten, (toegang tot) digitale inhoud en/of diensten op afstand aan consumenten aanbiedt;</li>\r\n<li>10.	Overeenkomst op afstand: een overeenkomst die tussen de ondernemer en de consument wordt gesloten in het kader van een georganiseerd systeem voor verkoop op afstand van producten, digitale inhoud en/of diensten, waarbij tot en met het sluiten van de overeenkomst uitsluitend of mede gebruik gemaakt wordt van één of meer technieken voor communicatie op afstand;</li>\r\n<li>11.	Modelformulier voor herroeping: het in Bijlage I van deze voorwaarden opgenomen Europese modelformulier voor herroeping. Bijlage I hoeft niet ter beschikking te worden gesteld als de consument ter zake van zijn bestelling geen herroepingsrecht heeft;</li>\r\n<li>12.	Techniek voor communicatie op afstand: middel dat kan worden gebruikt voor het sluiten van een overeenkomst, zonder dat consument en ondernemer gelijktijdig in dezelfde ruimte hoeven te zijn samengekomen.</li>\r\n</ul>\r\nArtikel 2 - Identiteit van de ondernemer<hr><br>\r\n[Naam ondernemer] (statutaire naam, eventueel aangevuld met handelsnaam);<br>\r\n[Vestigingsadres];<br>\r\n[Bezoekadres, indien dit afwijkt van het vestigingsadres];<br>\r\nTelefoonnummer: [en tijdstip(pen) waarop de ondernemer telefonisch te bereiken is]<br>\r\nE-mailadres: [of ander aan de consument aangeboden elektronisch communicatiemiddel met dezelfde functionaliteit als e-mail]<br>\r\nKvK-nummer:<br> \r\nBtw-identificatienummer:<br><br> \r\n\r\nIndien de activiteit van de ondernemer is onderworpen aan een relevant vergunningstelsel: de<br><br>\r\ngegevens over de toezichthoudende autoriteit.\r\n\r\nIndien de ondernemer een gereglementeerd beroep uitoefent:<br>\r\n-	de beroepsvereniging of -organisatie waarbij hij is aangesloten;<br>\r\n-	de beroepstitel, de plaats in de EU of de Europese Economische Ruimte waar deze is toegekend;<br>\r\n-	een verwijzing naar de beroepsregels die in Nederland van toepassing zijn en aanwijzingen waar en hoe deze beroepsregels toegankelijk zijn.<br><br>\r\n\r\nArtikel 3 - Toepasselijkheid<hr>\r\n<ul>\r\n<li>1.	Deze algemene voorwaarden zijn van toepassing op elk aanbod van de ondernemer en op elke tot stand gekomen overeenkomst op afstand tussen ondernemer en consument.</li>\r\n<li>2.	Voordat de overeenkomst op afstand wordt gesloten, wordt de tekst van deze algemene voorwaarden aan de consument beschikbaar gesteld. Indien dit redelijkerwijs niet mogelijk is, zal de ondernemer voordat de overeenkomst op afstand wordt gesloten, aangeven op welke wijze de algemene voorwaarden bij de ondernemer zijn in te zien en dat zij op verzoek van de consument zo spoedig mogelijk kosteloos worden toegezonden.</li>\r\n<li>3.	Indien de overeenkomst op afstand elektronisch wordt gesloten, kan in afwijking van het vorige lid en voordat de overeenkomst op afstand wordt gesloten, de tekst van deze algemene voorwaarden langs elektronische weg aan de consument ter beschikking worden gesteld op zodanige wijze dat deze door de consument op een eenvoudige manier kan worden opgeslagen op een duurzame gegevensdrager. Indien dit redelijkerwijs niet mogelijk is, zal voordat de overeenkomst op afstand wordt gesloten, worden aangegeven waar van de algemene voorwaarden langs elektronische weg kan worden kennisgenomen en dat zij op verzoek van de consument langs elektronische weg of op andere wijze kosteloos zullen worden toegezonden.</li>\r\n<li>4.	Voor het geval dat naast deze algemene voorwaarden tevens specifieke product- of dienstenvoorwaarden van toepassing zijn, is het tweede en derde lid van overeenkomstige toepassing en kan de consument zich in geval van tegenstrijdige voorwaarden steeds beroepen op de toepasselijke bepaling die voor hem het meest gunstig is.</li>\r\n</ul>\r\nArtikel 4 - Het aanbod<hr>\r\n<ul>\r\n<li>1.	Indien een aanbod een beperkte geldigheidsduur heeft of onder voorwaarden geschiedt, wordt dit nadrukkelijk in het aanbod vermeld.</li>\r\n<li>2.	Het aanbod bevat een volledige en nauwkeurige omschrijving van de aangeboden producten, digitale inhoud en/of diensten. De beschrijving is voldoende gedetailleerd om een goede beoordeling van het aanbod door de consument mogelijk te maken. Als de ondernemer gebruik maakt van afbeeldingen, zijn deze een waarheidsgetrouwe weergave van de aangeboden producten, diensten en/of digitale inhoud. Kennelijke vergissingen of kennelijke fouten in het aanbod binden de ondernemer niet.</li>\r\n<li>3.	Elk aanbod bevat zodanige informatie, dat voor de consument duidelijk is wat de rechten en verplichtingen zijn, die aan de aanvaarding van het aanbod zijn verbonden.</li>\r\n</ul>\r\nArtikel 5 - De overeenkomst<hr>\r\n<ul>\r\n<li>1.	De overeenkomst komt, onder voorbehoud van het bepaalde in lid 4, tot stand op het moment van aanvaarding door de consument van het aanbod en het voldoen aan de daarbij gestelde voorwaarden.</li>\r\n<li>2.	Indien de consument het aanbod langs elektronische weg heeft aanvaard, bevestigt de ondernemer onverwijld langs elektronische weg de ontvangst van de aanvaarding van het aanbod. Zolang de ontvangst van deze aanvaarding niet door de ondernemer is bevestigd, kan de consument de overeenkomst ontbinden.</li>\r\n<li>3.	Indien de overeenkomst elektronisch tot stand komt, treft de ondernemer passende technische en organisatorische maatregelen ter beveiliging van de elektronische overdracht van data en zorgt hij voor een veilige webomgeving. Indien de consument elektronisch kan betalen, zal de ondernemer daartoe passende veiligheidsmaatregelen in acht nemen.</li>\r\n<li>4.	De ondernemer kan zich binnen wettelijke kaders - op de hoogte stellen of de consument aan zijn betalingsverplichtingen kan voldoen, alsmede van al die feiten en factoren die van belang zijn voor een verantwoord aangaan van de overeenkomst op afstand. Indien de ondernemer op grond van dit onderzoek goede gronden heeft om de overeenkomst niet aan te gaan, is hij gerechtigd gemotiveerd een bestelling of aanvraag te weigeren of aan de uitvoering bijzondere voorwaarden te verbinden.</li>\r\n<li>5.	De ondernemer zal uiterlijk bij levering van het product, de dienst of digitale inhoud aan de consument de volgende informatie, schriftelijk of op zodanige wijze dat deze door de consument op een toegankelijke manier kan worden opgeslagen op een duurzame gegevensdrager, meesturen: </li>\r\n<li>a.	het bezoekadres van de vestiging van de ondernemer waar de consument met klachten terecht kan;</li>\r\n<li>b.	de voorwaarden waaronder en de wijze waarop de consument van het herroepingsrecht gebruik kan maken, dan wel een duidelijke melding inzake het uitgesloten zijn van het herroepingsrecht;</li>\r\n<li>c.	de informatie over garanties en bestaande service na aankoop;</li>\r\n<li>d.	de prijs met inbegrip van alle belastingen van het product, dienst of digitale inhoud; voor zover van toepassing de kosten van aflevering; en de wijze van betaling, aflevering of uitvoering van de overeenkomst op afstand;</li>\r\n<li>e.	de vereisten voor opzegging van de overeenkomst indien de overeenkomst een duur heeft van meer dan één jaar of van onbepaalde duur is;</li>\r\n<li>f.	indien de consument een herroepingsrecht heeft, het modelformulier voor herroeping.</li>\r\n<li>6.	In geval van een duurtransactie is de bepaling in het vorige lid slechts van toepassing op de eerste levering.</li>\r\n</ul>\r\nArtikel 6 - Herroepingsrecht<hr><br>\r\nBij producten:<br>\r\n<ul>\r\n<li>1.	De consument kan een overeenkomst met betrekking tot de aankoop van een product gedurende een bedenktijd van minimaal 14 dagen zonder opgave van redenen ontbinden. De ondernemer mag de consument vragen naar de reden van herroeping, maar deze niet tot opgave van zijn reden(en) verplichten.</li>\r\n<li>2.	De in lid 1 genoemde bedenktijd gaat in op de dag nadat de consument, of een vooraf door de consument aangewezen derde, die niet de vervoerder is, het product heeft ontvangen, of:</li>\r\n<li>a.	als de consument in eenzelfde bestelling meerdere producten heeft besteld: de dag waarop de consument, of een door hem aangewezen derde, het laatste product heeft ontvangen. De ondernemer mag, mits hij de consument hier voorafgaand aan het bestelproces op duidelijke wijze over heeft geïnformeerd, een bestelling van meerdere producten met een verschillende levertijd weigeren.</li>\r\n<li>b.	als de levering van een product bestaat uit verschillende zendingen of onderdelen: de dag waarop de consument, of een door hem aangewezen derde, de laatste zending of het laatste onderdeel heeft ontvangen;</li>\r\n<li>c.	bij overeenkomsten voor regelmatige levering van producten gedurende een bepaalde periode: de dag waarop de consument, of een door hem aangewezen derde, het eerste product heeft ontvangen.</li>\r\n</ul>\r\nBij diensten en digitale inhoud die niet op een materiële drager is geleverd:<br>\r\n<ul>\r\n<li>3.	De consument kan een dienstenovereenkomst en een overeenkomst voor levering van digitale inhoud die niet op een materiële drager is geleverd gedurende minimaal 14 dagen zonder opgave van redenen ontbinden. De ondernemer mag de consument vragen naar de reden van herroeping, maar deze niet tot opgave van zijn reden(en) verplichten.</li>\r\n<li>4.	De in lid 3 genoemde bedenktijd gaat in op de dag die volgt op het sluiten van de overeenkomst.</li>\r\n</ul>\r\nVerlengde bedenktijd voor producten, diensten en digitale inhoud die niet op een materiële drager is geleverd bij niet informeren over herroepingsrecht:<br>\r\n<ul>\r\n<li>5.	Indien de ondernemer de consument de wettelijk verplichte informatie over het herroepingsrecht of het modelformulier voor herroeping niet heeft verstrekt, loopt de bedenktijd af twaalf maanden na het einde van de oorspronkelijke, overeenkomstig de vorige leden van dit artikel vastgestelde bedenktijd.</li>\r\n<li>6.	Indien de ondernemer de in het voorgaande lid bedoelde informatie aan de consument heeft verstrekt binnen twaalf maanden na de ingangsdatum van de oorspronkelijke bedenktijd, verstrijkt de bedenktijd 14 dagen na de dag waarop de consument die informatie heeft ontvangen.</li>\r\n</ul>\r\nArtikel 7 - Verplichtingen van de consument tijdens de bedenktijd<hr>\r\n<ul>\r\n<li>1.	Tijdens de bedenktijd zal de consument zorgvuldig omgaan met het product en de verpakking. Hij zal het product slechts uitpakken of gebruiken in de mate die nodig is om de aard, de kenmerken en de werking van het product vast te stellen. Het uitgangspunt hierbij is dat de consument het product slechts mag hanteren en inspecteren zoals hij dat in een winkel zou mogen doen.</li>\r\n<li>2.	De consument is alleen aansprakelijk voor waardevermindering van het product die het gevolg is van een manier van omgaan met het product die verder gaat dan toegestaan in lid 1.</li>\r\n<li>3.	De consument is niet aansprakelijk voor waardevermindering van het product als de ondernemer hem niet voor of bij het sluiten van de overeenkomst alle wettelijk verplichte informatie over het herroepingsrecht heeft verstrekt.</li>\r\n</ul>\r\nArtikel 8 - Uitoefening van het herroepingsrecht door de consument en kosten daarvan<hr>\r\n<ul>\r\n<li>1.	Als de consument gebruik maakt van zijn herroepingsrecht, meldt hij dit binnen de bedenktermijn door middel van het modelformulier voor herroeping of op andere ondubbelzinnige wijze aan de ondernemer.</li> \r\n<li>2.	Zo snel mogelijk, maar binnen 14 dagen vanaf de dag volgend op de in lid 1 bedoelde melding, zendt de consument het product terug, of overhandigt hij dit aan (een gemachtigde van) de ondernemer. Dit hoeft niet als de ondernemer heeft aangeboden het product zelf af te halen. De consument heeft de terugzendtermijn in elk geval in acht genomen als hij het product terugzendt voordat de bedenktijd is verstreken.</li>\r\n<li>3.	De consument zendt het product terug met alle geleverde toebehoren, indien redelijkerwijs mogelijk in originele staat en verpakking, en conform de door de ondernemer verstrekte redelijke en duidelijke instructies.</li>\r\n<li>4.	Het risico en de bewijslast voor de juiste en tijdige uitoefening van het herroepingsrecht ligt bij de consument.</li>\r\n<li>5.	De consument draagt de rechtstreekse kosten van het terugzenden van het product. Als de ondernemer niet heeft gemeld dat de consument deze kosten moet dragen of als de ondernemer aangeeft de kosten zelf te dragen, hoeft de consument de kosten voor terugzending niet te dragen.</li>\r\n<li>6.	Indien de consument herroept na eerst uitdrukkelijk te hebben verzocht dat de verrichting van de dienst of de levering van gas, water of elektriciteit die niet gereed voor verkoop zijn gemaakt in een beperkt volume of bepaalde hoeveelheid aanvangt tijdens de bedenktijd, is de consument de ondernemer een bedrag verschuldigd dat evenredig is aan dat gedeelte van de verbintenis dat door de ondernemer is nagekomen op het moment van herroeping, vergeleken met de volledige nakoming van de verbintenis.</li> \r\n<li>7.	De consument draagt geen kosten voor de uitvoering van diensten of de levering van water, gas of elektriciteit, die niet gereed voor verkoop zijn gemaakt in een beperkt volume of hoeveelheid, of tot levering van stadsverwarming, indien:</li>\r\n<li>a.	de ondernemer de consument de wettelijk verplichte informatie over het herroepingsrecht, de kostenvergoeding bij herroeping of het modelformulier voor herroeping niet heeft verstrekt, of;</li> \r\n<li>b.	de consument niet uitdrukkelijk om de aanvang van de uitvoering van de dienst of levering van gas, water, elektriciteit of stadsverwarming tijdens de bedenktijd heeft verzocht.</li>\r\n<li>8.	De consument draagt geen kosten voor de volledige of gedeeltelijke levering van niet op een materiële drager geleverde digitale inhoud, indien:</li>\r\n<li>a.	hij voorafgaand aan de levering ervan niet uitdrukkelijk heeft ingestemd met het beginnen van de nakoming van de overeenkomst voor het einde van de bedenktijd;</li>\r\n<li>b.	hij niet heeft erkend zijn herroepingsrecht te verliezen bij het verlenen van zijn toestemming; of</li>\r\n<li>c.	de ondernemer heeft nagelaten deze verklaring van de consument te bevestigen.</li>\r\n<li>9.	Als de consument gebruik maakt van zijn herroepingsrecht, worden alle aanvullende overeenkomsten van rechtswege ontbonden.</li>\r\n</ul>\r\nArtikel 9 - Verplichtingen van de ondernemer bij herroeping<hr>\r\n<ul>\r\n<li>1.	Als de ondernemer de melding van herroeping door de consument op elektronische wijze mogelijk maakt, stuurt hij na ontvangst van deze melding onverwijld een ontvangstbevestiging.</li>\r\n<li>2.	De ondernemer vergoedt alle betalingen van de consument, inclusief eventuele leveringskosten door de ondernemer in rekening gebracht voor het geretourneerde product, onverwijld doch binnen 14 dagen volgend op de dag waarop de consument hem de herroeping meldt. Tenzij de ondernemer aanbiedt het product zelf af te halen, mag hij wachten met terugbetalen tot hij het product heeft ontvangen of tot de consument aantoont dat hij het product heeft teruggezonden, naar gelang welk tijdstip eerder valt.</li> \r\n<li>3.	De ondernemer gebruikt voor terugbetaling hetzelfde betaalmiddel dat de consument heeft gebruikt, tenzij de consument instemt met een andere methode. De terugbetaling is kosteloos voor de consument.</li>\r\n<li>4.	Als de consument heeft gekozen voor een duurdere methode van levering dan de goedkoopste standaardlevering, hoeft de ondernemer de bijkomende kosten voor de duurdere methode niet terug te betalen.</li>\r\n</ul>\r\nArtikel 10 - Uitsluiting herroepingsrecht<hr>\r\nDe ondernemer kan de navolgende producten en diensten uitsluiten van het herroepingsrecht, maar alleen als de ondernemer dit duidelijk bij het aanbod, althans tijdig voor het sluiten van de overeenkomst, heeft vermeld:<br>\r\n<ul>\r\n<li>1.	Producten of diensten waarvan de prijs gebonden is aan schommelingen op de financiële markt waarop de ondernemer geen invloed heeft en die zich binnen de herroepingstermijn kunnen voordoen;</li>\r\n<li>2.	Overeenkomsten die gesloten zijn tijdens een openbare veiling. Onder een openbare veiling wordt verstaan een verkoopmethode waarbij producten, digitale inhoud en/of diensten door de ondernemer worden aangeboden aan de consument die persoonlijk aanwezig is of de mogelijkheid krijgt persoonlijk aanwezig te zijn op de veiling, onder leiding van een veilingmeester, en waarbij de succesvolle bieder verplicht is de producten, digitale inhoud en/of diensten af te nemen;</li>\r\n<li>3.	Dienstenovereenkomsten, na volledige uitvoering van de dienst, maar alleen als:</li>\r\n<li>a.	de uitvoering is begonnen met uitdrukkelijke voorafgaande instemming van de consument; en</li>\r\n<li>b.	de consument heeft verklaard dat hij zijn herroepingsrecht verliest zodra de ondernemer de overeenkomst volledig heeft uitgevoerd;</li>\r\n<li>4.	Pakketreizen als bedoeld in artikel 7:500 BW en overeenkomsten van personenvervoer;</li>\r\n<li>5.	Dienstenovereenkomsten voor terbeschikkingstelling van accommodatie, als in de overeenkomst een bepaalde datum of periode van uitvoering is voorzien en anders dan voor woondoeleinden, goederenvervoer, autoverhuurdiensten en catering;</li>\r\n<li>6.	Overeenkomsten met betrekking tot vrijetijdsbesteding, als in de overeenkomst een bepaalde datum of periode van uitvoering daarvan is voorzien;</li>\r\n<li>7.	Volgens specificaties van de consument vervaardigde producten, die niet geprefabriceerd zijn en die worden vervaardigd op basis van een individuele keuze of beslissing van de consument, of die duidelijk voor een specifieke persoon bestemd zijn;</li>\r\n<li>8.	Producten die snel bederven of een beperkte houdbaarheid hebben;</li>\r\n<li>9.	Verzegelde producten die om redenen van gezondheidsbescherming of hygiëne niet geschikt zijn om te worden teruggezonden en waarvan de verzegeling na levering is verbroken;</li>\r\n<li>10.	Producten die na levering door hun aard onherroepelijk vermengd zijn met andere producten;</li>\r\n<li>11.	Alcoholische dranken waarvan de prijs is overeengekomen bij het sluiten van de overeenkomst, maar waarvan de levering slechts kan plaatsvinden na 30 dagen, en waarvan de werkelijke waarde afhankelijk is van schommelingen van de markt waarop de ondernemer geen invloed heeft;</li>\r\n<li>12.	Verzegelde audio-, video-opnamen en computerprogrammatuur, waarvan de verzegeling na levering is verbroken;</li>\r\n<li>13.	Kranten, tijdschriften of magazines, met uitzondering van abonnementen hierop;</li>\r\n<li>14.	De levering van digitale inhoud anders dan op een materiële drager, maar alleen als:</li>\r\n<li>a.	de uitvoering is begonnen met uitdrukkelijke voorafgaande instemming van de consument; en</li>\r\n<li>b.	de consument heeft verklaard dat hij hiermee zijn herroepingsrecht verliest.</li>\r\n</ul>\r\nArtikel 11 - De prijs<hr>\r\n<ul>\r\n<li>1.	Gedurende de in het aanbod vermelde geldigheidsduur worden de prijzen van de aangeboden producten en/of diensten niet verhoogd, behoudens prijswijzigingen als gevolg van veranderingen in btw-tarieven.</li>\r\n<li>2.	In afwijking van het vorige lid kan de ondernemer producten of diensten waarvan de prijzen gebonden zijn aan schommelingen op de financiële markt en waar de ondernemer geen invloed op heeft, met variabele prijzen aanbieden. Deze gebondenheid aan schommelingen en het feit dat eventueel vermelde prijzen richtprijzen zijn, worden bij het aanbod vermeld.</li> \r\n<li>3.	Prijsverhogingen binnen 3 maanden na de totstandkoming van de overeenkomst zijn alleen toegestaan indien zij het gevolg zijn van wettelijke regelingen of bepalingen.</li>\r\n<li>4.	Prijsverhogingen vanaf 3 maanden na de totstandkoming van de overeenkomst zijn alleen toegestaan indien de ondernemer dit bedongen heeft en:</li> \r\n<li>a. deze het gevolg zijn van wettelijke regelingen of bepalingen; of</li>\r\n<li>b. de consument de bevoegdheid heeft de overeenkomst op te zeggen met ingang van de dag waarop de prijsverhoging ingaat.</li>\r\n<li>5.	De in het aanbod van producten of diensten genoemde prijzen zijn inclusief btw.</li>\r\n</ul>\r\nArtikel 12 - Nakoming overeenkomst en extra garantie<hr>\r\n<ul> \r\n<li>1.	De ondernemer staat er voor in dat de producten en/of diensten voldoen aan de overeenkomst, de in het aanbod vermelde specificaties, aan de redelijke eisen van deugdelijkheid en/of bruikbaarheid en de op de datum van de totstandkoming van de overeenkomst bestaande wettelijke bepalingen en/of overheidsvoorschriften. Indien overeengekomen staat de ondernemer er tevens voor in dat het product geschikt is voor ander dan normaal gebruik.</li>\r\n<li>2.	Een door de ondernemer, diens toeleverancier, fabrikant of importeur verstrekte extra garantie beperkt nimmer de wettelijke rechten en vorderingen die de consument op grond van de overeenkomst tegenover de ondernemer kan doen gelden indien de ondernemer is tekortgeschoten in de nakoming van zijn deel van de overeenkomst.</li>\r\n<li>3.	Onder extra garantie wordt verstaan iedere verbintenis van de ondernemer, diens toeleverancier, importeur of producent waarin deze aan de consument bepaalde rechten of vorderingen toekent die verder gaan dan waartoe deze wettelijk verplicht is in geval hij is tekortgeschoten in de nakoming van zijn deel van de overeenkomst.</li>\r\n</ul>\r\nArtikel 13 - Levering en uitvoering<hr>\r\n<ul>\r\n<li>1.	De ondernemer zal de grootst mogelijke zorgvuldigheid in acht nemen bij het in ontvangst nemen en bij de uitvoering van bestellingen van producten en bij de beoordeling van aanvragen tot verlening van diensten.</li>\r\n<li>2.	Als plaats van levering geldt het adres dat de consument aan de ondernemer kenbaar heeft gemaakt.</li>\r\n<li>3.	Met inachtneming van hetgeen hierover in artikel 4 van deze algemene voorwaarden is vermeld, zal de ondernemer geaccepteerde bestellingen met bekwame spoed doch uiterlijk binnen 30 dagen uitvoeren, tenzij een andere leveringstermijn is overeengekomen. Indien de bezorging vertraging ondervindt, of indien een bestelling niet dan wel slechts gedeeltelijk kan worden uitgevoerd, ontvangt de consument hiervan uiterlijk 30 dagen nadat hij de bestelling geplaatst heeft bericht. De consument heeft in dat geval het recht om de overeenkomst zonder kosten te ontbinden en recht op eventuele schadevergoeding.</li>\r\n<li>4.	Na ontbinding conform het vorige lid zal de ondernemer het bedrag dat de consument betaald heeft onverwijld terugbetalen.</li>\r\n<li>5.	Het risico van beschadiging en/of vermissing van producten berust bij de ondernemer tot het moment van bezorging aan de consument of een vooraf aangewezen en aan de ondernemer bekend gemaakte vertegenwoordiger, tenzij uitdrukkelijk anders is overeengekomen.</li>\r\n</ul>\r\nArtikel 14 - Duurtransacties: duur, opzegging en verlenging<hr><br>\r\nOpzegging:\r\n<ul>\r\n<li>1.	De consument kan een overeenkomst die voor onbepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, te allen tijde opzeggen met inachtneming van daartoe overeengekomen opzeggingsregels en een opzegtermijn van ten hoogste één maand.</li>\r\n<li>2.	De consument kan een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, te allen tijde tegen het einde van de bepaalde duur opzeggen met inachtneming van daartoe overeengekomen opzeggingsregels en een opzegtermijn van ten hoogste één maand.</li>\r\n<li>3.	De consument kan de in de vorige leden genoemde overeenkomsten:</li>\r\n<li>-	te allen tijde opzeggen en niet beperkt worden tot opzegging op een bepaald tijdstip of in een bepaalde periode;</li>\r\n<li>-	tenminste opzeggen op dezelfde wijze als zij door hem zijn aangegaan;</li>\r\n<li>-	altijd opzeggen met dezelfde opzegtermijn als de ondernemer voor zichzelf heeft bedongen.</li>\r\n</ul>\r\nVerlenging:<br>\r\n<ul>\r\n<li>4.	Een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, mag niet stilzwijgend worden verlengd of vernieuwd voor een bepaalde duur.</li>\r\n<li>5.	In afwijking van het vorige lid mag een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van dag- nieuws- en weekbladen en tijdschriften stilzwijgend worden verlengd voor een bepaalde duur van maximaal drie maanden, als de consument deze verlengde overeenkomst tegen het einde van de verlenging kan opzeggen met een opzegtermijn van ten hoogste één maand.</li>\r\n<li>6.	Een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten of diensten, mag alleen stilzwijgend voor onbepaalde duur worden verlengd als de consument te allen tijde mag opzeggen met een opzegtermijn van ten hoogste één maand. De opzegtermijn is ten hoogste drie maanden in geval de overeenkomst strekt tot het geregeld, maar minder dan eenmaal per maand, afleveren van dag-, nieuws- en weekbladen en tijdschriften.</li>\r\n<li>7.	Een overeenkomst met beperkte duur tot het geregeld ter kennismaking afleveren van dag-, nieuws- en weekbladen en tijdschriften (proef- of kennismakingsabonnement) wordt niet stilzwijgend voortgezet en eindigt automatisch na afloop van de proef- of kennismakingsperiode.</li>\r\n</ul>\r\nDuur:<br>\r\n8.	Als een overeenkomst een duur van meer dan een jaar heeft, mag de consument na een jaar de overeenkomst te allen tijde met een opzegtermijn van ten hoogste één maand opzeggen, tenzij de redelijkheid en billijkheid zich tegen opzegging vóór het einde van de overeengekomen duur verzetten.<br><br>\r\n\r\nArtikel 15 - Betaling<hr>\r\n<ul>\r\n<li>1.	Voor zover niet anders is bepaald in de overeenkomst of aanvullende voorwaarden, dienen de door de consument verschuldigde bedragen te worden voldaan binnen 14 dagen na het ingaan van de bedenktermijn, of bij het ontbreken van een bedenktermijn binnen 14 dagen na het sluiten van de overeenkomst. In geval van een overeenkomst tot het verlenen van een dienst, vangt deze termijn aan op de dag nadat de consument de bevestiging van de overeenkomst heeft ontvangen.</li>\r\n<li>2.	Bij de verkoop van producten aan consumenten mag de consument in algemene voorwaarden nimmer verplicht worden tot vooruitbetaling van meer dan 50%. Wanneer vooruitbetaling is bedongen, kan de consument geen enkel recht doen gelden aangaande de uitvoering van de desbetreffende bestelling of dienst(en), alvorens de bedongen vooruitbetaling heeft plaatsgevonden.</li>\r\n<li>3.	De consument heeft de plicht om onjuistheden in verstrekte of vermelde betaalgegevens onverwijld aan de ondernemer te melden.\r\n<li>4.	Indien de consument niet tijdig aan zijn betalingsverplichting(en) voldoet, is deze, nadat hij door de ondernemer is gewezen op de te late betaling en de ondernemer de consument een termijn van 14 dagen heeft gegund om alsnog aan zijn betalingsverplichtingen te voldoen, na het uitblijven van betaling binnen deze 14-dagen-termijn, over het nog verschuldigde bedrag de wettelijke rente verschuldigd en is de ondernemer gerechtigd de door hem gemaakte buitengerechtelijke incassokosten in rekening te brengen. Deze incassokosten bedragen maximaal: 15% over openstaande bedragen tot € 2.500,=; 10% over de daaropvolgende € 2.500,= en 5% over de volgende € 5.000,= met een minimum van € 40,=. De ondernemer kan ten voordele van de consument afwijken van genoemde bedragen en percentages.</li>\r\n</ul>\r\nArtikel 16 - Klachtenregeling<hr>\r\n<ul>\r\n<li>1.	De ondernemer beschikt over een voldoende bekend gemaakte klachtenprocedure en behandelt de klacht overeenkomstig deze klachtenprocedure.</li>\r\n<li>2.	Klachten over de uitvoering van de overeenkomst moeten binnen bekwame tijd nadat de consument de gebreken heeft geconstateerd, volledig en duidelijk omschreven worden ingediend bij de ondernemer.</li>\r\n<li>3.	Bij de ondernemer ingediende klachten worden binnen een termijn van 14 dagen gerekend vanaf de datum van ontvangst beantwoord. Als een klacht een voorzienbaar langere verwerkingstijd vraagt, wordt door de ondernemer binnen de termijn van 14 dagen geantwoord met een bericht van ontvangst en een indicatie wanneer de consument een meer uitvoerig antwoord kan verwachten.</li>\r\n<li>4.	De consument dient de ondernemer in ieder geval 4 weken de tijd te geven om de klacht in onderling overleg op te lossen. Na deze termijn ontstaat een geschil dat vatbaar is voor de geschillenregeling.</li>\r\n</ul><hr>\r\nArtikel 17 - Geschillen<br>\r\n1.	Op overeenkomsten tussen de ondernemer en de consument waarop deze algemene voorwaarden betrekking hebben, is uitsluitend Nederlands recht van toepassing.<br><br>\r\n\r\nArtikel 18 - Aanvullende of afwijkende bepalingen<hr><br>\r\nAanvullende dan wel van deze algemene voorwaarden afwijkende bepalingen mogen niet ten nadele van de consument zijn en dienen schriftelijk te worden vastgelegd dan wel op zodanige wijze dat deze door de consument op een toegankelijke manier kunnen worden opgeslagen op een duurzame gegevensdrager.<br>\r\n</h5>', 'Algemene Voorwaarden', 'algemene voorwaarden', 'algemene voorwaarden', 'y', 'nl'),
(8, 8, '<h5>\r\nWebsite disclaimer: cover<hr><br>\r\nSEQ Legal LLP<br>\r\n<ul>\r\n<li>1.	This template legal document was produced and published by SEQ Legal LLP.</li>\r\n<li>2.	We control the copyright in this template, and you may only use this template in accordance with the licensing provisions in our terms and conditions. Those licensing provisions include an obligation to retain the SEQ Legal credit incorporated into the template.</li>\r\n<li>3.	The current version of our terms and conditions is available at: http://www.seqlegal.com/our-terms-and-conditions.</li>\r\n<li>4.	If you would like to use this template without the SEQ Legal credit, you can purchase a licence to do so at: http://www.website-contracts.co.uk/seqlegal-licences.html</li>\r\n<li>5.	You will need to edit this template before use. Guidance notes to help you do so are set out at the end of the template. During the editing process, you should delete those guidance notes and this cover sheet. Square brackets in the body of the document indicate areas that require editorial attention. Forward slashes and "ORs" in the body of the document indicate alternative provisions. By the end of the editing process, there should be no square brackets left in the body of the document, and only one alternative from each set of alternatives should remain.</li>\r\n<li>6.	If you have any doubts about the editing or use of this template, you should seek professional legal advice.</li>\r\n<li>7.	You may be able to get free legal guidance using our public Q&A system, available at: http://www.seqlegal.com/questions.</li> \r\n<li>8.	You can request a quote for legal services (including the adaptation or review of a legal document produced from this template) using this form: http://www.seqlegal.com/request-quote.</li>\r\n</ul> \r\n\r\nWebsite disclaimer<br>\r\n1.	Introduction<hr>\r\n<ul>\r\n<li>1.1	This disclaimer shall govern your use of our website.</li>\r\n<li>1.2	By using our website, you accept this disclaimer in full; accordingly, if you disagree with this disclaimer or any part of this disclaimer, you must not use our website.</li>\r\n<li>1.3	Our website uses cookies; by using our website or agreeing to this disclaimer, you consent to our use of cookies in accordance with the terms of our [privacy and cookies policy].</li>\r\n</ul>\r\n2.	Credit<hr>\r\n<ul>\r\n<li>2.1	This document was created using a template from SEQ Legal (http://www.seqlegal.com).</li>\r\n	You must retain the above credit, unless you purchase a licence to use this document without the credit. You can purchase a licence at: http://www.website-contracts.co.uk/seqlegal-licences.html. Warning: use of this document without the credit, or without purchasing a licence, is an infringement of copyright.</li>\r\n</ul>	\r\n3.	Copyright notice<hr>\r\n<ul>\r\n<li>3.1	Copyright (c) [2015] [Pieter Spierenburg].</li>\r\n<li>3.2	Subject to the express provisions of this disclaimer:</li>\r\n<li>(a)	we, together with our licensors, own and control all the copyright and other intellectual property rights in our website and the material on our website; and</li>\r\n<li>(b)	all the copyright and other intellectual property rights in our website and the material on our website are reserved.</li>\r\n</ul>\r\n4.	Licence to use website<hr>\r\n<ul>\r\n<li>4.1	You may:</li>\r\n<li>(a)	view pages from our website in a web browser;</li>\r\n<li>(b)	download pages from our website for caching in a web browser; and</li>\r\n<li>(c)	print pages from our website,\r\n	subject to the other provisions of this disclaimer.</li>\r\n<li>4.2	Except as expressly permitted by Section 4.1 or the other provisions of this disclaimer, you must not download any material from our website or save any such material to your computer.</li>\r\n<li>4.3	You may only use our website for [your own personal and business purposes], and you must not use our website for any other purposes.</li>\r\n<li>4.4	Unless you own or control the relevant rights in the material, you must not:</li>\r\n<li>(a)	republish material from our website (including republication on another website);</li>\r\n<li>(b)	sell, rent or sub-license material from our website;</li>\r\n<li>(c)	show any material from our website in public;</li>\r\n<li>(d)	exploit material from our website for a commercial purpose; or</li>\r\n<li>(e)	redistribute material from our website.</li>\r\n<li>4.5	We reserve the right to restrict access to areas of our website, or indeed our whole website, at our discretion; you must not circumvent or bypass, or attempt to circumvent or bypass, any access restriction measures on our website.</li>\r\n</ul>\r\n5.	Acceptable use<hr>\r\n<ul>\r\n<li>5.1	You must not:</li>\r\n<li>(a)	use our website in any way or take any action that causes, or may cause, damage to the website or impairment of the performance, availability or accessibility of the website;</li>\r\n<li>(b)	use our website in any way that is unlawful, illegal, fraudulent or harmful, or in connection with any unlawful, illegal, fraudulent or harmful purpose or activity;</li>\r\n<li>(c)	use our website to copy, store, host, transmit, send, use, publish or distribute any material which consists of (or is linked to) any spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit or other malicious computer software;</li>\r\n<li>(d)	conduct any systematic or automated data collection activities (including without limitation scraping, data mining, data extraction and data harvesting) on or in relation to our website without our express written consent;</li>\r\n<li>(e)	[access or otherwise interact with our website using any robot, spider or other automated means;]</li>\r\n<li>(f)	[violate the directives set out in the robots.txt file for our website; or]</li>\r\n<li>(g)	[use data collected from our website for any direct marketing activity (including without limitation email marketing, SMS marketing, telemarketing and direct mailing).]</li>\r\n<li>5.2	You must not use data collected from our website to contact individuals, companies or other persons or entities.</li>\r\n<li>5.3	You must ensure that all the information you supply to us through our website, or in relation to our website, is [true, accurate, current, complete and non-misleading].</li>\r\n</ul>\r\n6.	Limited warranties<hr>\r\n<ul>\r\n<li>6.1	We do not warrant or represent:</li>\r\n<li>(a)	the completeness or accuracy of the information published on our website;</li>\r\n<li>(b)	that the material on the website is up to date; or</li>\r\n<li>(c)	that the website or any service on the website will remain available.</li>\r\n<li>6.2	We reserve the right to discontinue or alter any or all of our website services, and to stop publishing our website, at any time in our sole discretion without notice or explanation; and save to the extent expressly provided otherwise in this disclaimer, you will not be entitled to any compensation or other payment upon the discontinuance or alteration of any website services, or if we stop publishing the website.</li>\r\n<li>6.3	To the maximum extent permitted by applicable law and subject to Section 7.1, we exclude all representations and warranties relating to the subject matter of this disclaimer, our website and the use of our website.</li>\r\n</ul>\r\n7.	Limitations and exclusions of liability<hr>\r\n<ul>\r\n<li>7.1	Nothing in this disclaimer will:</li>\r\n<li>(a)	limit or exclude any liability for death or personal injury resulting from negligence;</li>\r\n<li>(b)	limit or exclude any liability for fraud or fraudulent misrepresentation;</li>\r\n<li>(c)	limit any liabilities in any way that is not permitted under applicable law; or</li>\r\n<li>(d)	exclude any liabilities that may not be excluded under applicable law.</li>\r\n<li>7.2	The limitations and exclusions of liability set out in this Section 7 and elsewhere in this disclaimer:</li> \r\n<li>(a)	are subject to Section 7.1; and</li>\r\n<li>(b)	govern all liabilities arising under the disclaimer or relating to the subject matter of the disclaimer, including liabilities arising in contract, in tort (including negligence) and for breach of statutory duty, except to the extent expressly provided otherwise in the disclaimer.</li>\r\n<li>7.3	To the extent that our website and the information and services on our website are provided free of charge, we will not be liable for any loss or damage of any nature.</li>\r\n<li>7.4	We will not be liable to you in respect of any losses arising out of any event or events beyond our reasonable control.</li>\r\n<li>7.5	We will not be liable to you in respect of any business losses, including (without limitation) loss of or damage to profits, income, revenue, use, production, anticipated savings, business, contracts, commercial opportunities or goodwill.</li>\r\n<li>7.6	We will not be liable to you in respect of any loss or corruption of any data, database or software.</li>\r\n<li>7.7	We will not be liable to you in respect of any special, indirect or consequential loss or damage.</li>\r\n<li>7.8	You accept that we have an interest in limiting the personal liability of our officers and employees and, having regard to that interest, you acknowledge that we are a limited liability entity; you agree that you will not bring any claim personally against our officers or employees in respect of any losses you suffer in connection with the website or this disclaimer (this will not, of course, limit or exclude the liability of the limited liability entity itself for the acts and omissions of our officers and employees).</li>\r\n</ul>\r\n8.	Variation<hr>\r\n<ul>\r\n<li>8.1	We may revise this disclaimer from time to time.</li>\r\n<li>8.2	The revised disclaimer shall apply to the use of our website from the time of publication of the revised disclaimer on the website.</li>\r\n</ul> \r\n9.	Severability<hr>\r\n<ul>\r\n<li>9.1	If a provision of this disclaimer is determined by any court or other competent authority to be unlawful and/or unenforceable, the other provisions will continue in effect.</li>\r\n<li>9.2	If any unlawful and/or unenforceable provision of this disclaimer would be lawful or enforceable if part of it were deleted, that part will be deemed to be deleted, and the rest of the provision will continue in effect. </li>\r\n<li>10.	Law and jurisdiction\r\n<li>10.1	This disclaimer shall be governed by and construed in accordance with [dutch-law].</li>\r\n<li>10.2	Any disputes relating to this disclaimer shall be subject to the [exclusive / non-exclusive] jurisdiction of the courts of [Netherlands].</li>\r\n</ul>\r\n11.	Statutory and regulatory disclosures<hr>\r\n<ul>\r\n<li>11.1	We are registered in [trade register]; you can find the online version of the register at [URL], and our registration number is [number].</li>\r\n<li>11.2	We are subject to [authorisation scheme], which is supervised by [supervisory authority].</li>\r\n<li>11.3	We are registered as [title] with [professional body] in [the Netherlands] and are subject to [rules], which can be found at [URL].</li>\r\n<li>11.4	We subscribe to [code(s) of conduct], which can be consulted electronically at [URL(s)].</li>\r\n<li>11.5	Our VAT number is [number].\r\n</ul>\r\n12.	Our details<hr>\r\n<ul>\r\n<li>12.1	This website is owned and operated by [name].</li>\r\n<li>12.2	We are registered in [Netherlands] under registration number [number], and our registered office is at [address].</li>\r\n<li>12.3	Our principal place of business is at [address].</li>\r\n<li>12.4	You can contact us by writing to the business address given above, by using our website contact form, by email to [spierenburg@law.eur.nl] or by telephone on [0611164440].</li>\r\n</ul>\r\n</h5>', 'Disclaimer', 'disclaimer', 'disclaimer', 'y', 'nl'),
(9, 9, '<h5>\r\nPrivacy Policy VOORBEELD<hr>\r\n<p> \r\n<i>Pieterspierenburg.com</i> zal de privacy van alle gebruikers van haar site waarborgen en wij zullen ten alle tijden de persoonlijke informatie die u aan ons verschaft vertrouwelijk wordt behandeld.<br> Wij zullen uw gegevens slechts gebruiken om de bestellingen zo snel en gemakkelijk mogelijk te laten verlopen.<br> Voor het overige zullen wij deze gegevens uitsluitend gebruiken met uw toestemming. Pieterspierenburg.com zal uw persoonlijke gegevens niet aan derden verkopen en zal deze uitsluitend aan derden ter beschikking stellen die zijn betrokken bij het uitvoeren van uw bestelling.<br><br> \r\n \r\nPieterspierenburg.com gebruikt de verzamelde gegevens om haar klanten de volgende diensten te leveren:\r\n<ul> \r\n<li>Als u een bestelling of offerteaanvraag plaatst, hebben we uw naam, e-mailadres, afleveradres en betaalgegevens nodig om uw bestelling uit te voeren en u van het verloop daarvan op de hoogte te houden.</li> \r\n \r\n<li>Om het winkelen en het proces van offerte aanvragen bij Pieterspierenburg.com zo aangenaam mogelijk te laten zijn, slaan wij met uw toestemming uw persoonlijke gegevens en de gegevens met betrekking tot uw bestelling of offerteaanvraag en het gebruik van onze diensten op. Hierdoor kunnen wij de website persoonlijker maken.</li>  \r\n \r\n<li> kunnen uw e-mailadres gebruiken om u informatie te verschaffen over de ontwikkeling van onze website en over onze speciale aanbiedingen en acties. Als u hier geen prijs op stelt, kunt u zich uitschrijven via onze website.</li>  \r\n \r\n<li>Indien u bij Pieterspierenburg.com een bestelling plaatst bewaren wij, indien gewenst, uw gegevens op een Secure Server. U kunt een gebruikersnaam en wachtwoord opgeven zodat uw naam en adres, telefoonnummer, e-mailadres, aflever- en betaalgegevens, zodat u deze niet bij iedere nieuwe bestelling hoeft in te vullen.</li>  \r\n \r\n<li>Gegevens over het gebruik van onze site en de feedback die we krijgen van onze bezoekers helpen ons om onze site verder te ontwikkelen en te verbeteren. Als u besluit een recensie te schrijven, kunt u zelf kiezen of u uw naam of andere persoonlijke gegevens toevoegt. We zijn benieuwd naar de meningen van onze bezoekers, maar behouden het recht bijdragen die niet aan onze sitevoorwaarden voldoen niet te publiceren.</li>  \r\n \r\n<li>Als u reageert op een actie of prijsvraag, vragen wij uw naam, adres en e-mailadres. Deze gegevens gebruiken we om de actie uit te voeren, de prijswinnaar(s) bekend te maken, en de respons op onze marketingacties te meten.</li>  \r\n </ul>\r\nPieterspierenburg.com verkoopt uw gegevens niet<br> \r\nPersoonlijke gegevens zullen nooit aan derden verkocht worden en zal deze uitsluitend aan derden ter beschikking stellen indien deze betrokken zijn bij het uitvoeren van uw bestelling. Onze werknemers en door ons ingeschakelde derden zijn verplicht om de vertrouwelijkheid van uw gegevens te respecteren.<br><br> \r\n  \r\nCookies<hr><br> \r\nCookies zijn kleine stukjes informatie die door uw browser worden opgeslagen op uw computer.<br> \r\nOnze website gebruikt deze cookies om u te herkennen bij een volgend bezoek. Deze Cookies stellen ons in staat om informatie te verzamelen over het gebruik van onze diensten en deze te verbeteren en aan te passen aan de wensen van onze bezoekers. Onze cookies geven informatie met betrekking tot persoonsidentificatie. U kunt uw browser ook zo instellen dat u tijdens het winkelen bij Pieterspierenburg.com geen cookies ontvangt.<hr><br><br> \r\n \r\nIndien u nog vragen mocht hebben over de Privacy Policy van Onze website, dan kunt u contact met ons opnemen. Onze klantenservice helpt u verder als u informatie nodig heeft over uw gegevens of als u deze wilt wijzigen. In geval wijziging van onze Privacy Policy nodig mocht zijn, dan vindt u op deze pagina altijd de meest recente informatie. \r\n\r\n</h5>', 'Privacy Beleid', 'privacy beleid', 'privacy, beleid, regels', 'y', 'nl'),
(10, 50, '', 'Administrator Panel HumanicIC', 'administrator taken', 'administrator taken, HumanicIC', 'y', 'nl'),
(11, 5, '', 'CV-UPLOAD', 'cv-upload', 'cv, upload', 'y', 'nl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `regio`
--

CREATE TABLE IF NOT EXISTS `regio` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `regio`
--

INSERT INTO `regio` (`id`, `naam`) VALUES
(1, 'Noord-Holland'),
(2, 'Zuid-Holland'),
(3, 'Zeeland'),
(4, 'Noord-Brabant'),
(5, 'Limburg'),
(6, 'Gelderland'),
(7, 'Overijssel'),
(8, 'Utrecht'),
(9, 'Flevoland'),
(10, 'Drenthe'),
(11, 'Groningen'),
(12, 'Friesland'),
(13, 'Amsterdam e.o.'),
(14, 'Rotterdam e.o.'),
(15, 'Den Haag'),
(16, 'Eindhoven e.o.'),
(17, 'Nijmegen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reis`
--

CREATE TABLE IF NOT EXISTS `reis` (
  `id` int(11) NOT NULL,
  `duur` int(2) NOT NULL,
  `afstand` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `sector_id` int(2) NOT NULL,
  `sector_naam` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `sector`
--

INSERT INTO `sector` (`sector_id`, `sector_naam`) VALUES
(1, 'ICT'),
(2, 'Zorg'),
(3, 'Industrie'),
(4, 'Retail');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(5) NOT NULL,
  `user_inlognaam` varchar(30) NOT NULL,
  `user_wachtwoord` varchar(50) NOT NULL,
  `user_authorisatie` enum('usr','admin','ptr') NOT NULL DEFAULT 'usr',
  `user_email` varchar(80) NOT NULL,
  `user_activ` enum('no','yes','','') NOT NULL DEFAULT 'no',
  `user_form-activ` enum('yes','no') NOT NULL DEFAULT 'no',
  `activ_code` varchar(50) NOT NULL,
  `vergeetcode` varchar(50) NOT NULL,
  `user_online` enum('y','n') NOT NULL DEFAULT 'n',
  `datum_gezien` date NOT NULL,
  `tijdstip_gezien` time NOT NULL,
  `user_sinds` date NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `tussenvoegsel` varchar(10) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `straat` varchar(100) NOT NULL,
  `huisnummer` varchar(20) NOT NULL,
  `toevoeging` varchar(10) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `plaats` varchar(50) NOT NULL,
  `telefoon` varchar(11) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `cv` varchar(30) NOT NULL,
  `geboortedatum` date NOT NULL,
  `salaris` int(5) NOT NULL,
  `uitkering` varchar(10) NOT NULL,
  `uitkering_geldig_tot` date NOT NULL,
  `user_sector` enum('ICT','ZORG','INDUSTRIR','RETAIL') NOT NULL DEFAULT 'ICT',
  `user_bedrijf_grootte` varchar(10) NOT NULL,
  `rijbewijs` enum('ja','nee') NOT NULL,
  `auto` enum('ja','nee') NOT NULL,
  `reisafstand` int(3) NOT NULL,
  `opmerking` text NOT NULL,
  `linkedin` varchar(80) NOT NULL,
  `twitter` varchar(80) NOT NULL,
  `facebook` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `user_inlognaam`, `user_wachtwoord`, `user_authorisatie`, `user_email`, `user_activ`, `user_form-activ`, `activ_code`, `vergeetcode`, `user_online`, `datum_gezien`, `tijdstip_gezien`, `user_sinds`, `achternaam`, `tussenvoegsel`, `voornaam`, `straat`, `huisnummer`, `toevoeging`, `postcode`, `plaats`, `telefoon`, `foto`, `cv`, `geboortedatum`, `salaris`, `uitkering`, `uitkering_geldig_tot`, `user_sector`, `user_bedrijf_grootte`, `rijbewijs`, `auto`, `reisafstand`, `opmerking`, `linkedin`, `twitter`, `facebook`) VALUES
(2, 'blackliq', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'blachout@upcmail.nl', 'yes', 'no', '', '', 'n', '2016-08-04', '13:44:16', '2016-07-01', 'Hout', 'van', 'Thijs', 'W.v.Hembyzestraat', '17', '', '1067PM', 'Amsterdam', '0615579992', 'blackliq.jpg', '', '1978-03-15', 3500, 'WW', '2017-08-25', 'ICT', '>500', 'ja', 'ja', 30, 'what the hell is going on																																																																																							', 'https://nl.linkedin.com/in/thijsvanhout/nl', 'https://twitter.com/', 'https://www.facebook.com/'),
(3, 'Unal', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'selahattin@xs4all.nl', 'yes', 'no', '', '', 'n', '2016-08-04', '20:54:29', '2016-07-05', 'Unal', '', 'Selahattin', 'Hortensiastraat', '18', '5hoog', '1032CJ', 'Amsterdam', '062960228', '57a38fb579cc0.jpg', '57a30b5ad0736.pdf', '1960-05-16', 3000, 'WW', '2017-08-30', 'ICT', '50-100', 'ja', 'ja', 25, 'Het is tijd om te gaan zuipen																																																																																																																																																			', 'https://nl.linkedin.com/in/selahattinunal/nl', 'https://twitter.com/', 'https://www.facebook.com/'),
(5, 'Franklin', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'frankieboy37@hotmail.com', 'yes', 'no', '', '', 'n', '2016-08-02', '12:35:55', '2016-07-06', 'Roos', '', 'Franklin', 'Watermolenstraat', '98', '', '1098bn', 'Amsterdam', '0629359610', 'Franklin.jpg', 'CV_Roos.pdf', '1973-06-15', 3200, 'WW', '2017-08-29', 'ICT', '100-500', 'ja', 'ja', 25, '	het is tijd om uit eten te gaan													', 'https://nl.linkedin.com/in/franklin-roos', 'https://twitter.com/', 'https://www.facebook.com/'),
(6, 'balboa', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'balboadesus@hotmail.com', 'yes', 'no', '', '', 'n', '2016-08-04', '21:08:32', '2016-07-12', 'Dagama', 'Desus', 'Balboa', 'Columbusstraat', '28', '3hoog', '1778BT', 'schagen', '0206194483', '57a392cc69699.jpg', '57a09ca733be2.pdf', '1975-11-25', 3200, 'WW', '2017-08-25', 'ICT', '1-10', 'ja', 'ja', 35, '	Blablablabla																																														', 'https://nl.linkedin.com/in/selahattinunal/nl', 'https://twitter.com/', 'https://www.facebook.com/'),
(7, 'bart', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'bartkijlstragmail.com', 'yes', 'no', '', '', 'n', '2016-08-02', '12:34:54', '2016-08-01', 'Kijsltra', '', 'Bart', 'Muiderpoortstation', '35', '3hoog', '1092vw', 'Amsterdam', '0619874146', 'bart.jpg', '', '1958-08-10', 3400, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 35, '		', 'https://nl.linkedin.com/in/bartkijlstra', '', ''),
(8, 'Ron', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'rdewit599@gmail.com', 'yes', 'no', '', '', 'n', '2016-08-04', '20:57:05', '2016-07-13', 'Wit', 'de', 'Ron', 'Hupsakeestraat', '525', '7hoog', '1107ZO', 'Amsterdam', '0645845457', '57a39063b4cd3.jpg', '57a39057db3ff.txt', '1974-04-14', 3300, 'WW', '2017-02-28', 'ICT', '', 'nee', 'nee', 15, '	Ik wil koffie				', '', '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_bedrijf`
--

CREATE TABLE IF NOT EXISTS `user_bedrijf` (
  `id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `bedrijf_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user_bedrijf`
--

INSERT INTO `user_bedrijf` (`id`, `user_id`, `bedrijf_id`) VALUES
(1, 3, 1),
(2, 2, 4),
(4, 0, 4),
(5, 7, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_functie`
--

CREATE TABLE IF NOT EXISTS `user_functie` (
  `user_functie_id` int(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `functie_id` int(3) NOT NULL,
  `ervaring` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_functie`
--

INSERT INTO `user_functie` (`user_functie_id`, `user_id`, `functie_id`, `ervaring`) VALUES
(1, 1, 5, 3),
(2, 1, 3, 5),
(3, 2, 1, 0),
(4, 2, 2, 0),
(5, 2, 9, 0),
(6, 3, 4, 0),
(7, 3, 5, 0),
(8, 3, 8, 0),
(9, 2, 5, 0),
(10, 5, 2, 3),
(78, 5, 4, 4),
(102, 6, 1, 0),
(103, 6, 4, 0),
(104, 7, 1, 0),
(105, 7, 4, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_regio`
--

CREATE TABLE IF NOT EXISTS `user_regio` (
  `user_regio_id` int(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `regio_id` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_regio`
--

INSERT INTO `user_regio` (`user_regio_id`, `user_id`, `regio_id`) VALUES
(1, 3, 6),
(2, 3, 10),
(3, 5, 13),
(4, 5, 8),
(5, 3, 13),
(6, 3, 8),
(7, 5, 13),
(8, 5, 8),
(9, 5, 13),
(10, 5, 8),
(11, 5, 13),
(12, 5, 8),
(13, 5, 13),
(14, 5, 8),
(15, 5, 13),
(16, 5, 8),
(17, 5, 13),
(18, 5, 8),
(19, 5, 13),
(20, 5, 8),
(21, 5, 13),
(22, 5, 8),
(23, 6, 13),
(24, 6, 8),
(25, 6, 13),
(26, 6, 8),
(27, 6, 13),
(28, 6, 8),
(29, 6, 13),
(30, 6, 8),
(31, 6, 13),
(32, 6, 8),
(33, 6, 13),
(34, 6, 8),
(35, 6, 13),
(36, 6, 8),
(37, 6, 13),
(38, 6, 8),
(39, 6, 13),
(40, 6, 8),
(41, 6, 13),
(42, 6, 8),
(43, 2, 13),
(44, 2, 8),
(45, 2, 13),
(46, 2, 8),
(47, 2, 13),
(48, 2, 8),
(49, 2, 1),
(50, 2, 5),
(52, 0, 8),
(54, 0, 13),
(55, 5, 13),
(56, 5, 8),
(57, 5, 13),
(58, 5, 8),
(59, 5, 13),
(60, 5, 8),
(61, 5, 13),
(62, 5, 8),
(63, 5, 13),
(64, 5, 8),
(65, 5, 13),
(66, 5, 8),
(67, 5, 13),
(68, 5, 8),
(69, 5, 13),
(70, 5, 8),
(71, 5, 13),
(72, 5, 8),
(73, 5, 13),
(74, 5, 8),
(75, 5, 13),
(76, 5, 8),
(77, 5, 13),
(78, 5, 8),
(79, 0, 1),
(80, 0, 5),
(81, 7, 1),
(82, 7, 13);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_reis`
--

CREATE TABLE IF NOT EXISTS `user_reis` (
  `id` int(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `reis_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_sector`
--

CREATE TABLE IF NOT EXISTS `user_sector` (
  `user_sector_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `sector_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_sector`
--

INSERT INTO `user_sector` (`user_sector_id`, `user_id`, `sector_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 1, 1),
(6, 1, 4),
(7, 3, 1),
(8, 3, 4),
(9, 5, 1),
(10, 6, 1),
(11, 6, 4),
(12, 0, 1),
(13, 0, 4),
(14, 0, 2),
(15, 0, 3),
(16, 7, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_voorzieningen`
--

CREATE TABLE IF NOT EXISTS `user_voorzieningen` (
  `id` int(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `voorzieningen_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `voorzieningen`
--

CREATE TABLE IF NOT EXISTS `voorzieningen` (
  `id` int(3) NOT NULL,
  `voorzieningen` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bedrijf`
--
ALTER TABLE `bedrijf`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexen voor tabel `functie`
--
ALTER TABLE `functie`
  ADD PRIMARY KEY (`functie_id`);

--
-- Indexen voor tabel `mobiliteit`
--
ALTER TABLE `mobiliteit`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`nav_id`);

--
-- Indexen voor tabel `navadmin`
--
ALTER TABLE `navadmin`
  ADD PRIMARY KEY (`navadmin_id`);

--
-- Indexen voor tabel `nav_nl`
--
ALTER TABLE `nav_nl`
  ADD PRIMARY KEY (`nav_nl_id`);

--
-- Indexen voor tabel `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`online_id`);

--
-- Indexen voor tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexen voor tabel `regio`
--
ALTER TABLE `regio`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reis`
--
ALTER TABLE `reis`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexen voor tabel `user_bedrijf`
--
ALTER TABLE `user_bedrijf`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user_functie`
--
ALTER TABLE `user_functie`
  ADD PRIMARY KEY (`user_functie_id`);

--
-- Indexen voor tabel `user_regio`
--
ALTER TABLE `user_regio`
  ADD PRIMARY KEY (`user_regio_id`);

--
-- Indexen voor tabel `user_reis`
--
ALTER TABLE `user_reis`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user_sector`
--
ALTER TABLE `user_sector`
  ADD PRIMARY KEY (`user_sector_id`);

--
-- Indexen voor tabel `user_voorzieningen`
--
ALTER TABLE `user_voorzieningen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `voorzieningen`
--
ALTER TABLE `voorzieningen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bedrijf`
--
ALTER TABLE `bedrijf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `functie`
--
ALTER TABLE `functie`
  MODIFY `functie_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `mobiliteit`
--
ALTER TABLE `mobiliteit`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `nav`
--
ALTER TABLE `nav`
  MODIFY `nav_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT voor een tabel `navadmin`
--
ALTER TABLE `navadmin`
  MODIFY `navadmin_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `nav_nl`
--
ALTER TABLE `nav_nl`
  MODIFY `nav_nl_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `online`
--
ALTER TABLE `online`
  MODIFY `online_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT voor een tabel `regio`
--
ALTER TABLE `regio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `reis`
--
ALTER TABLE `reis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `user_bedrijf`
--
ALTER TABLE `user_bedrijf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `user_functie`
--
ALTER TABLE `user_functie`
  MODIFY `user_functie_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT voor een tabel `user_regio`
--
ALTER TABLE `user_regio`
  MODIFY `user_regio_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT voor een tabel `user_reis`
--
ALTER TABLE `user_reis`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `user_sector`
--
ALTER TABLE `user_sector`
  MODIFY `user_sector_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT voor een tabel `user_voorzieningen`
--
ALTER TABLE `user_voorzieningen`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `voorzieningen`
--
ALTER TABLE `voorzieningen`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
