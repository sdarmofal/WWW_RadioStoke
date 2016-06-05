<?php

// Check for user gender
$he = ($userdata['user_gender'] != 2) ? true : false;

// Categories
$lang['Acattitle'] = 'Dodaj kategoriê'; 
$lang['Ecattitle'] = 'Edytuj kategoriê'; 
$lang['Dcattitle'] = 'Usuñ kategoriê'; 
$lang['Rcattitle'] = 'Przemianuj kategoriê'; 
$lang['Catexplain'] = 'Mo¿esz u¿yæ tego menad¿era do dodawania, edytowania i przemianowywania kategorii. ¯eby dodaæ plik, musisz stworzyæ przynajmniej jedn± kategoriê.'; 
$lang['Rcatexplain'] = 'Mo¿esz przemianowaæ kategoriê, aby by³a pokazywana w innym miejscu na stronie.';
$lang['Catadded'] = 'Kategoria dodana';
$lang['Catname'] = 'Nazwa kategorii';
$lang['Catnameinfo'] = 'To bêdzie nazwa kategorii.';
$lang['Catdesc'] = 'Opis kategorii';
$lang['Catdescinfo'] = 'To jest opis kategorii';
$lang['Catparent'] = 'G³ówny katalog';
$lang['Catparentinfo'] = 'Je¶li chcesz aby ta kategoria by³a podkategori± innej, wybierz g³ówn± kategoriê, w której bedzie utworzona.';
$lang['None'] = 'Brak';
$lang['Catedited'] = 'Kategoria zmieniona';
$lang['Delfiles'] = 'Usun±æ pliki z tej kategorii?';
$lang['Catsdeleted'] = 'Kategoria usuniêta';
$lang['Cdelerror'] = 'Nie wybra³' .  (($he) ? 'e' : 'a') . '¶ kategorii do usuniêcia';
$lang['Rcatdone'] = 'Kategoria przemianowana';

// Configuration
$lang['Settingstitle'] = 'Konfiguracja downloadu';
$lang['Settingsexplain'] = 'W tym miejscu mo¿esz zmieniæ g³ówne ustawienia downloadu.';
$lang['Dbname'] = 'Nazwa bazy danych';
$lang['Dbnameinfo'] = 'Nazwa bazy danych \'Download Index\'';
$lang['Sitename'] = 'Nazwa strony';
$lang['Sitenameinfo'] = 'Nazwa twojej strony \'Home\'';
$lang['Dburl'] = 'Adres bazy danych';
$lang['Dburlinfo'] = 'Adres bazy danych, do miejsca w którym jest ona zainstalowana';
$lang['Hpurl'] = 'Adres strony g³ównej';
$lang['Hpurlinfo'] = 'Adres URL do twojego portalu lub strony';
$lang['Topnum'] = 'Toplista';
$lang['Topnuminfo'] = 'Ile pokazywaæ plików w topliscie';
$lang['Nfdays'] = 'Data dla nowych plików';
$lang['Nfdaysinfo'] = 'Ile dni w stecz bêdzie okre¶la³o nowe pliki';
$lang['Showva'] = 'Poka¿ wszystkie pliki';
$lang['Showvainfo'] = 'Czy pokazywaæ widok wszystkich plików?';
$lang['Showss'] = 'Poka¿ screenshot';
$lang['Showssinfo'] = 'Wy¶wietlaæ screenshot?';
$lang['Dbdl'] = 'Wy³±cz Download';
$lang['Dbdlinfo'] = 'Wy³±cza download dla u¿ytkowników';
$lang['Com_settings'] = 'Ustawienia komentarzy';
$lang['Com_allowh'] = 'Zezwól na HTML';
$lang['Com_allowb'] = 'Zezwól na BBCode';
$lang['Com_allows'] = 'Zezwól na U¶mieszki';
$lang['Com_allowl'] = 'Zezwól na linki';
$lang['Com_messagel'] = 'Informacja "No Links"';
$lang['Com_messagel_info'] = 'Informacja wy¶wietlana, jesli nie ma zezwolenia na linki';
$lang['Com_allowi'] = 'Zezwól na obrazki';
$lang['Com_messagei'] = 'Informacja "No Images"';
$lang['Com_messagei_info'] = 'Informacja wy¶wietlana, jesli nie ma zezwolenia na obrazki';
$lang['Max_char'] = 'Maksymalna ilo¶æ znaków';
$lang['Max_char_info'] = 'Maksymalna ilo¶æ znaków dla komentarzy';
$lang['Settings_changed'] = 'Ustawienia zaktualizowane';
$lang['l_dlinked'] = 'Zabezpieczenie ¶ci±gania z innych adresów';
$lang['l_dlinked_e'] = 'Zabezpiecza przed ¶ci±ganiem plików w menu download bezpo¶rednio z innych adresow';

// Custom Field
$lang['Afieldtitle'] = 'Dodaj Dodatkowe pole dla pliku';
$lang['Efieldtitle'] = 'Edytuj';
$lang['Dfieldtitle'] = 'Usuñ';
$lang['Fieldexplain'] = 'W tym miejscu mo¿esz dodaæ dodatkowe pole dla plików, np: \'Data\' lub \'Rozmiar\'';
$lang['Fieldname'] = 'Nazwa';
$lang['Fieldnameinfo'] = '';
$lang['Fielddesc'] = 'Opis';
$lang['Fielddescinfo'] = '';
$lang['Fieldadded'] = 'Dodatkowe pole dodane';
$lang['Fieldedited'] = 'Dodatkowe pole zmienione';
$lang['Dfielderror'] = 'Nie wybra³' .  (($he) ? 'e' : 'a') . '¶ dodatkowych pól do skasowania';
$lang['Fieldsdel'] = 'Dodatkowe pole usuniête';

