<?php
/***************************************************************************
 *                       lang_admin_album.php [Polish]
 *                       -------------------
 *     begin             : Sunday, February 02, 2003
 *     copyright         : (C) 2003 Smartor
 *     email             : smartor_xp@hotmail.com
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Configuration
//

// Check for user gender
$he = ($userdata['user_gender'] != 2) ? true : false;

$lang['Album_config'] = 'Konfiguracja albumu';
$lang['Album_config_explain'] = 'Tutaj mo¿esz zmieniaæ g³ówne ustawienia Albumu zdjêæ';
$lang['Album_config_updated'] = 'Konfiguracja zmieniona';
$lang['Click_return_album_config'] = 'Kliknij %sTutaj%s ¿eby powróciæ do konfiguracji albumu';
$lang['Max_pics'] = 'Maksymalna liczba zdjêæ w jednej kategorii (-1 = nielimitowane)';
$lang['User_pics_limit'] = 'Maksymalna ilo¶æ zdjêæ dla jednego u¿ytkownika (-1 = nielimitowane)';
$lang['Moderator_pics_limit'] = 'Limit kategorii dla jednego moderatora (-1 = nielimitowane)';
$lang['Pics_Approval'] = 'Ustawienia zdjêæ';
$lang['Rows_per_page'] = 'Ilo¶æ rzêdów w mini galerii';
$lang['Cols_per_page'] = 'Ilo¶æ kolumn w mini galerii';
$lang['Thumbnail_quality'] = 'Jako¶æ miniatur zdjêæ (1-100)';
$lang['Thumbnail_cache'] = 'Cache minigalerii';
$lang['Manual_thumbnail'] = 'Rêczna minigaleria';
$lang['GD_version'] = 'Optymalizacja dla wersji GD';
$lang['GD_version_e'] = 'W zale¿no¶ci od systemu i rodzaju zainstalowanego kompresora grafiki, musisz wybraæ eksperymentalnie wersjê optymalizacji. Wersja 2 w systemach unixowych z regu³y dzia³a dobrze, przy wersji 1 miniatury kompresuje brzydko. Wersja 2 natomiast w systemach windowsowych czêsto powoduje b³±d przy dodawaniu zdjêcia, a wersja 1 dzia³a dobrze i miniatury wygl±daj± ³adnie';
$lang['Pic_Desc_Max_Length'] = 'Opis zdjêcia/Komentarz wielko¶æ (bytes)';
$lang['Hotlink_prevent'] = 'Zapobieganie hotlinkom';
$lang['Hotlink_allowed'] = 'Zezwolenia hotlinków dla domen (oddzielanie przecinkami)';
$lang['Personal_gallery'] = 'Zezwolenia na tworzenie prywatnych galerii dla u¿ytkowników';
$lang['Personal_gallery_limit'] = 'Limit zdjêæ dla jednej prywatnej galerii (-1 = nielimitowane)';
$lang['Personal_gallery_view'] = 'Kto mo¿e przegl±daæ prywatne galerie';
$lang['Rate_system'] = 'W³±cz oceny';
$lang['Rate_Scale'] =' Skala ocen';
$lang['Comment_system'] = 'W³±cz komentarze';
$lang['Thumbnail_Settings'] = 'Ustawienia minigalerii';
$lang['Extra_Settings'] = 'Dodatkowe ustawienia';
$lang['Default_Sort_Method'] = 'Domy¶lna metoda sortowania';
$lang['Default_Sort_Order'] = 'Domy¶lny porz±dek sortowania';
$lang['Fullpic_Popup'] = 'Oryginalny widok zdjêcia jako PopUp';


// Personal Gallery Page
$lang['Personal_Galleries'] = 'Prywatne galerie';
$lang['Album_personal_gallery_title'] = 'Prywatna galeria';
$lang['Album_personal_gallery_explain'] = 'Tutaj mo¿esz ustawiæ, która grupa u¿ytkowników ma prawa do tworzenia i przegl±dania w³asnych galerii, je¶li ogólnie wy³±czy³' .  (($he) ? 'e' : 'a') . '¶ mo¿liwo¶æ tworzenia i przegl±du prywatnych galerii.';
$lang['Album_personal_successfully'] = 'Ustawienia zapisane';
$lang['Click_return_album_personal'] = 'Kliknij %sTutaj%s ¿eby wróciæ do ustawieñ prywatnych galerii';

//
// Categories
//
$lang['Album_Categories_Title'] = 'Ustawienia kategorii Albumu';
$lang['Album_Categories_Explain'] = 'Tutaj mo¿esz ustawiæ ustawienia tworzenia, dodawania, usuwania, sortowania, itp.';
$lang['Category_Permissions'] = 'Poziomy kategorii';
$lang['Category_Title'] = 'Tytu³ kategorii';
$lang['Category_Desc'] = 'Opis kategorii';
$lang['View_level'] = 'Poziom dla podgl±du';
$lang['Upload_level'] = 'Poziom dla dodawania';
$lang['Rate_level'] = 'Poziom dla oceny';
$lang['Comment_level'] = 'Poziom dla komentarzy';
$lang['Edit_level'] = ' Poziom dla edytowania';
$lang['Delete_level'] = 'Poziom dla kasowania';
$lang['New_category_created'] = 'Nowa kategoria zosta³a utworzona';
$lang['Click_return_album_category'] = 'Kliknij %sTutaj%s ¿eby powróciæ do ustawieñ kategorii';
$lang['Category_updated'] = 'Kategoria zosta³a zaktualizowana';
$lang['Delete_Category'] = 'Usuñ kategorie';
$lang['Delete_Category_Explain'] = 'W tym miejscu mo¿esz usun±æ kategorie i wybraæ gdzie maj± znale¼æ siê zdjêcia z usuwanej kategorii';

$lang['Delete_all_pics'] = 'Usuñ wszystkie zdjêcia z tej kategorii';
$lang['Category_deleted'] = 'Kategoria usuniêta';

//
// Permissions
//
$lang['Album_Auth_Title'] = 'Prawa u¿ytkowników';
$lang['Album_Auth_Explain'] = 'Mo¿esz wybraæ które grupy lub u¿ytkownicy bêd± moderatorami dla jakiej kategorii albumu.';
$lang['Select_a_Category'] = 'Wybierz kategoriê';
$lang['Look_up_Category'] = 'Podgl±d kategorii';
$lang['Album_Auth_successfully'] = 'Ustawienia zapisane';
$lang['Click_return_album_auth'] = 'Kliknij %sTutaj%s ¿eby powróciæ do ustawieñ praw u¿ytkowników';

$lang['Upload'] = 'Dodawanie';
$lang['Rate'] = 'Ocena';
$lang['Comment'] = 'Komentarz';

//
// Clear Cache
//
$lang['Clear_Cache'] = 'Wyczy¶æ Cache';
$lang['Album_clear_cache_confirm'] = 'Je¶li masz w³±czony cache dla miniatur musisz wyczy¶ciæ cache po zmianie ustawieñ Albumu.<br /><br />Chcesz wyczy¶ciæ teraz?';

$lang['Create_album'] = 'Utwórz nowy album';
$lang['Create_sub_album'] = 'Utwórz podkategorie albumu';

$lang['Thumbnail_cache_cleared_successfully'] = '<br />Cache wyczyszczony<br />&nbsp;';

$lang['Watermark_transparent'] = 'Znak wodny';
$lang['Watermark_transparent_e'] = 'Podaj przezroczysto¶æ znaku wodnego w przedziale 1-99<br />Zostaje wykorzystany obrazek <b>/images/wm.png</b> mo¿esz go zmieniæ.<br />0 - wy³±czone';
$lang['Watermark_width'] = 'Znak wodny po³o¿enie w poziomie';
$lang['Watermark_width_e'] = 'Podaj warto¶æ w punktach, warto¶æ dodatnia - lewa strona<br />warto¶æ ujemna - prawa strona, <b>mid</b> - wy¶rodkowane';
$lang['Watermark_height'] = 'Znak wodny po³o¿enie w pionie';
$lang['Watermark_height_e'] = 'Podaj warto¶æ w punktach, warto¶æ dodatnia - góra<br />warto¶æ ujemna - dó³, <b>mid</b> - wy¶rodkowane';

?>