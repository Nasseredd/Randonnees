<?php
 require_once('./database/constantes.php');
 class Database {
    private $db;
    public function __construct(){
        $this->db = new PDO(DSN,USERNAME,PASSWORD);
        $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
    }   

    /*
    fonction qui fait la vérification de la connextion :
    */
    public function login($data)
    {
        $username = $data['username'] ;
        $pass =$data['pass'] ;

        $tablog= array();
        try {
            $query = "SELECT * FROM admins";
            $statement = $this->db->query($query);
            while($rand = $statement->fetch(PDO::FETCH_OBJ)){
                $tablog[$rand->username]=$rand->pass;
            }
            if (isset($tablog[$username]) && isset($tablog[$pass])){
                if ($username == $tablog[$username] && $pass == $tablog[$pass]  ) {
                    return true ;
                }else{
                    return false ;
                }
            }else{
                return false ;
            }
        
        } catch (PDOException $ex) {
            echo 'Il y a une erreur : '.$ex->getMessage();
        }
    }

    /*
    fonction qui coupe le texte pour pouvoir l'afficher dans la page resume 
    */
    public function couperText($origine, $longueurAGarder)
    {
        if (strlen ($origine) <= $longueurAGarder)
            return $origine;
         
        $debut = substr ($origine, 0, $longueurAGarder);
        $debut = substr ($debut, 0, strrpos ($debut, ' ')) . '...';
         
        return $debut;
    }

     /*
    fonction qui fait l'affichage de toutes les randonnees
    */
    public function afficherResume()
    {
        try {
            $query = "SELECT * FROM randonnees";
            $statement = $this->db->query($query);
            echo '
            <div class="wrapper">
            <br/> <br/>
            <h2>Liste des randonnées disponibles  :</h2>
            <div class="cols">

            ';
            while($rand = $statement->fetch(PDO::FETCH_OBJ)){
                echo '
                
                         <div class="col" ontouchstart="this.classList.toggle("hover");">
                            <div class="container">
                                <div class="front" style="background-image: url(./images/'.$rand->img.')">
                                    <div class="inner">
                                        <!-- le titre -->
                                        <span> '.$rand->titre.' </span>
                                    </div>
                                </div>
                                <a href="randonnee.php?id=$rand->id"> 
                                <div class="back">
                                     <a href="randonnee.php?id='.$rand->id.'"> 
                                    <div class="inner">
                                                    <!-- description -->
                                                    <p>'.$this->couperText($rand->resume,150).'.</p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                  
                
                ';
             }
             echo ' </div> </div>   ' ;
             
         
        } catch (PDOException $ex) {
            echo 'Il y a une erreur : '.$ex->getMessage();
        }
    }

    /*
    fonction qui fait la recherche sur toutes les randonnees
    */
    public function filtrerDesRandonnees($data)
    {
        $dm= $data['duree_m'];
        $dis= $data['distance'];
        $dnvp= $data['denivele_pos'];
        $dnvn= $data['denivele_neg'];

        try {
            $query = "SELECT * FROM randonnees";
            $statement = $this->db->query($query);
            echo '
            <div class="wrapper">
            <br/> <br/>
            <h2>Resultats de votre recherche :</h2>
            <div class="cols">
            ';

            while($rand = $statement->fetch(PDO::FETCH_OBJ)){
                if ($rand->duree_m <= $dm && $rand->distance <= $dis&& $rand->denivele_pos <= $dnvp && $rand->denivele_neg <= $dnvn) {
                    echo '
                         <div class="col" ontouchstart="this.classList.toggle("hover");">
                            <div class="container">
                                <div class="front" style="background-image: url(./images/'.$rand->img.')">
                                    <div class="inner">
                                        <!-- le titre -->
                                        <span> '.$rand->titre.' </span>
                                    </div>
                                </div>
                                <a href="randonnee.php?id=$rand->id"> 
                                <div class="back">
                                     <a href="randonnee.php?id='.$rand->id.'"> 
                                    <div class="inner">
                                                    <!-- description -->
                                                    <p>'.$this->couperText($rand->description,150).'.</p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                  
                
                ';
                }
                 
             }
             echo ' </div> </div>   ' ;             
         
        } catch (PDOException $ex) {
            echo 'Il y a une erreur : '.$ex->getMessage();
        }
    }

     /*
    fonction qui affiche une seul randonnée dans la page randonnee.php
    */
    public function afficherUneRandonnee($data){
        $id = $data['id'];
    
        try {
            $query = "SELECT * FROM randonnees WHERE id = :id ";
            $statement = $this->db->prepare($query);
            $statement->execute(array(
                ":id"=>$id
             ));
            $rand = $statement->fetch(PDO::FETCH_OBJ) ;
            return $rand ;
            
        } catch (PDOException $ex) {
            echo 'Il y a une erreur : '.$ex->getMessage();
        }
    }

    /*
    fonction qui fait la modification sur une randonée selectionnée
    */
    public function modifierUneRandonnee($data){
        $id=$data['id'];
        $titre = $data['titre'];
        $resume =$data['resume'];
        $description = $data['description'];
        $duree_m = $data['duree_m'];
        $difficulte=$data['difficulte'];
        $distance=$data['distance'];
        $denivele_pos=$data['denivele_pos'];
        $denivele_neg=$data['denivele_neg'];
        $img = $data['img'];
  
        try{
            //on vérifie si l'image a été modifier : 
                if (!empty($img)) {
                    $query = "UPDATE randonnees SET titre=:titre,resume=:resume,description=:description,duree_m=:duree_m,
                        difficulte=:difficulte,distance=:distance,denivele_pos=:denivele_pos,denivele_neg=:denivele_neg,
                        img=:img WHERE id=:id";
           
                        $statement = $this->db->prepare($query);
                        $statement->execute(array(
                                            ":titre"=>$titre,
                                            ":resume" =>$resume,
                                            ":description" => $description,
                                            ":duree_m" =>$duree_m,
                                            ":difficulte"=>$difficulte,
                                            ":distance"=>$distance,
                                            ":denivele_pos"=>$denivele_pos,
                                            ":denivele_neg"=>$denivele_neg,
                                            ":img"=>$img,
                                            ":id"=>$id
                                            ));
                }else{
                    $query = "UPDATE randonnees SET titre=:titre,resume=:resume,description=:description,duree_m=:duree_m,
                    difficulte=:difficulte,distance=:distance,denivele_pos=:denivele_pos,denivele_neg=:denivele_neg  WHERE id=:id";
       
                    $statement = $this->db->prepare($query);
                    $statement->execute(array(
                                        ":titre"=>$titre,
                                        ":resume" =>$resume,
                                        ":description" => $description,
                                        ":duree_m" =>$duree_m,
                                        ":difficulte"=>$difficulte,
                                        ":distance"=>$distance,
                                        ":denivele_pos"=>$denivele_pos,
                                        ":denivele_neg"=>$denivele_neg,                              
                                        ":id"=>$id
                                        ));

                }
            
                                if ($statement) {
                                    $_SESSION['updated']=' 
                                    <div class="alert " id="bien" >
                                           la randonnee a été bien modifié .
                                    </div>
                                    ';
                                    
                                    $this->redirect('randonnee.php?id='.$data['id']);
                               }
        }catch(PDOException $ex){
            echo 'Il y a une erreur : '.$ex->getMessage();
        }
    }

      /*
    fonction qui fait la supprission d'une randonnée
    */
    public function supprimerUneRandonnee($data){
        $id = $data['id'];
        try {
            $query = "DELETE FROM randonnees WHERE id = :id ";
            $statement = $this->db->prepare($query);
            $statement->execute(array(
                ":id"=>$id
             ));
            if ($statement) {
                $_SESSION['deleted']=' 
                <div class="alert " id="bien">
                       La randonée a été bien supprimée .
                </div>
                ';
                $this->redirect("./resume.php");
            }
            
        } catch (PDOException $ex) {
            echo 'Il y a une erreur : '.$ex->getMessage();
        }
    }

    /*
    fonction qui fait l'ajout d'une nouvelle randonnée
    */
    public function add($data){
        $titre = $data['titre'];
        $resume =$data['resume'];
        $description = $data['description'];
        $duree_m = $data['duree_m'];
        $difficulte=$data['difficulte'];
        $distance=$data['distance'];
        $denivele_pos=$data['denivele_pos'];
        $denivele_neg=$data['denivele_neg'];
        $img = $data['img'];
  
        try{
            $query = "INSERT INTO randonnees (titre,resume,description,duree_m,difficulte,distance,denivele_pos,denivele_neg,img) 
            VALUE(:titre,:resume,:description,:duree_m,:difficulte,:distance,:denivele_pos,:denivele_neg,:img )";
           
            $statement = $this->db->prepare($query);
            $statement->execute(array(
                                ":titre"=>$titre,
                                 ":resume" =>$resume,
                                 ":description" => $description,
                                 ":duree_m" =>$duree_m,
                                 ":difficulte"=>$difficulte,
                                 "distance"=>$distance,
                                 "denivele_pos"=>$denivele_pos,
                                 "denivele_neg"=>$denivele_neg,
                                 "img"=>$img

                                ));
          

            if ($statement) {
                 $_SESSION['added']=' 
                 <div class="alert " id="bien">
                        Votre ajout a été bien effectué .
                 </div>
                 ';
                $this->redirect('resume.php');
            }
        }catch(PDOException $ex){
            echo 'Il y a une erreur : '.$ex->getMessage();
        }
     }
     

    public function redirect($page){
        header('location:'.$page);
    }


    }

 ?>