// File
$lang['Afiletitle'] = 'Dodaj plik';
$lang['Efiletitle'] = 'Edytuj plik';
$lang['Dfiletitle'] = 'Usuñ plik';
$lang['Fileexplain'] = 'W tym miejscu, mo¿esz dodawaæ, edytowaæ i kasowaæ pliki';
$lang['Upload'] = 'Wyslij plik';
$lang['Uploadinfo'] = 'Wy¶lij plik';
$lang['Uploaderror'] = 'Nazwa pliku istnieje, zmieñ nazwê i spróbuj jeszcze raz';
$lang['Uploaddone'] = 'Plik zapisany, adres dla pliku to';
$lang['Uploaddone2'] = 'Kliknij tutaj aby umie¶ciæ adres pliku w formularzu';
$lang['Upload_do_done'] = 'Plik zapisany';
$lang['Upload_do_not'] = 'Plik nie zapisany';
$lang['Upload_do_exist'] = 'Plik istnieje';
$lang['Filename'] = 'Nazwa pliku';
$lang['Filenameinfo'] = 'Nazwa dla twojego pliku';
$lang['Filesd'] = 'Krótki opis';
$lang['Filesdinfo'] = '';
$lang['Fileld'] = 'D³ugi opis';
$lang['Fileldinfo'] = '';
$lang['Filecreator'] = 'Autor';
$lang['Filecreatorinfo'] = '';
$lang['Fileversion'] = 'Wersja';
$lang['Fileversioninfo'] = '';
$lang['Filess'] = 'Adres screenshotu';
$lang['Filessinfo'] = '';
$lang['Filessupload'] = 'Wy¶lij screenshot na serwer';
$lang['Filedocs'] = 'Adres dokumentacji';
$lang['Filedocsinfo'] = '';
$lang['Fileurl'] = 'Adres pliku';
$lang['Fileurlinfo'] = 'Wpisz adres, lub ';
$lang['Fileurlupload'] = 'Wyslij plik na serwer';
$lang['Filepi'] = 'Ikona dla pliku';
$lang['Filepiinfo'] = '';
$lang['Filecat'] = 'Kategoria';
$lang['Filecatinfo'] = '';
$lang['Filelicense'] = 'Licencja';
$lang['Filelicenseinfo'] = 'Licencja, która musi byæ zaakceptowana przez ¶ci±gaj±cego';
$lang['Filepin'] = 'Pin File';
$lang['Filepininfo'] = 'Wybierz je¶li chcesz ¿eby pliki by³y zawsze pokazywane nad innymi plikami.';
$lang['Filedls'] = 'Download Total';
$lang['Fileadded'] = 'Plik dodany';
$lang['Fileedited'] = 'Plik dodany';
$lang['Fderror'] = 'You didn\'t select any files to delete';
$lang['Filesdeleted'] = 'Plik skasowany';
$lang['File_checker'] = 'Konserwacja plików';
$lang['File_checker_explain'] = 'Tutaj mo¿esz sprawdziæ pliki w bazie danych i w katalogu';
$lang['File_saftey'] = 'Konserwacja plików s³u¿y do usuwania wszystkich niepotrzbnych, zalegaj±cych plików (z wyj±tkiem plików z innego katalogu ni¿: {html_path} oraz czyszczenia wpisów w bazie danych odnosz±cych siê do nie istniej±cych plików.<br />Przed rozpoczêciem konserwacji ' .  (($he) ? 'powiniene¶' : 'powinna¶') . ' zrobiæ kopiê katalogu plików oraz kopiê bazy danych.';
$lang['File_checker_perform'] = 'Konserwuj';
$lang['Checker_saved'] = 'Ca³kowita zapisana powierzchnia';
$lang['Checker_sp1'] = 'Konserwacja wpisów dla nieistniej±cych plików...';
$lang['Checker_sp2'] = 'Konserwacja wpisów dla nieistniej±cych screenshot\'ów...';
$lang['Checker_sp3'] = 'Kasowanie nieu¿ywanych plików...'; 

// License 
$lang['Alicensetitle'] = 'Dodaj licencje';
$lang['Elicensetitle'] = 'Edytuj licencje';
$lang['Dlicensetitle'] = 'Skasuj licencje';
$lang['Licenseexplain'] = 'W tym miejscu mo¿esz ustawiæ parametry Licencji. Licencja musi byæ zaakceptowana przez u¿ytkownika, zanim ¶ci±gnie plik';
$lang['Lname'] = 'Nazwa licencji';
$lang['Ltext'] = 'Tre¶æ licencji';
$lang['Licenseadded'] = 'Licencja dodana';
$lang['Licenseedited'] = 'Licencja zmieniona';
$lang['Ldeleted'] = 'Licencja dodana';

$lang['file_not_type'] = 'Plik zbyt du¿y, ma niew³a¶ciwy format, lub twój serwer nie obs³uguje uploadu plików.<br />Prze¶lij plik poprzez FTP do katalogu pafiledb/uploads i podaj adres w polu formularza: pafiledb/uploads/nazwa_pliku ';

$lang['Click_return'] = 'Kliknij %sTutaj%s ¿eby wróciæ do poprzedniej strony';

$lang['extension_forbidden'] = "Rozszerzenie '%s' jest niedozwolone.";

?>