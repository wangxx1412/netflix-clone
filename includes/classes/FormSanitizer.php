<?php
class FormSanitizer
{
  public static function sanitizeFormString($inputText)
  {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText); //Trim
    $inputText = strtolower($inputText);
    $inputText = ucfirst($inputText);
    return $inputText;
  }
  public static function sanitizeFormUsername($inputText)
  {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText); //Trim
    return $inputText;
  }
  public static function sanitizeFormPassword($inputText)
  {
    $inputText = strip_tags($inputText);
    return $inputText;
  }
  public static function sanitizeFormEmail($inputText)
  {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText); //Trim
    return $inputText;
  }
}
