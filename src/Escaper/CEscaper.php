<?php
namespace Anax\Escaper;

class Escaper
{

    public function checkEncoding($value)
    {
        $encodings = ["UTF-32", "UTF-16", "UTF-8", "ISO-8859-1", "ASCII"];
        foreach ($encodings as $enc)  {
            if (mb_detect_encoding($value, $enc, true)) {
                return $enc;
            }
        }
    }
    
    public function escapeHtml($value)
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");     
    }
    
    public function escapeHtmlAttr($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, "UTF-8"); 
    }
    
    public function escapeJs($value)
    {
        
    }
    
    public function escapeCss($value)
    {
        
    }
    
    public function escapeUrl($value)
    {
        
    }
    

}
