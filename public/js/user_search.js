$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
    $('.accordion_btn').toggleClass("open");
  });

  $('.subject_edit').click(function () {
    $('.subject_inner').slideToggle();
    $('.subject_edit_btn').toggleClass("open");
  });
});
