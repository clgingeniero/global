<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Model_Mysql4_Event_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('mathieufeventscal/event');
    }

    public function addEventFilter($from, $to, $store)
    {
        $read = $this->getConnection();
        $select = $read ->select()
                        ->from(array('q'=>$this->getResource()->getMainTable()), array('event_id','date_from','date_to','title','details','url'))
                        ->where('date_from>=?', $from)
                        ->where('date_to<=?', $to)
                        ->where('store_id = 0 OR store_id=?', $store)
                        ->order('event_id desc');

        $days=array();
        foreach ($read->fetchAll($select) as $result) {
          if($result) {
            $year=substr($result['date_from'],0,4);
            $year2=substr($result['date_to'],0,4);
            $theday=ltrim(substr($result['date_from'],8,2),"0");
            $theday2=ltrim(substr($result['date_to'],8,2),"0");
            $month=ltrim(substr($result['date_from'],5,2),"0");
            $month2=ltrim(substr($result['date_to'],5,2),"0");
            if($result['url'] != '')
              $details=$result['url'];
            else
              $details=Mage::getBaseUrl().$result['details'];
            $title=$result['title'];
            $starttime=substr($result['date_from'],11,5);
            if($theday!=$theday2 || $month!=$month2 || $year != $year2) {
              $separator='&rarr;';
              $day1=mktime(0,0,0,$month,$theday,$year);
              $day2=mktime(0,0,0,$month2,$theday2,$year2);
              $daydiff=floor(($day2-$day1)/(60*60*24));
              for($i=0;$i<=$daydiff;$i++){
		$tyear=date("Y",mktime(0,0,0,$month,$theday+$i,$year));
                $tmonth=date("n",mktime(0,0,0,$month,$theday+$i,$year));
                $tday=date("j",mktime(0,0,0,$month,$theday+$i,$year));
                if(mktime(0,0,0,$month,$theday+$i,$year) == $day2){
                  $endtime=substr($result['date_to'],11,5);
                  $separator="&larr;";
                } else
                  $endtime="";
                if(!isset($days[$tyear][$tmonth][$tday])) {
                  $days[$tyear][$tmonth][$tday]=array($details,'linked-day',$title.'<br/>'.$starttime.$separator.$endtime,$title);
                } else {
                  $days[$tyear][$tmonth][$tday][0]=$days[$tyear][$tmonth][$tday][0].'|'.$details;
                  $days[$tyear][$tmonth][$tday][2]=$days[$tyear][$tmonth][$tday][2].'|'.$title.'<br />'.$starttime.$separator.$endtime;
                  $days[$tyear][$tmonth][$tday][3]=$days[$tyear][$tmonth][$tday][3].'|'.$title;
                }
                $starttime="";
                $separator="&larr;&rarr;";
              }
            } else {
              $endtime=substr($result['date_to'],11,5);
              if(!isset($days[$year][$month][$theday])) {
                $days[$year][$month][$theday]=array($details,'linked-day',$title.'<br/>'.$starttime.' - '.$endtime,$title);
              } else {
                $days[$year][$month][$theday][0]=$days[$year][$month][$theday][0].':|:'.$details;
                $days[$year][$month][$theday][2]=$days[$year][$month][$theday][2].':|:'.$title.'<br />'.$starttime.' - '.$endtime;
                $days[$year][$month][$theday][3]=$days[$year][$month][$theday][3].':|:'.$title;
              }
            }
          }
        }
        return $days;
    }

}
