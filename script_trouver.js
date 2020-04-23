 /*
    Fonction de validation du formulaire pour effectuer une recherche d'une randonnée.
*/
function validateform(){

    var duree_np =  document.getElementById('duree_m').value ;
    var dist_np= document.getElementById('dist').value ;
    var denivele_pos_np= document.getElementById('denivele_pos').value    ;
    var denivele_neg_np= document.getElementById('denivele_neg').value ;
    //------------//
    var duree = Number.parseFloat(document.getElementById('duree_m').value) ;
    var dist=Number.parseFloat(document.getElementById('dist').value) ;
    var denivele_pos=Number.parseFloat(document.getElementById('denivele_pos').value )   ;
    var denivele_neg=Number.parseFloat(document.getElementById('denivele_neg').value) ;
 
    
     if ( !(duree==duree_np && dist==dist_np && denivele_pos == denivele_pos_np && denivele_neg == denivele_neg_np) )
     {
        document.getElementById('ilyaqlq').innerHTML='Pour effectuer votre recherches Vous devez remplir tous les champs ! ';
        document.getElementById('err_duree').innerHTML='Les lettres alphabétiques ou caractères spécifiques ne sont pas acceptés ! vous devez entrer ques des nombres ';
         return false ;
    }
    //duree max > 15 
    if (duree > 15  ) 
    {
        document.getElementById('ilyaqlq').innerHTML='Il ya quelque erreurs que vous devez régler ! ';
        document.getElementById('err_duree').innerHTML='la durée des randonnées sur le secteur Grenoblois ne dépasse pas 15 heures ! ';
         return false;
    }  
   //distance min < 5 
    if (dist < 5  ) 
    {
        document.getElementById('ilyaqlq').innerHTML='Il ya quelques erreurs que vous devez régler ! ';
        document.getElementById('err_duree').innerHTML='ça n"existe pas une randonnée de distance < 5 KM ! ';
         return false;
    }  
    //denivelé max
    if (denivele_pos > 2000 || denivele_neg > 2000  ) 
    {
        document.getElementById('ilyaqlq').innerHTML='Il ya quelque erreurs que vous devez régler ! ';
        document.getElementById('err_duree').innerHTML='Il parait que vous avez mets un dénivelé (positif ou négatif) > 2000 mètres :D  ! ';
         return false;
    }
    else
    {
        return true;
    } 
}
 