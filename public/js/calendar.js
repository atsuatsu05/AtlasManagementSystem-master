$(function () {
  $('.reserve-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var reserve_date = $(this).attr('value');
    var reserve_part = $(this).attr('reservePart');
    var setting_part = $(this).attr('settingPart');
    $('.modal-inner-date').text('予約日：' + reserve_date);
    $('.date-modal-hidden input').val(reserve_date);
    $('.modal-inner-part').text('時間：' + reserve_part);
    $('.part-modal-hidden input').val(setting_part);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});
