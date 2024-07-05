<?php
function multiplication_table($start, $end)
{
  for ($i = 1; $i <= $start; $i++) {
    for ($j = 1; $j <= $end; $j++) {
      $result = $i * $j;
      echo str_pad("$i x $j = $result", 12, " ", STR_PAD_BOTH) . '|';
    }
    echo PHP_EOL;
  };
}

if ($argc === 3) {
  $start = (int)$argv[1];
  $end = (int)$argv[2];

  if ($start > 0 && $start <= 9 && $end > 0 && $end <= 9) {
    multiplication_table($start, $end);
  } else {
    echo "參數範圍 0 ~ 9";
  }
} else if ($argc < 3) {
  echo '請輸入兩個參數';
} else {
  echo '僅能輸入兩個參數';
}
