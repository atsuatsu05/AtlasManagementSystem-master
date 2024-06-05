<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="past-day">';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        //もし予約をしていたら
        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          //予約があって、過去日だったら
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'.$reservePart.'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="'.$reservePart.'" form="reserveParts">';
          }else{
            //予約があって、未来日だったら
            $html[] = '
            <button type="submit" class="reserve-modal-open btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .' " reservePart="'.$reservePart.'" settingPart="'.$day->authReserveDate($day->everyDay())->first()->setting_part.'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{//予約がなかったら
          //予約がなく、過去日だったら
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">受付終了</p>';
          }else{
          $html[] = $day->selectPart($day->everyDay());
          }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
    }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    // 予約キャンセルのモーダル画面
    $html[] = '
    <div class="modal js-modal">
      <div class="modal__bg js-modal-close"></div>
      <div class="modal__content">
        <form action="/delete/calendar" method="post">
        <div class="w-100">
         <div class="modal-inner-body w-50 m-auto">
          <p class="modal-inner-date "></p>
          <div class="date-modal-hidden">
            <input type="hidden" name="delete_date" >
          </div>
          <p class="modal-inner-part "></p>
          <div class="part-modal-hidden">
           <input type="hidden" name="delete_part" value="">
          </div>
          <p>上記の予約をキャンセルしてもよろしいですか？</p>
         </div>
        </div>
          <div class="w-50 m-auto edit-modal-btn d-flex">
            <a class="js-modal-close btn btn-primary d-inline-block" href="">閉じる</a>
            <input type="hidden" class="edit-modal-hidden" name="reserve_delete" value="reserve_date">
            <input type="submit" class="btn btn-danger d-block" value="キャンセル">
          </div>
        </div>
        '.csrf_field().'
        </form>
      </div>
    </div>';


    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
