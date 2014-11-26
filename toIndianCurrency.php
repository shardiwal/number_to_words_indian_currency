<?php
/** 
*  Author: Rakesh Kumar Shardiwal
*  Email : rakesh.shardiwal@gmail.com
*
*  Description: 
*  Converts a given number into words, based on Indian currency
*  
*  Functions:
*      toWords($number, $nopostfixtext);
*      toCurrency($number);
*/ 
class toIndianCurrency  {

    public static $VERSION = 1.0;

    public $currency = 'Rs.';

    public $postfix  = 'Only';

    public $has_postfix_text = true;

    protected $ones = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 
        'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 
        'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
    );

    protected $tens = array(
        '', '', 'Twenty', 'Thirty', 'Fourty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'
    );

    protected $triplets = array('Crore', 'Lakh', 'Thousand', 'Hundred');

    public function toWords($number, $nopostfixtext=false){
        if (($number < 0) || ($number > 999999999)) { 
            throw new Exception("Number is out of range");
        }
        if ( $nopostfixtext )
            $this->has_postfix_text = false;

        $number_in_words = $this->_build_number($number);
        if (!$this->has_postfix_text)
            return $number_in_words;

        return utf8_encode($number_in_words .' '. $this->currency .' '. $this->postfix);
    }

    public function toCurrency($number){
        if (($number < 0) || ($number > 999999999)) { 
            throw new Exception("Number is out of range");
        }
        setlocale(LC_MONETARY, 'en_IN');
        return money_format('%i', $number);
    }
    
    private function _build_number($number) 
    { 
        $crore      = floor($number / 10000000); // Crore
        $number    -= $crore * 10000000;

        $lakh       = floor($number / 100000);   // lakh
        $number    -= $lakh * 100000; 

        $thousands  = floor($number / 1000);     // Thousands
        $number    -= $thousands * 1000; 

        $hundreds   = floor($number / 100);      // Hundreds
        $number    -= $hundreds * 100; 

        $ten        = floor($number / 10);       // Tens
        $n          = $number % 10;              // Ones

        $res = "";

        if ($crore) { 
            $res .= $this->_build_number($crore)." ".$this->triplets[0]." ";
        }
        if ($lakh) {
            $res .= $this->_build_number($lakh)." ".$this->triplets[1];
        }
        if ($thousands) {
            $res .= (empty($res) ? "" : " ") .
            $this->_build_number($thousands)." ".$this->triplets[2];
        }
        if ($hundreds) {
            $res .= (empty($res) ? "" : " ") . 
            $this->_build_number($hundreds)." ".$this->triplets[3];
        }
        if ($ten || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }
            if ($ten < 2) {
                $res .= $this->ones[$ten * 10 + $n];
            }
            else {
                $res .= $this->tens[$ten];
                if ($n) {
                    $res .= "-" . $this->ones[$n];
                }
            }
        }

        if (empty($res)) {
            $res = "zero";
        }

        return $res;
    }
}
?>
