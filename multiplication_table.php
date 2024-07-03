<?php
for ($i = 1; $i <= 9; $i++) {
  for ($j = 1; $j <= 9; $j++) {
    $result = $i * $j;
    echo str_pad("$i x $j = $result", 12, " ", STR_PAD_BOTH) . '|';
  }
  echo PHP_EOL;
};
