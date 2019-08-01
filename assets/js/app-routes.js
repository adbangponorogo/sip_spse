/*----------------------------------------------------------
* ------------------------------------------
* ----------------------- ROUTES -------------------------
* ------------------------------------------
/* --------------------------------------------------------


/* --------------------------------------------------------
* ----------------------- DASHBOARD -----------------------
*----------------------------------------------------------*/
jQuery(document).on("click", ".open-dashboard", function(){
	jQuery(".app-content").load("../dashboard/page/main");
	return false;
});


/* --------------------------------------------------------
* ----------------- REPORT - PAKET TENDER -----------------
*----------------------------------------------------------*/
jQuery(document).on("click", ".open-paket-tendering-eprocurement", function(){
	jQuery(".app-content").load("../paket-tendering/e-procurement/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-tendering-paketpengadaan", function(){
	jQuery(".app-content").load("../paket-tendering/data-pengadaan/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-tendering-paketopd", function(){
	jQuery(".app-content").load("../paket-tendering/paket-opd/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-tendering-kontrakopd", function(){
	jQuery(".app-content").load("../paket-tendering/kontrak-opd/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-tendering-paketulang", function(){
	jQuery(".app-content").load("../paket-tendering/paket-ulang/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-tendering-paketgagal", function(){
	jQuery(".app-content").load("../paket-tendering/paket-gagal/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-tendering-progrespbj", function(){
	jQuery(".app-content").load("../paket-tendering/progres-pbj/page/main");
	return false;
});


/* --------------------------------------------------------
* -------------- REPORT - PAKET NON TENDER ----------------
*----------------------------------------------------------*/
jQuery(document).on("click", ".open-paket-nontendering-paketpengadaan", function(){
	jQuery(".app-content").load("../paket-non-tendering/paket-pengadaan/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-nontendering-paketopd", function(){
	jQuery(".app-content").load("../paket-non-tendering/paket-opd/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-nontendering-kontrakopd", function(){
	jQuery(".app-content").load("../paket-non-tendering/kontrak-opd/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-nontendering-paketulang", function(){
	jQuery(".app-content").load("../paket-non-tendering/paket-ulang/page/main");
	return false;
});
jQuery(document).on("click", ".open-paket-nontendering-paketgagal", function(){
	jQuery(".app-content").load("../paket-non-tendering/paket-gagal/page/main");
	return false;
});


/* --------------------------------------------------------
* ----------------------- SiRUP ---------------------------
*----------------------------------------------------------*/
jQuery(document).on("click", ".open-sirup-rekapitulasi-sirup", function(){
	jQuery(".app-content").load("../paket-sirup/rekapitulasi/page/main");
	return false;
});
jQuery(document).on("click", ".open-sirup-paket-sirup", function(){
	jQuery(".app-content").load("../paket-sirup/paket/page/main");
	return false;
});
jQuery(document).on("click", ".open-sirup-data-sirup", function(){
	jQuery(".app-content").load("../paket-sirup/data/page/main");
	return false;
});


/* --------------------------------------------------------
* --------------------- E-Purchasing ----------------------
*----------------------------------------------------------*/
jQuery(document).on("click", ".open-epurchasing-data", function(){
	jQuery(".app-content").load("../e-purchasing/data/page/main");
	return false;
});


/* --------------------------------------------------------
* ----------------------- Rekanan -------------------------
*----------------------------------------------------------*/
jQuery(document).on("click", ".open-rekanan-profil-data", function(){
	jQuery(".app-content").load("../rekanan/profil/data/page/main");
	return false;
});


/* --------------------------------------------------------
* ----------------------- Misc ---------------------------
*----------------------------------------------------------*/
jQuery(document).on("click", ".open-misc-tentangkami", function(){
	jQuery(".app-content").load("../misc/tentang-kami/page/main");
	return false;
});
jQuery(document).on("click", ".open-misc-autentikasi", function(){
	jQuery(".app-content").load("../misc/autentikasi/page/main");
	return false;
});
jQuery(document).on("click", ".open-misc-tarik-data", function(){
	jQuery(".app-content").load("../misc/tarik-data/page/main");
	return false;
});
