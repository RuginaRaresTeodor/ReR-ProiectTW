  <?php
        if(isset( $_SESSION["name"]))
            $name=$_SESSION["name"];
            else 
            $name="Guest";
            echo $name; 
  ?>