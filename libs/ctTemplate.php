<?php
/*
The MIT License

Copyright (c) 2009 Cuong Tham
http://thecodecentral.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 */
 
class ctTemplate{
   private static $baseDir = '.';
   private static $defaultTemplateExtension = '.php';
   
   public static function setBaseDir($dir){
     self::$baseDir = $dir;
   }
   
   public static function getBaseDir(){
     return self::$baseDir;
   }
   
   public static function setDefaultTemplateExtension($ext){
     self::$defaultTemplateExtension = $ext;
   }
   
   public static function getDefaultTemplateExtension(){
     return self::$defaultTemplateExtension;
   }

   public static function loadTemplate($template, $vars = array(), $baseDir=null){
    if($baseDir == null){
      $baseDir = self::getBaseDir();
    }
     
    $templatePath = $baseDir.'/'.$template.''.self::getDefaultTemplateExtension();
    if(!file_exists($templatePath)){
      throw new Exception('Could not include template '.$templatePath);
    }

    return self::loadTemplateFile($templatePath, $vars);

  }

  public static function renderTemplate($template, $vars = array(), $baseDir=null){
    echo self::loadTemplate($template, $vars, $baseDir);
  }

  private static function loadTemplateFile($__ct___templatePath__, $__ct___vars__){
    extract($__ct___vars__, EXTR_OVERWRITE);
    $__ct___template_return = '';
    ob_start();
    require $__ct___templatePath__;
    $__ct___template_return = ob_get_contents();
    ob_end_clean();
    return $__ct___template_return;
  }
}