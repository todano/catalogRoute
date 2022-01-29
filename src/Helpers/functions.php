<?php

function esc(string $str,$con)
{
  return mysqli_real_escape_string(htmlspecialchars(trim ($str)),$con);
}

function callView($template, $view, $params = [])
{
  $view = 'src/Views/'.$view;
  $view = str_replace('/', DIRECTORY_SEPARATOR, $view);
  $template = 'src/Views/Templates/'.$template;
  $template = str_replace('/', DIRECTORY_SEPARATOR, $template);
  include $template;
}
function go($controller = null, $method = null, $params = [])
{
  $controller = $controller ?? DEFAULT_CONTROLLER;
  $method = $method ?? DEFAULT_METHOD;
  return BASE_URL.$controller.'/'.$method.'/'.join('/',$params);
}
