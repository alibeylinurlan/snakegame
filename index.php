<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

    <?php 
    $x = 20;
    $y = 20;
     ?>
    $(document).ready(function(){
      x_limit= <?php echo $x; ?>;
      y_limit= <?php echo $y; ?>;
      direction = 0;
      x =7;
      y =3;
      frame = 100; //milli saniye
      trail = 5;
      d_x = Math.floor((Math.random() * x_limit) + 1);
      d_y = Math.floor((Math.random() * y_limit) + 1);  

      $(".y"+d_y+" .x"+d_x).css({"background-color" : "orange"});

        function grey(){$(".y"+y+" .x"+x).css({"background-color" : "#eee"});}
        function black(){$(".y"+y+" .x"+x).css({"background-color" : "black"});}
        function limits(){
            if (x < 1 ) {x=x_limit;} if (x > x_limit ) {x=1;}
            if (y < 1 ) {y=y_limit;} if (y > y_limit ) {y=1;}
             }


        function x_minus() {  grey(); x--; limits(); black(); }
        function x_plus() { grey(); x++; limits(); black(); }
        function y_minus() {  grey(); y--; limits(); black();}
        function y_plus() { grey(); y++; limits(); black(); }

        function clearintervals() {
            clearInterval(xminus); clearInterval(xplus); 
            clearInterval(yminus);clearInterval(yplus);
        }

        yplus = setInterval(y_plus, frame);clearInterval(yplus); 
        yminus = setInterval(y_minus, frame);clearInterval(yminus); 
        xminus = setInterval(x_minus, frame);clearInterval(xminus);
        xplus = setInterval(x_plus, frame);

      $(document).keydown(function(e){
        if (e.keyCode == 37) { 
            clearintervals();  
            xminus = setInterval(x_minus, frame);
        }
        if (e.keyCode == 39) { 
            clearintervals(); 
            xplus = setInterval(x_plus, frame);
        }

        if (e.keyCode == 38) { 
            clearintervals();
            yminus = setInterval(y_minus, frame);
        }
        if (e.keyCode == 40) { 
            clearintervals();
            yplus = setInterval(y_plus, frame);
        }
      });


      //eating procces
      if (x == d_x && y == d_y) {
        alert("ok");
      }
      
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

 

</body>


</html>
