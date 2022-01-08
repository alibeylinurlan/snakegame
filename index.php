<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

    <?php 
    $x = 15;
    $y = 15;
     ?>
    $(document).ready(function(){
      x_limit= <?php echo $x; ?>;
      y_limit= <?php echo $y; ?>;
      direction = 0;
      x =7;
      y =3;
      frame = 100; //milli saniye
      direction; // 0left, 1top, 2right, 3bottom
      scor = 0;
      bestscor = 0;
      snake_head_cor = '.y'+y+' .x'+x;
      ln = [];
      ln.push(snake_head_cor);
      ln.push('.y'+y+' .x'+(x+1));
      ln.push('.y'+y+' .x'+(x+2));
      ln.push('.y'+y+' .x'+(x+3));
      

      


      function diamond() {
          d_x = Math.floor((Math.random() * x_limit) + 1);
          d_y = Math.floor((Math.random() * y_limit) + 1);  
          d_cor = (".y"+d_y+" .x"+d_x).toString();
          if (jQuery.inArray(d_cor, ln) != -1) {
            diamond();
          }
          $(d_cor).css({"background-color" : "orange"});
      }

      diamond();
        
      // function black() { $(sn_cors).css({"background-color" : "black"}); }
      // setInterval(black, frame);

      function limits(){
        if (x < 1 ) {x=x_limit;} if (x > x_limit ) {x=1;}
        if (y < 1 ) {y=y_limit;} if (y > y_limit ) {y=1;}
         }

        function tailfrm () {
            ln.push('.y'+y+' .x'+x); 
            if (y == d_y && x == d_x) {
                diamond();
                ln.unshift('.y'+y+' .x'+x);
                scor++;
                $(".scor").html(scor);
            }

            firscor = ln[0].toString();
            lastcor = ln[ln.length-1].toString(); //snake head
            $(firscor).css({"background-color" : "#eee", "transition" : "0.3s"});
            ln.shift();
            let sn_cors = ln.toString();
            $(sn_cors).css({"background-color" : "black",  "transition" : "0.001s"});
            $(lastcor).css({"background-color" : "darkred",  "transition" : "0.001s"});
            head_cor = ln[ln.length-1].toString();
            snake_body = [...ln];

            snake_body.pop();
            if(snake_body.indexOf(head_cor) !== -1){
                $(".gameover").fadeIn();
            }
            
        }

        function x_minus() { 
            x--; limits();
            tailfrm();
        }
        function x_plus() {  
            x++; limits();
            tailfrm ();
        }

        function y_minus() {   
            y--; limits();
            tailfrm();
        }
        function y_plus() {  
            y++; limits();
            tailfrm();
        }

        function clearintervals() {
            clearInterval(xminus); clearInterval(xplus); 
            clearInterval(yminus);clearInterval(yplus);
        }

        yplus = setInterval(y_plus, frame);clearInterval(yplus); 
        yminus = setInterval(y_minus, frame);clearInterval(yminus); 
        xminus = setInterval(x_minus, frame);
        xplus = setInterval(x_plus, frame);   clearInterval(xplus);

      $(document).keydown(function(e){
        if (e.keyCode == 37 && direction != 2) { 
            clearintervals();  
            direction = 0;
            xminus = setInterval(x_minus, frame);
        }
        if (e.keyCode == 39  && direction != 0) { 
            clearintervals(); 
            direction = 2;
            xplus = setInterval(x_plus, frame);
        }


        if (e.keyCode == 38  && direction != 3) { 
            clearintervals();
            direction = 1;
            yminus = setInterval(y_minus, frame);
        }
        if (e.keyCode == 40  && direction != 1) { 
            clearintervals();
            direction = 3;
            yplus = setInterval(y_plus, frame);
        }
      });


      
      
    });
    </script>
</head>
<body>

<?php 
    
    for ($j=1; $j <= $y; $j++) { ?>
        <div class="y<?php echo $j; ?>" style="width: <?php echo ($x*30).'px'; ?>;"> 
            <?php
                for ($i=1; $i <= $x; $i++) {  ?>
                 <div class="x<?php echo $i; ?>" style="float: left;width: 30px;height: 30px;
                 background-color: #eee;border: solid thin grey;box-sizing: border-box;"></div>
            <?php } ?>
        </div>
    <?php
    }
 ?>
<div style="position: fixed;right: 10px;top: -30px;font-size: 20px;font-weight: bold;">
    <h1>Score <br><span class="scor">0</span></h1>
</div>

<div class="gameover" style="width:100%;height:100vh;display: flex;justify-content: center;align-items: center;color: red;font-weight: bold;font-size: 50px;z-index: 1;background-color: white;position: fixed;top: 0px;left: 0px;display: none;padding: 20px;">
    <h1> Game over !
        <br><a href=""><span style="color: green;font-size: 30px;">start new game</span></a></h1>
</div>

</body>
</html>
