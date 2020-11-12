<?php
use App\Models\CoreModel;

function is_enrolled($id){
   $model = new CoreModel();
   $enroll["where"] = array("student_id" => $id);
   $is_enrolled = (count($model->getData($enroll, "enrolled_subjects")) != 0) ? true : false ;
   return $is_enrolled;
}


function sidebar_content($content = array()){
  $str = "";
  for ($i=0; $i < count($content); $i++) {
      $str .= '<li class="nav-item ">';
          $str .= '<a class="nav-link" href="'.$content[$i]['link'].'">';
              $str .= '<i class="'.$content[$i]['icon'].'"></i>';
              $str .= '<p>'.$content[$i]['text'].'</p>';
          $str .= '</a>';
      $str .= '</li>';
      if (in_array("childItem", $content)) {
        $str .= '<div class="collapse " id="componentsExamples">';
            $str .= '<ul class="nav">';
            foreach ($key->childItem as $keyS ) {
              $str .= '<li class="nav-item ">';
                  $str .= '<a class="nav-link" href="'.$keyS->link.'">';
                      $str .= '<i class="nc-icon nc-chart-pie-35"></i>';
                      $str .= '<p>'.$keyS->text.'</p>';
                  $str .= '</a>';
              $str .= '</li>';
            }
            $str .= '</ul>';
        $str .= '</div>';
      }
  }
  return $str;
}


?>
