<?php
if(isset($_POST['date'])){
  $date = $_POST['date'];

  $dates = $this->data->getValue("written_dates");
  if($dates == null){
    $dates = array();
  }else{
    $dates = json_decode($dates, true);
  }
  if(array_search($date, $dates) === false){
    $dates[] = $date;
    echo $this->data->saveValue("written_dates", json_encode(array_values($dates)));
  }else{
    echo "1";
  }
}
