<?php
if(isset($_POST['date'])){
  $date = $_POST['date'];
  
  $dates = $this->getData("written_dates");
  if($dates == null){
    $dates = array();
  }else{
    $dates = json_decode($dates, true);
  }
  if(array_search($date, $dates) === false){
    $dates[] = $date;
    echo $this->saveData("written_dates", json_encode(array_values($dates)));
  }else{
    echo "1";
  }
}
