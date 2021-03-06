lobby.app.counter = 30;
lobby.app.saveDiary = function(){
  data = $(".diary .entry").html().replace(/<p(.*?)>(.*?)<\/p>/g, '[p]$2[/p]');

  if($(".diary .entry").text() != " Type here... "){
    lobby.app.save(lobby.app.date, data, function(){
      $(".diary .paper").animate({backgroundColor: "rgb(101, 196, 53)"}, 1000, function(){
        $(".diary .paper").animate({backgroundColor: "rgb(255, 255, 255)"}, 1000, function(){
          $(".diary .paper").attr("style", "");
        });
      });
    });
    lobby.app.ar("date", {date: lobby.app.date});
  }else{
    alert("Please write something....");
  }
};
$("#workspace #save_diary").live("click", function(){
  lobby.app.saveDiary();
  lobby.app.counter = 30;
});

setInterval(function(){
  lobby.app.saveDiary();
  lobby.app.counter = 30;
}, 30000);

setInterval(function(){
  lobby.app.counter--;
  $("#workspace #seconds_counter").text(lobby.app.counter);
}, 1000);

$(function(){
  $(".paper .entry").notebook({
    placeholder: "Type here...",
    modifiers: ['bold', 'italic', 'underline', 'anchor']
  });
});
