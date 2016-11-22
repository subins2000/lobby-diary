<?php
if(isset($_POST['diary']) && CSRF::check()){
  // Set name
  $this->data->saveValue("name", $_POST['diary']);
}
?>
<div class="contents">
  <h1>Diary</h1>
  <p style="font-style: italic;margin-bottom: 20px;">Saving memories of your life</p>
  <h2>Entries</h2>
  <p>Choose a date to view it's entry or <?php echo $this->l("/entry", "write today's", "class='btn'");?></p>
  <div class="datepicker" style="margin: 10px auto;"></div>
  <?php
  if(isset($_POST['diary'])){
    echo sss("Name Set", "Your diary's name has been set.");
  }
  ?>
  <h2>Name</h2>
  <form action="<?php echo \Lobby::u();?>" method="POST">
    <p>Want to name your diary ?</p>
    <?php echo CSRF::getInput();?>
    <input type="text" name="diary" placeholder="Type name here... (Kitty, John)" value="<?php echo $this->data->getValue("name");?>" />
    <button class="btn red">Submit</button>
  </form>
  <script>
  lobby.load(function(){
    lobby.app.written_dates = <?php echo $this->data->getValue("written_dates") ?: '[]';?>;
    availableDates = lobby.app.written_dates;
    availableDates.push($.datepicker.formatDate('dd-mm-yy', new Date()));

    function available(date) {
      dmy = $.datepicker.formatDate($(".datepicker").datepicker( "option", "dateFormat" ), date);

      if ($.inArray(dmy, availableDates) != -1) {
        return dmy == $.datepicker.formatDate('dd-mm-yy', new Date()) ? [true, "", "Write Today's Diary"] : [true, "", "Click to see diary entry"];
      } else {
        return [false, "", "No Entry in this date"];
      }
    }

    $(".datepicker").datepicker({
      autoSize: true,
      dateFormat: "dd-mm-yy",
      maxDate: "+0d",
      showWeek: true,
      changeMonth: true,
      changeYear: true,
      weekHeader: "Week",
      dayNamesMin: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],

      beforeShowDay: available,
      onSelect: function(date){
        if($.datepicker.formatDate($(".datepicker").datepicker("option", "dateFormat"), new Date()) == date){
          lobby.app.redirect("/entry");
        }else{
          lobby.app.redirect("/entry/"+date);
        }
      }
    });
  });
  </script>
  <style>
    .ui-datepicker {
      width:auto;
      font-size: 20px;
    }
    .datepicker tbody tr{
      background: none;
    }
    .datepicker tr td{
      box-shadow: none;
      -webkit-box-shadow: none;
    }
    .datepicker tr td:nth-child(1){
      border: none;
      text-align: center;
    }
  </style>
</div>
