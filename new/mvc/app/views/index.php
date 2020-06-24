<?php
    session_start();
    include_once 'header.php';
    include_once '../models/db_connection.php';
    include_once '../controllers/controll_get_obj.php';
    include_once '../controllers/controll_create_grade.php';

    $rez = creare_nota("ceva");

?>


        <div class="wrapper">
            <div class="row">
                <div class="column-left">
                    <article class="article-content">
                        <h2>Top rated topics</h2>
                        <ul>
                            <?php
                               
                                $result = get_objects_bygrade("ceva");
                                if($result != "ceva")
                                    while($row = mysqli_fetch_assoc($result)){
                                            echo '<li><a class="link-hover" >';
                                            echo $row['name'];
                                            echo '</a></li>';
                                    }

                            ?>
                        </ul>
                    </article>

                    <article class="article-content">
                        <h2>Topics</h2>
                        <ul>
                            <?php
                               
                                $result = get_objects_withgrade("ceva");
                                if($result != "ceva")
                                    while($row = mysqli_fetch_assoc($result)){
                                            echo '<li><a class="link-hover" >';
                                            echo $row['name'];
                                            echo '</a></li>';
                                    }

                            ?>
                            
                        </ul>
                    </article>

                </div>

                <div class="column-right">
                    <?php   // Get Article

                        $result = get_objects("ceva");
                                        
                            while($row = mysqli_fetch_assoc($result)){
                                    echo '<article class="article-content">
                                             <header><h2>';
                                    echo  $row['name'];
                                    echo '</h2></header><content>
                                            <p>';
                                    echo 'Type: ';
                                    echo  $row['type'];
                                    echo '</p><p>';
                                    echo  $row['description'];
                                    echo '</p>
                                        </content>';
                                    echo '<footer>
                                            <p class="post-info">This post is made by ';
                                            
                                    //sql username
                                    echo get_username($row);

                                    echo ' and will expire on ';
                                    // sql time
                                    echo get_time($row);

                                    echo '</p>
                                        </footer>';

                                    echo '<form action="./Chestionar.php" method="POST">
                                            <button class="fancy-button" name="complete" type="complete" value="';
                                    $obj_id = $row['object_id'];
                                    echo $obj_id;
                                    echo '"  >
                                                Realizeaza recenzie
                                            </button>
                                        </form>';
                                        /*
                                    echo '<h3>Rating</h3>
                                            <div class="rating">
                                                <span class="rating-star" data-value="5"></span>
                                                <span class="rating-star" data-value="4"></span>
                                                <span class="rating-star" data-value="3"></span>
                                                <span class="rating-star" data-value="2"></span>
                                                <span class="rating-star" data-value="1"></span>
                                            </div>';
                                            */
                                echo '</article>';

                                
                            }
                        


                    ?>  
                    <!--
                    <article class="article-content">
                        <header>
                            <h2>Post tiltle</h2>
                        </header>
                        <content>
                            <p>
                                Sa se conceapa un instrument Web ce permite utilizatorilor posibilitatea de a oferi feedback pentru un anumit "lucru" (eveniment,
                                persoana, loc geografic, produs, serviciu, artefact artistic etc.) intr-o maniera anonima. Aplicatia
                                trebuie sa gestioneze "lucrurile" dorite a fi evaluate si chestionarele specifice fiecaruia (editabile
                                de catre initiatorul unei solicitari de colectare a feedback-ului). După terminarea perioadei in
                                care un formular este accesibil persoanelor ce realizeaza recenzii pentru un anumit "lucru", se vor
                                prezenta statistici de interes referitoare la fiecare categorie de "lucruri" evaluate -- se vor considera
                                criterii multiple precum grupul de utilizatori, perioada de timp vizand evaluarea, subcategoriile
                                de "lucruri", caracteristicile considerate pozitive/negative etc. Rapoartele generate vor fi disponibile
                                in formatele HTML, CSV si JSON, putand fi partajate pe diverse retele sociale. Bonus: alegerea unor
                                maniere de vizualizare atractiva a datelor.
                            </p>
                        </content>

                        <footer>
                            <p class="post-info">This post is made by Popescu</p>
                        </footer>

                        <button onclick="location.href ='./Chestionar.php'" class="fancy-button">
                            Realizeaza recenzie
                        </button>

                        
                        <h3>Rating</h3>
                        <div class="rating">
                            <span class="rating-star" data-value="5"></span>
                            <span class="rating-star" data-value="4"></span>
                            <span class="rating-star" data-value="3"></span>
                            <span class="rating-star" data-value="2"></span>
                            <span class="rating-star" data-value="1"></span>
                        </div>
                        

                    </article> -->

                </div>
            </div>
        </div>

    <footer class="mainFooter">

        <p>Copyright © 2018 AnoFet. All Rights Reserved.</p>

    </footer>

    <a href="#top" class="back-to-top">

        <p>Back to Top</p>

    </a>

</body>

</html>