<?php
namespace App\Utule;

use Symfony\Component\Config\Definition\Exception\Exception;


/*
*Convertion Json date and mont to String for  Contrat
*/
class ModaliteString{
    private $formatNull="";
    private $toWords;
    private $devise ="FCFA\n";

    public function __construct(NumberToWords $toWords){
        $this->toWords = $toWords;
    }
           
    // Get datas Echeancier (Modalite de paiement) toString  form Contrat
    public function modStringSix($donneeRecu){   
        if(empty($donneeRecu->premierE)||empty($donneeRecu->premierMont)){
            throw new Exception("veuillez saisir le premier echeancier ");  
        }else{
            $premierE = "01e Echéancier :".$donneeRecu->premierE." ".$donneeRecu->premierMont.
            " ".$this->toWords ->inWords($donneeRecu->premierMont) .$this->devise ;
        }

        if(empty($donneeRecu->deuxiemeE)||empty($donneeRecu->deuxiemeMont)){
            $deuxiemeE = $this->formatNull; 
        }else{
            $deuxiemeE = "02e Echéancier :".$donneeRecu->deuxiemeE." ".$donneeRecu->deuxiemeMont.
            " ".$this->toWords->inWords($donneeRecu->deuxiemeMont) .$this->devise ;
        }

        if(empty($donneeRecu->troisiemeE)||empty($donneeRecu->troisiemeMont) ){
            $troisiemeE = $this->formatNull; 
        }else{
            $troisiemeE = "03e Echéancier :".$donneeRecu->troisiemeE.
            " ".$donneeRecu->troisiemeMont." ".$this->toWords->inWords($donneeRecu->troisiemeMont) .$this->devise ;
        }

        if(empty($donneeRecu->quatriemeE)||empty($donneeRecu->quatriemeMont)){
            $quatriemeE = $this->formatNull; 
        }else{
            $quatriemeE = "04e Echéancier :".$donneeRecu->quatriemeE." ".$donneeRecu->quatriemeMont.
            " ".$this->toWords->inWords($donneeRecu->quatriemeMont) .$this->devise ;
        }

        if(empty($donneeRecu->cinquiemeE)||empty($donneeRecu->cinquiemeMont) ){
            $cinquiemeE=$this->formatNull; 
        }else{
            $cinquiemeE = "04e Echéancier :".$donneeRecu->cinquiemeE." ".$donneeRecu->cinquiemeMont.
            " ".$this->toWords->inWords($donneeRecu->cinquiemeMont) .$this->devise ; 
        }
        
        if(empty($donneeRecu->sixiemeE)||empty($donneeRecu->sixiemeMont)){
            $sixiemeE=$this->formatNull; 
        }else{
            $sixiemeE = "06e Echéancier :".$donneeRecu->sixiemeE." ".$donneeRecu->sixiemeMont.
            " ".$this->toWords->inWords($donneeRecu->sixiemeMont) .$this->devise ;  
        }
        if(empty($donneeRecu->septiemeE)||empty($donneeRecu->septiemeMont)){
            $septiemeE=$this->formatNull; 
        }else{
            $septiemeE = "07e Echéancier :".$donneeRecu->septiemeE." ".$donneeRecu->septiemeMont.
            " ".$this->toWords->inWords($donneeRecu->septiemeMont) .$this->devise ;    
        }
        if(empty($donneeRecu->huitiemeE)||empty($donneeRecu->huitiemeMont) ){
            $huitiemeE=$this->formatNull; 
        }else{
            $huitiemeE = "08e Echéancier :".$donneeRecu->huitiemeE." ".$donneeRecu->huitiemeMont.
            " ".$this->toWords->inWords($donneeRecu->huitiemeMont) .$this->devise ;  
        }
        if(empty($donneeRecu->neuviemeE)||empty($donneeRecu->neuviemeMont) ){
            $neuviemeE=$this->formatNull; 
        }else{
            $neuviemeE = "09e Echéancier :".$donneeRecu->neuviemeE
            ." ".$donneeRecu->neuviemeMont." ".$this->toWords->inWords($donneeRecu->neuviemeMont ) .$this->devise ; 
        }
        if(empty($donneeRecu->dixiemeE)||empty($donneeRecu->dixiemeMont) ){
            $dixiemeE=$this->formatNull; 
        }else{
            $dixiemeE = "10e Echéancier :".$donneeRecu->dixiemeE
            ." ".$donneeRecu->dixiemeMont." ".$this->toWords->inWords($donneeRecu->dixiemeMont) .$this->devise ;   
        }
        if(empty($donneeRecu->onziemeE)||empty($donneeRecu->onziemeMont) ){
            $onziemeE=$this->formatNull; 
        }else{
            $onziemeE = "11e Echéancier :".$donneeRecu->onziemeE
            ." ".$donneeRecu->onziemeMont." ".$this->toWords->inWords($donneeRecu->onziemeMont ) .$this->devise ;   
        }
        if(empty($donneeRecu->douziemeE)||empty($donneeRecu->douziemeMont) ){
            $douziemeE=$this->formatNull; 
        }else{
            $douziemeE = "12e Echéancier :".$donneeRecu->douziemeE
            ." ".$donneeRecu->douziemeMont." ".$this->toWords->inWords($donneeRecu->douziemeMont) .$this->devise ;  
        }
        return ['premierE'=>$premierE,'deuxiemeE'=>$deuxiemeE,'troisiemeE'=>$troisiemeE,
                'quatriemeE'=>$quatriemeE,'cinquiemeE'=>$cinquiemeE,'sixiemeE'=>$sixiemeE,
                'septiemeE'=>$septiemeE,'huitiemeE'=>$huitiemeE,'neuviemeE'=>$neuviemeE,
                'dixiemeE'=>$dixiemeE,'onziemeE'=>$onziemeE,'douziemeE'=>$douziemeE,
        ];
    }
}