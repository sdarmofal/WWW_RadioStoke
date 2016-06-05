<?php
/***************************************************************************
 *                          lang_main_album.php [English]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *
 *     $Id: lang_main_album.php,v 1.0.6 2003/03/05 20:12:38 ngoctu Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

// Check for user gender
$he = ($userdata['user_gender'] != 2) ? true : false;

//
// Album Index
//
$lang['Photo_Album'] = 'Album zdjêæ';
$lang['Pics'] = 'Zdjêcia';
$lang['Last_Pic'] = 'Ostatnie zdjêcie';
$lang['Public_Categories'] = 'Kategorie publiczne';
$lang['No_Pics'] = 'Brak zdjêæ';
$lang['Users_Personal_Galleries'] = 'Galerie u¿ytkowników';
$lang['Your_Personal_Gallery'] = 'Twoja prywatna galeria';
$lang['Recent_Public_Pics'] = 'Ostatnie zdjêcia';

$lang['View'] = 'Ods³on';

//
// Category View
//
$lang['Category_not_exist'] = 'Ta kategoria nie istnieje lub nie posiadasz do niej praw dostêpu';
$lang['Upload_Pic'] = 'Dodaj zdjêcie';
$lang['Pic_Title'] = 'Tytu³ zdjêcia';

$lang['Album_moderate_can'] = '<b>Mo¿esz</b> %smoderowaæ%s tê kategorie';

$lang['Edit_pic'] = 'Edytuj';
$lang['Delete_pic'] = 'Usuñ';
$lang['Rating'] = 'Oceny';
$lang['Comments'] = 'Komentarze';
$lang['New_Comment'] = 'Dodaj komentarz';

$lang['Not_rated'] = '<i>nie ocenione</i>';

//
// Upload
//
$lang['Pic_Desc'] = 'Opis zdjêcia';
$lang['Plain_text_only'] = 'Tylko normalny tekst';
$lang['Max_length'] = 'Max d³ugo¶æ (bytes)';
$lang['Upload_pic_from_machine'] = 'Wybierz zdjêcie ze swojego komputera';
$lang['Upload_to_Category'] = 'Dodaj do kategorii';
$lang['Upload_thumbnail'] = 'Dodaj miniaturkê zdjêcia';
$lang['Upload_thumbnail_explain'] = 'Musi byæ tego samego typu co twoje zdjêcie';
$lang['Thumbnail_size'] = 'Rozmiar miniatury (pixele)';
$lang['Filetype_and_thumbtype_do_not_match'] = 'Twoje zdjêcie i miniatura musi byæ tego samego typu';

$lang['Upload_no_title'] = 'Musisz dodaæ tytu³ swojego zdjêcia';
$lang['Upload_no_file'] = 'Musisz podaæ ¶cie¿kê i nazwê pliku';
$lang['Desc_too_long'] = 'Opis jest za d³ugi';

$lang['Max_file_size'] = 'Maksymalna wielko¶æ pliku (bytes)';
$lang['Max_width'] = 'Maksymalna szeroko¶æ (pixel)';
$lang['Max_height'] = 'Maksymalna wysoko¶æ (pixel)';

$lang['JPG_allowed'] = 'Dozwolony plik JPG';
$lang['PNG_allowed'] = 'Dozwolony plik PNG';
$lang['GIF_allowed'] = 'Dozwolony plik GIF ';

$lang['Album_reached_quota'] = 'W tej kategorii zosta³a osi±gniêta maksymalna ilo¶æ zdjêæ, nie mo¿esz wiêc dodaæ ju¿ ¿adnego.';
$lang['User_reached_pics_quota'] = 'Przekroczy³' .  (($he) ? 'e' : 'a') . '¶ limit dodanych zdjêæ, nie mo¿esz ju¿ dodaæ ¿adnego. Je¶li jest to konieczne i mo¿liwe, usuñ jakie¶ swoje poprzednie zdjêcie.';

$lang['Bad_upload_file_size'] = 'Plik twojego zdjêcia jest zbyt du¿y, lub uszkodzony';
$lang['Not_allowed_file_type'] = 'Typ twojego pliku nie jest dozwolony';
$lang['Upload_image_size_too_big'] = 'Rozmiar (w pixelach) twojego zdjêcia jest za du¿y';
$lang['Upload_thumbnail_size_too_big'] = 'Rozmiar miniatury twojego zdjêcia (w pixelach) jest za du¿y';

$lang['Missed_pic_title'] = 'Musisz podaæ tytu³ zdjêcia';

$lang['Album_upload_successful'] = 'Zdjêcie dodane';
$lang['Album_upload_need_approval'] = 'Twoje zdjêcie zosta³o dodane<br /><br />Zdjêcie musi zostaæ zaakceptowane przez moderatora, lub administratora';

$lang['Click_return_category'] = 'Kliknij %sTutaj%s ¿eby powróciæ do kategorii';
$lang['Click_return_album_index'] = 'Kliknij %sTutaj%s ¿eby powróciæ do menu g³ównego albumu';

// View Pic
$lang['Pic_not_exist'] = 'To zdjêcie nie istnieje';

// Edit Pic
$lang['Edit_Pic_Info'] = 'Zmieñ informacje o zdjêciu';
$lang['Pics_updated_successfully'] = 'Informacje zaktualizowane';

// Delete Pic
$lang['Album_delete_confirm'] = 'Jeste¶ pew' .  (($he) ? 'ien' : 'na') . ' ¿e chcesz usun±æ zdjêcie?';
$lang['Pics_deleted_successfully'] = 'Zdjêcie usuniête.';

//
// ModCP
//
$lang['Approval'] = 'Zatwierdzono';
$lang['Approve'] = 'Zatwierdz';
$lang['Unapprove'] = 'Cofnij';
$lang['Status'] = 'Status';
$lang['Locked'] = 'Zablokowane';
$lang['Not_approved'] = 'Nie Zatwierdzone';
$lang['Approved'] = 'Zatwierdzone';
$lang['Move_to_Category'] = 'Przenie¶ do kategorii';
$lang['Pics_moved_successfully'] = 'Zdjêcie(a) zosta³o(y) przeniesione';
$lang['Pics_locked_successfully'] = 'Zdjêcie(a) zosta³o(y) zablokowane';
$lang['Pics_unlocked_successfully'] = 'Zdjêcie(a) zosta³o(y) odblokowane';
$lang['Pics_approved_successfully'] = 'Zdjêcie(a) zosta³o(y) Zatwierdzone';
$lang['Pics_unapproved_successfully'] = 'Zdjêcie(a) zosta³o(y) Cofniête';

//
// Rate
//
$lang['Current_Rating'] = 'Aktualne oceny';
$lang['Please_Rate_It'] = 'Oceñ';
$lang['Already_rated'] = 'Ju¿ ocenia³' .  (($he) ? 'e' : 'a') . '¶ to zdjêcie';
$lang['Album_rate_successfully'] = 'Zdjêcie zosta³o ocenione';

//
// Comment
//
$lang['Comment_no_text'] = 'Dodaj swój komentarz';
$lang['Comment_too_long'] = 'Komentarz za d³ugi';
$lang['Comment_delete_confirm'] = 'Jeste¶ pew' .  (($he) ? 'ien' : 'na') . ' ¿e chcesz usun±æ swój komentarz?';
$lang['Pic_Locked'] = 'To zdjêcie zosta³o zablokowane przez moderatora, nie mo¿na dodawaæ komentarzy.';

//
// Personal Gallery
//
$lang['Personal_Gallery_Explain'] = 'Mo¿esz przegl±daæ galerie innych u¿ytkowników, klikaj±c na link w ich profilu';
$lang['Personal_gallery_not_created'] = 'Galeria %s jest pusta lub nie zosta³a utworzona';
$lang['Not_allowed_to_create_personal_gallery'] = 'Prywatne galerie s± wy³±czone';
$lang['Click_return_personal_gallery'] = 'Kliknij %sTutaj%s ¿eby wróciæ do prywatnej galerii';

$lang['No_convert'] = 'Nie mo¿na stworzyæ miniatury zdjêcia. Na serwerze brak zainstalowanego konwertera zdjêæ.<br />Mo¿esz wy³±czyæ kompresjê GD i ustawiæ rêczne tworzenie miniatur w Panelu Admina.';
$lang['Sub-catagories'] = 'Podkategorie';
?>