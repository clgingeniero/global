<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Block_Events extends Mage_Core_Block_Template
{
    public function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array(), $cellsize = 80){
        $first_of_month = gmmktime(0,0,0,$month,1,$year);
        #remember that mktime will automatically correct if invalid dates are entered
        # for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
        # this provides a built in "rounding" feature to generate_calendar()

        $day_names = array(); #generate all the day names according to the current locale
        for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
          $day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

        list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
        $weekday = ($weekday + 7 - $first_day) % 7;                    //adjust for $first_day
        $title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  //note that some locales don't capitalize month and day names

        //Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
        @list($p, $pl) = each($pn); @list($n, $nl) = each($pn); @list($c, $cl) = each($pn); #previous and next links, if applicable
        if($p) $p = '<span class="calendar-prev" onmouseover="this.className=\'hand\';" onmouseout="this.className=\'calendar-prev\';"'.($pl ? ' onclick="document.getElementById(\'month'.$cl.'\').style.visibility=\'hidden\';document.getElementById(\'month'.$pl.'\').style.visibility=\'visible\';">'.$p : '>'.$p).'</span>&nbsp;';
        if($n) $n = '&nbsp;<span class="calendar-next" onmouseover="this.className=\'hand\';" onmouseout="this.className=\'calendar-next\';"'.($nl ? ' onclick="document.getElementById(\'month'.$cl.'\').style.visibility=\'hidden\';document.getElementById(\'month'.$nl.'\').style.visibility=\'visible\';">'.$n : '>'.$n).'</span>';
        $calendar = '<table cellpadding=0 cellspacing=0 class="calendar">'."\n".
           '<caption class="calendar-month">'.$p.($month_href ? '<a href="'.htmlspecialchars($month_href).'">'.$title.'</a>' : $title).$n."</caption>\n<tr>";

        if($day_name_length){ #if the day names should be shown ($day_name_length > 0)
        #if day_name_length is >3, the full name of the day will be printed
          foreach($day_names as $d)
            $calendar .= '<th abbr="'.htmlentities($d).'" width="'.$cellsize.'">'.htmlentities($day_name_length < 4 ? substr($d,0,$day_name_length) : $d).'</th>';
          $calendar .= "</tr>\n<tr>";
        }

        if($weekday > 0) $calendar .= '<td colspan="'.$weekday.'" height="'.$cellsize.'" align="left">&nbsp;</td>'; #initial 'empty' days
        for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
          if($weekday == 7){
            $weekday   = 0; #start a new week
            $calendar .= "</tr>\n<tr>";
          }
          $month=ltrim($month,"0");
          if(isset($days[$year][$month][$day]) && is_array($days[$year][$month][$day])){
            @list($links, $classes, $contents, $titles) = $days[$year][$month][$day];
            if(is_null($contents)) $content = "";
            else $content=explode(':|:',$contents);
            $link=explode(':|:',$links);
            $title=explode(':|:',$titles);
            $calendar .= '<td'.($classes ? ' class="calendar-cell '.htmlspecialchars($classes).'" height="'.$cellsize.'" align="left">' : ' height="'.$cellsize.'" align="left">').$day.'<br />';
            for($s=0;$s<=sizeof($content)-1;$s++){
              $calendar .= ($link[$s] ? '<a href="'.htmlspecialchars($link[$s]).'" alt="'.$title[$s].'">'.$content[$s].'</a>' : $day.'<br />'.$content[$s]).'<br />';
            }
            $calendar .= "</td>\n";
          }
          else $calendar .= "<td height=\"".$cellsize."\" align=\"left\" class=\"calendar-cell\">$day</td>";
        }
        if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

        return $calendar."</tr>\n</table>\n";
    }

    public function getDays($num_months) {
        $store=Mage::app()->getStore()->getStoreId();
        $start=date('Y-m-d H:i:s',mktime(0,0,0,date("n"),1,date("Y")));
        $end=date('Y-m-d H:i:s',mktime(23,59,59,date("n")+$num_months,date('t',mktime(0,0,0,date("n"),1,date("Y"))),date("Y")));
        $days = Mage::getModel('mathieufeventscal/event')->getCollection()->addEventFilter($start,$end,$store);
        return $days;
    }
    public function getEvents() {
        $store=Mage::app()->getStore()->getStoreId();
        $num_months=Mage::getStoreConfig('mathieufeventscal/general/show_months');
        $start=date('Y-m-d H:i:s',time());
        $end=date('Y-m-d H:i:s',mktime(0,0,0,date("n",time())+$num_months,date("t",mktime(0,0,0,date("n",time())+$num_months,1,date("Y",time()))),date("Y",time())));
        $days = Mage::getModel('mathieufeventscal/event')->getCollection()->addEventFilter($start,$end,$store);
        return $days;
    }

    public function eventsCalendar($cellwidth=65) {
        $calendar='<div style="position:left;min-height:450px;">';
        $offset=0;
        setlocale(LC_TIME, Mage::getStoreConfig('general/locale/code'));
        $num_months=Mage::getStoreConfig('mathieufeventscal/general/show_months');

        $days=$this->getDays($num_months);

        for($i=1;$i<=$num_months;$i++) {
          $calendar.='<div id=month'.$i.' style="position:absolute;';
          if($i>1) $calendar.='visibility:hidden;';
          $calendar.='">';
          if($num_months != 1) {
            if($i==1) $pn=array(''=>'', '&raquo;'=>$i+1,'today'=>$i);
            elseif($i==$num_months) $pn=array('&laquo;'=>$i-1,''=>'','today'=>$i);
            else $pn=array('&laquo;'=>$i-1, '&raquo;'=>$i+1,'today'=>$i);
          } else $pn=array(''=>'',''=>'',''=>'');
          $calendar.=$this->generate_calendar(date('Y',time()+$offset),date('n',time()+$offset),$days,3,NULL,Mage::getStoreConfig('general/locale/firstday'),$pn,$cellwidth);
          $offset+=60*60*24*date('t',time()+$offset);
          $calendar.='</div>';
        }
        $calendar.='</div>';
        date_default_timezone_set('UTC');
        return $calendar;
   }

   public function eventsList($num_events=1) {
        setlocale(LC_TIME, Mage::getStoreConfig('general/locale/code'));
        $offset=0;
        $days=$this->getEvents();
        asort($days);
        $eventlist="";
        $year=date("Y");
        $month=date("n");
        $day=date("j");
        $i=$j=$numevent=0;
        for($a=0;$a<sizeof($days);$a++) {
          $walkyear=date("Y",mktime(0,0,0,1,1,$year+$a));
          for($b=1;$b<=12;$b++){
            for($c=1;$c<=31;$c++){
              if(isset($days[$walkyear][$b][$c])) $numevent++;
            }
          }
        }
        if($numevent < $num_events) $num_events=$numevent;
        while($i<$num_events){
          $tyear=date("Y",mktime(0,0,0,$month,$day+$j,$year));
          $tmonth=date("n",mktime(0,0,0,$month,$day+$j,$year));
          $tday=date("j",mktime(0,0,0,$month,$day+$j,$year));
          if(isset($days[$tyear][$tmonth][$tday]) and is_array($days[$tyear][$tmonth][$tday])) {
            @list($links, $classes, $contents, $titles) = $days[$tyear][$tmonth][$tday];
            if(is_null($contents)) $content = $day;
            else $content=explode(':|:',$contents);
            $link=explode(':|:',$links);
            $title=explode(':|:',$titles);
            for($s=0;$s<=sizeof($content)-1;$s++){
              if($i==$num_events) break;
              $eventlist.='<a href="'.$link[$s].'"> '.utf8_encode(ucfirst(gmstrftime(Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_LONG),mktime(0,0,0,$tmonth,$tday,$tyear)))).' - '.$title[$s].'</a><br>';
              $i++;
            }
          }               
          $j++;
        }
        
        date_default_timezone_set('UTC');
        return $eventlist;
   }

}
