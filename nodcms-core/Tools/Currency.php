<?php
/**
 * NodCMS
 *
 * Copyright (c) 2015-2021.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *  @author     Mojtaba Khodakhah
 *  @copyright  2015-2021 Mojtaba Khodakhah
 *  @license    https://opensource.org/licenses/MIT	MIT License
 *  @link       https://nodcms.com
 *  @since      Version 3.2.0
 *  @filesource
 *
 */

class Currency
{
    // Acceptable formats: 1.234,56 - 1,234.56 - 1.234 - 1,234
    private $acceptable_formats = array("1.234,56", "1,234.56", "1.234", "1,234");
    private $_currencyFormat = "1.234,56";
    private $options = array(
        "code"=>"EUR",
        "sign"=>"€",
        "html_sign"=>"&euro;",
        "add_before"=>"",
        "add_after"=>" EUR",
    );

    private $_smallPart = "";
    private $_smallPartDivider = ",";
    private $_bigPart = "";
    private $_bigPartDivider = ".";

    /**
     * Acceptable formats
     *
     * @return array
     */
    public function getFormats()
    {
        return $this->acceptable_formats;
    }

    /**
     * Get rest divider
     *
     * @return string
     */
    public function getDivider()
    {
        return $this->_smallPartDivider;
    }

    /**
     * Set format
     *
     * @param $value
     */
    public function setFormat($value){
        if(!in_array($value, $this->acceptable_formats)){
            $value = $this->_currencyFormat;
        }
        if ($value == "1.234,56") {
            $this->_smallPartDivider = ",";
            $this->_bigPartDivider = ".";
        } elseif ($value == "1,234.56") {
            $this->_smallPartDivider = ".";
            $this->_bigPartDivider = ",";
        } elseif ($value == "1.234") {
            $this->_bigPartDivider = ".";
            $this->_smallPartDivider = "";
        } elseif ($value == "1,234") {
            $this->_bigPartDivider = ",";
            $this->_smallPartDivider = "";
        }
        $this->_currencyFormat = $value;
    }

    /**
     * Set currency options
     *
     * @param $value
     */
    public function setOptions($value){
        if(!isset($value["code"]))
            $value["code"]=$this->options["code"];

        if(!isset($value["sign"]))
            $value["sign"]=$this->options["sign"];

        if(!isset($value["html_sign"]))
            $value["html_sign"]=$this->options["html_sign"];

        if(!isset($value["add_before"]))
            $value["add_before"]=$this->options["add_before"];

        if(!isset($value["add_after"]))
            $value["add_after"]=$this->options["add_after"];

        $this->options = $value;
    }

    /**
     * Get currency options
     *
     * @return array
     */
    public function getOptions(){
        return $this->options;
    }

    // Convert number to currency string
    function format($value){
        if(!is_int($value) && !is_float($value))
            $value = floatval($value);
        $this->setParts($value);

        $format = $this->options["add_before"];
        $format .= $this->_bigPart;
        if($this->_smallPartDivider != "")
            $format .= $this->_smallPartDivider.$this->_smallPart;
        $format .= $this->options["add_after"];
        return $format;
    }


    /**
     * Format the number official with the currency code
     *
     * @param $value float
     * @return string
     */
    function formatCode($value){
        if(!is_int($value) && !is_float($value))
            $value = floatval($value);
        $this->setParts($value);

        $format = $this->_bigPart;
        if($this->_smallPartDivider != "")
            $format .= $this->_smallPartDivider.$this->_smallPart;
        $format .= " ".$this->options["code"];
        return $format;
    }

    /**
     * Format number just like a float number
     *
     * @param $value float
     * @param $divider mixed
     * @return string
     */
    function formatFloat($value, $divider = null){
        if(!is_int($value) && !is_float($value))
            $value = floatval($value);
        $this->setParts($value, false);

        $format = $this->_bigPart;
        $_smallPartDivider = $this->_smallPartDivider;
        // Set the add-on divider if it sets
        if($divider!=null)
            $_smallPartDivider = $divider;
        // Add . if didn't set any divider
        if($_smallPartDivider == "")
            $_smallPartDivider = ".";

        $format .= $_smallPartDivider.$this->_smallPart;
        return $format;
    }

    /**
     * Format number without any sign and currency code
     *
     * @param $value
     * @return string
     */
    function noSignFormat($value){
        if(!is_int($value) && !is_float($value))
            $value = floatval($value);
        $this->setParts($value);

        $format = $this->_bigPart;
        if($this->_smallPartDivider != "")
            $format .= $this->_smallPartDivider.$this->_smallPart;
        return $format;
    }

    private function setParts($value, $big_part_divider = true){
        $str_value = strval($value);
        $array_value = explode(".", $str_value);
        if(is_float($value) && isset($array_value[1])){
            $this->_smallPart = substr($array_value[1]."00", 0, 2);
            $this->_bigPart = $array_value[0];
        }else{
            $this->_bigPart = $str_value;
            $this->_smallPart = "00";
        }
        if($big_part_divider == true){
            $value_len = strlen($this->_bigPart);
            if($value_len > 3){
                $mod = $value_len%3;
                $bigPart = substr($this->_bigPart, 0, $mod);
                for ($i=$mod;$i<$value_len;$i+=3){
                    $bigPart .= $this->_bigPartDivider;
                    $bigPart .= substr($this->_bigPart, $i, 3);
                }
                $this->_bigPart = $bigPart;
            }
        }
    }
}