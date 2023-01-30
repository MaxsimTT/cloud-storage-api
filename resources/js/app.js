import './bootstrap';

$(".add-file").on("click", function () {
  	$(".modal").fadeIn();
});

$(".close").on("click", function () {
	$(".modal").fadeOut();
});

$(".create-folder").on("click", function () {
  	$(".modal-2").fadeIn();
});

$(".close").on("click", function () {
	$(".modal-2").fadeOut();
});
