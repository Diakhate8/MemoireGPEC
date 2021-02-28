<?php
namespace App\Utule;

use App\Utule\FormatedDate;
use Symfony\Component\Config\Definition\Exception\Exception;

/*
*Convertion Json date to dateTime interface for BD
*/
class Modalites{

    public function formaterDate($date1){
        $this->date = \DateTime::createFromFormat('d/m/Y',$date1);
        return $this->date;
    }
    public function modalite($donneeRecu){
        $format= 'd/m/Y';
        if(empty($donneeRecu->premierE)|| empty($donneeRecu->premierMont)){
            throw new Exception("veuillez saisir le premier echeancier ");  
        }else{
            $premierE = $this->formaterDate($donneeRecu->premierE) ;$premierMont = $donneeRecu->premierMont;
        }
        if(empty($donneeRecu->deuxiemeE)|| empty($donneeRecu->deuxiemeMont)){
            $deuxiemeE = null; $deuxiemeMont = null;
        }else{
             $deuxiemeE = $this->formaterDate($donneeRecu->deuxiemeE); $deuxiemeMont = $donneeRecu->deuxiemeMont;
        }
        if(empty($donneeRecu->troisiemeE)|| empty($donneeRecu->troisiemeMont)){
            $troisiemeE = null; $troisiemeMont = null;
        }else{
            $troisiemeE = \DateTime::createFromFormat($format,$donneeRecu->troisiemeE);$troisiemeMont = $donneeRecu->troisiemeMont;
        }
        if(empty($donneeRecu->quatriemeE)|| empty($donneeRecu->quatriemeMont)){
            $quatriemeE = null; $quatriemeMont = null;
        }else{
            $quatriemeE = \DateTime::createFromFormat($format,$donneeRecu->quatriemeE);$quatriemeMont = $donneeRecu->quatriemeMont;
        }      
        if(empty($donneeRecu->cinquiemeE) || empty($donneeRecu->cinquiemeMont)){
            $cinquiemeE=null; $cinquiemeMont = null;
        }else{
            $cinquiemeE = \DateTime::createFromFormat($format,$donneeRecu->cinquiemeE);$cinquiemeMont = $donneeRecu->cinquiemeMont;    
        }
        if(empty($donneeRecu->sixiemeE) || empty($donneeRecu->sixiemeMont)){
            $sixiemeE=null; $sixiemeMont = null;
        }else{
            $sixiemeE = \DateTime::createFromFormat($format,$donneeRecu->sixiemeE);$sixiemeMont = $donneeRecu->sixiemeMont;    
        }
        if(empty($donneeRecu->septiemeE) || empty($donneeRecu->septiemeMont)){
            $septiemeE=null; $septiemeMont = null;
        }else{
            $septiemeE= \DateTime::createFromFormat($format,$donneeRecu->septiemeE);$septiemeMont = $donneeRecu->septiemeMont;    
        }
        if(empty($donneeRecu->huitiemeE) || empty($donneeRecu->huitiemeMont)){
            $huitiemeE=null; $huitiemeMont = null;
        }else{
            $huitiemeE = \DateTime::createFromFormat($format,$donneeRecu->huitiemeE);$huitiemeMont = $donneeRecu->huitiemeMont;    
        }
        if(empty($donneeRecu->neuviemeE) || empty($donneeRecu->neuviemeMont)){
            $neuviemeE=null; $neuviemeMont = null;
        }else{
            $neuviemeE = \DateTime::createFromFormat($format,$donneeRecu->neuviemeE);$neuviemeMont = $donneeRecu->neuviemeMont;    
        }
        if(empty($donneeRecu->dixiemeE) || empty($donneeRecu->dixiemeMont)){
            $dixiemeE=null; $dixiemeMont = null;
        }else{
            $dixiemeE = \DateTime::createFromFormat($format,$donneeRecu->dixiemeE);$dixiemeMont = $donneeRecu->dixiemeMont;    
        }
        if(empty($donneeRecu->onziemeE) || empty($donneeRecu->onziemeMont)){
            $onziemeE=null; $onziemeMont = null;
        }else{
            $onziemeE = \DateTime::createFromFormat($format,$donneeRecu->onziemeE);$onziemeMont = $donneeRecu->onziemeMont;    
        }
        if(empty($donneeRecu->douziemeE) || empty($donneeRecu->douziemeMont)){
            $douziemeE=null; $douziemeMont = null;
        }else{
            $douziemeE = \DateTime::createFromFormat($format,$donneeRecu->douziemeE);$douziemeMont = $donneeRecu->douziemeMont;    
        }
        return ['premierE'=>$premierE,'premierMont' =>$premierMont,'deuxiemeE'=>$deuxiemeE,
        'deuxiemeMont'=>$deuxiemeMont,'troisiemeE'=>$troisiemeE,'troisiemeMont'=>$troisiemeMont,
        'quatriemeE'=>$quatriemeE,'quatriemeMont'=>$quatriemeMont,'cinquiemeE'=>$cinquiemeE,
        'cinquiemeMont'=>$cinquiemeMont,'sixiemeE'=>$sixiemeE,'sixiemeMont'=>$sixiemeMont,
        'septiemeE'=>$septiemeE,'septiemeMont'=>$septiemeMont,'huitiemeE'=>$huitiemeE,
        'huitiemeMont'=>$huitiemeMont,'neuviemeE'=>$neuviemeE,'neuviemeMont'=>$neuviemeMont,
        'dixiemeE'=>$dixiemeE,'dixiemeMont'=>$dixiemeMont,'onziemeE'=>$onziemeE,
        'onziemeMont'=>$onziemeMont,'douziemeE'=>$douziemeE,'douziemeMont'=>$douziemeMont];

    }
    
}