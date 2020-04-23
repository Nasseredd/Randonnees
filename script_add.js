/*
    Fonction de validation du formulaire de l'ajout d'une randonée.
*/
function validateform(){
     //duree,distance et dénivelés ne doivent pas contenir des caracteres 
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
         document.getElementById('text1').innerHTML='Pour ajouter une randonnée, vous devez remplir tous les champs avec (*)! ';
         document.getElementById('text2').innerHTML='Les lettres alphabétiques ou caractères spécifiques ne sont pas acceptés pour les champs(Distance, Durée et dénivelés) ';
         document.getElementById('text3').innerHTML='(vous puvez mettre 0 pour les champs que vous connaissez pas.) ';

         return false ;
     }
     //duree max > 15 
    if (duree > 15  ) 
    {
        document.getElementById('text1').innerHTML='Il ya quelque erreurs que vous devez régler ! ';
        document.getElementById('text2').innerHTML='la durée des randonnées sur le secteur Grenoblois ne dépasse pas 15 heures ! ';
         return false;
    }  
   //distance min < 5 
    if (dist < 5  ) 
    {
        document.getElementById('text1').innerHTML='Il ya quelques erreurs que vous devez régler ! ';
        document.getElementById('text2').innerHTML='Une distance qui fait moins de 5 KM ne peut pas ètre considérée comme randonnée!  ';
         return false;
    }  
    //denivelé max
    if (denivele_pos > 2000 || denivele_neg > 2000  ) 
    {
        document.getElementById('text1').innerHTML='Il ya quelque erreurs que vous devez régler ! ';
        document.getElementById('text2').innerHTML='Il parait que vous avez mets un dénivelé (positif ou négatif) > 2000 mètres :D  ! ';
         return false;
    }
     else
     {
        return true ;
    }
     
}
 