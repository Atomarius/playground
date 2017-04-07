<?php

$template = <<<input
<th>
  <label for="%id%"></label>
  <input type="%type%" id="%id%" value="%value%">
</th>

input;
$fields = ['Name', 'Position', 'Office', 'Extn.', 'Start date', 'Salary'];

foreach ($fields as $field) {
    echo str_replace(['%id%','%label%','%type%','%value%'], [str_replace(['.',' '],['','_'],strtolower($field)),$field,'text',$field], $template);
}
